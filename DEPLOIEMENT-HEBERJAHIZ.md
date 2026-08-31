# Déploiement sur Heberjahiz (hébergement mutualisé cPanel)

Cible de production décidée avec le client (31/08/2026) : le site part sur le
compte Heberjahiz `cleartra`, et non plus sur l'aperçu Vercel — celui-ci reste
utile comme lien de relecture tant que le domaine n'est pas basculé.

## 1. Prérequis — vérifiés

| Besoin de l'application | Offre Heberjahiz | État |
| --- | --- | --- |
| PHP `^8.3` (Laravel 13.8, Filament 5.6) | PHP 8.0 → 8.4 sélectionnables par cPanel | **OK** — à régler sur 8.3 dans *MultiPHP Manager* |
| MySQL | 5 bases (Standard) / 15 (Business) / illimité (Performance) | OK — 1 seule base nécessaire |
| Réécriture d'URL | LiteSpeed lit les `.htaccess` — celui de `public/` fonctionne tel quel | OK |
| Espace disque | 50 Go minimum ; le site pèse ~120 Mo dont 17 Mo de vidéo | OK |

**Le seul vrai risque était la version de PHP** : Laravel 13 et Filament 5
exigent 8.3, or beaucoup d'hébergements mutualisés plafonnent à 8.1. Heberjahiz
propose bien jusqu'à 8.4.

## 2. Ce qui doit changer par rapport au local

Ces quatre points ne sont pas des détails de configuration : laissés tels quels,
le site se déploie **sans erreur visible** mais ne fonctionne pas correctement.

1. **`DB_CONNECTION=sqlite` → `mysql`.** Le développement utilise
   `database/database.sqlite` ; la production doit pointer sur la base cPanel.
2. **`QUEUE_CONNECTION=database` → `sync`.** Un hébergement mutualisé ne fait
   pas tourner de démon `queue:work`. Tout travail mis en file d'attente
   resterait dans la table `jobs` **sans jamais s'exécuter**, silencieusement.
   Aucun `ShouldQueue` n'existe aujourd'hui dans l'application (vérifié), donc
   `sync` ne change rien au comportement — mais il évite le piège si un envoi
   passe un jour en file d'attente.
3. **`SESSION_DRIVER` et `CACHE_STORE` restent `database`** : leurs tables
   (`sessions`, `cache`) sont créées par les migrations. Rien à changer, mais
   cela rend l'étape « migrations » obligatoire *avant* la première visite.
4. **`MAIL_MAILER=log` → SMTP réel.** En local les e-mails partent dans un
   fichier de log. En production, sans SMTP configuré, les trois formulaires
   (RDV, demande de cas, certification) **enregistrent bien en base mais
   n'alertent personne** — l'envoi est dans un `try/catch` qui avale l'échec
   pour ne pas casser la soumission.

## 3. Préparer le paquet (à faire en local)

```bash
cd cleartrack-website
composer install --no-dev --optimize-autoloader   # vendor/ sans les outils de dev
npm run build                                     # assets Vite dans public/build
php artisan filament:assets                       # assets du panneau admin (absents aujourd'hui)
```

Puis créer le `.env` de production (voir §4) et compresser **tout le projet
sauf** : `node_modules/`, `.git/`, `tests/`, `database/database.sqlite`,
`storage/app/sources-ppt-non-publiables/` (extraits non publiables — D15/D20),
`build-apercu/`, `outils/`.

`vendor/` **doit** être dans l'archive : sans SSH, Composer ne peut pas tourner
sur le serveur.

## 4. Base de données et `.env`

Dans cPanel → *MySQL® Databases* : créer une base, un utilisateur, puis
**associer l'utilisateur à la base avec ALL PRIVILEGES** (oubli classique).
cPanel préfixe les deux par le nom du compte : `cleartra_...`.

`.env` de production, valeurs qui changent :

```env
APP_ENV=production
APP_DEBUG=false
APP_KEY=            # php artisan key:generate --show, à coller ici
APP_URL=https://LE-DOMAINE

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=cleartra_cleartrack
DB_USERNAME=cleartra_cleartrack
DB_PASSWORD=

QUEUE_CONNECTION=sync

MAIL_MAILER=smtp
MAIL_HOST=mail.LE-DOMAINE
MAIL_PORT=465
MAIL_ENCRYPTION=ssl
MAIL_USERNAME=contact@LE-DOMAINE
MAIL_PASSWORD=
MAIL_FROM_ADDRESS=contact@LE-DOMAINE
MAIL_FROM_NAME="ClearTrack align"
```

`APP_DEBUG=false` est impératif : à `true`, une erreur affiche la trace
complète, chemins serveur et identifiants de base compris.

## 5. Envoi et racine du domaine

Décompresser l'application **au-dessus** de `public_html`, par exemple
`/home/cleartra/cleartrack/`, puis faire pointer le domaine sur son
sous-dossier `public/` :

- **Voie propre** — cPanel → *Domains* → *Manage* → document root =
  `/home/cleartra/cleartrack/public`.
- **Repli** si le champ est verrouillé : copier le contenu de `public/` dans
  `public_html/`, puis corriger les deux chemins de `public_html/index.php`
  vers `/home/cleartra/cleartrack/vendor/autoload.php` et
  `/home/cleartra/cleartrack/bootstrap/app.php`.

Ne **jamais** déposer le projet entier dans `public_html` : `.env`, la base et
`storage/app/private` (radios et photos des patients) deviendraient
téléchargeables par n'importe qui.

Droits : `storage/` et `bootstrap/cache/` en 755, inscriptibles.

## 6. Migrations sans SSH — par tâche cron ponctuelle

L'offre mutualisée n'expose pas forcément de terminal. cPanel → *Cron Jobs*
permet malgré tout de lancer une commande une seule fois : la programmer dans
quelques minutes, laisser passer, puis **supprimer la tâche**.

```
/usr/local/bin/php /home/cleartra/cleartrack/artisan migrate --force --seed
```

Puis, de la même façon :

```
/usr/local/bin/php /home/cleartra/cleartrack/artisan storage:link
/usr/local/bin/php /home/cleartra/cleartrack/artisan config:cache
/usr/local/bin/php /home/cleartra/cleartrack/artisan route:cache
/usr/local/bin/php /home/cleartra/cleartrack/artisan view:cache
```

`--seed` lance `AnnuaireSeeder`, `ContenuSeeder` et `EspaceMedecinSeeder`. Si
SSH est ouvert sur l'offre souscrite, ces cinq commandes s'enchaînent
directement et cette étape se réduit à un copier-coller.

## 7. DNS et SSL

Le domaine utilise aujourd'hui des **serveurs DNS tiers** (constaté dans
l'espace client, onglet *Mon domaine*) : il ne pointe donc pas encore sur
l'hébergement. Deux façons de basculer :

- remettre les serveurs DNS d'Heberjahiz (bascule complète, propagation
  jusqu'à 24 h) ;
- ou, en gardant le DNS actuel, remplacer l'enregistrement `A` de `@` et `www`
  par l'IP du compte cPanel (bascule plus fine, réversible plus vite).

Une fois le domaine résolu vers le serveur : cPanel → *SSL/TLS Status* →
*Run AutoSSL* pour le certificat gratuit, puis vérifier que `https://` répond
avant de communiquer l'adresse au client.

## 8. À trancher avant la mise en ligne réelle

- **D10 — destinataires des notifications.** `config('mail.notifications_cas')`
  et `notifications_rdv` ne sont pas définies dans `config/mail.php` : ce sont
  les valeurs de repli codées en dur (`customer@` / `contact@cleartrack.ma`)
  qui s'appliquent. À figer avec le client, sinon les demandes patients
  partiront vers une adresse qui n'existe peut-être pas.
- **Identifiants de l'admin Filament** : `admin-credentials.txt` (hors dépôt)
  contient ceux du développement. En créer d'autres en production.
- Tout ce qui reste listé sous « En attente du client » dans `CHECKLIST.md`
  (PDF, photos consenties, fiches cabinets, URL des réseaux sociaux).

## 9. Vérifications après mise en ligne

- Les 15 pages publiques répondent en 200 (`/sitemap.xml` les liste toutes).
- Les trois formulaires enregistrent **et** envoient un e-mail.
- `/admin` s'ouvre et affiche bien les styles (sinon `filament:assets` a été
  oublié, ou `public/vendor` n'a pas été envoyé).
- `https://LE-DOMAINE/.env` renvoie 404 ou 403, **jamais** le contenu du fichier.
- La vidéo de l'accueil s'affiche sur téléphone (D86) et se lance au clic.
