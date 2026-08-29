# ClearTrack — Checklist de développement

Suivi vivant du projet (règle Phase 6 : checklist maintenue en continu).

## ✅ Étape 1 — Socle (TERMINÉE — vérifiée le 16/07/2026)
- [x] Projet Laravel 13 + SQLite (dev) / MySQL (prod Heberjahiz)
- [x] Tailwind 4 + design system : couleur officielle #2A9EFC (vérifié rgb(42,158,252)), Poppins, boutons pilule, cartes, accordéons
- [x] Assets de marque intégrés (logos on-blue/on-white, fonds vagues, favicon, rendu aligneur du héro)
- [x] Fond bleu à vagues fidèle au PPT (blend multiply → #2A9EFC exact)
- [x] Layout de base : nav PPT (Pourquoi ?/Avantages/Blog/FAQ/À propos/Prendre RDV + Espace Médecin), menu mobile hamburger (testé ouverture/fermeture), footer 3 colonnes + réseaux + Retour en haut, bouton WhatsApp flottant
- [x] 16 routes créées (toutes les pages du sitemap, stubs pour les étapes suivantes)
- [x] Accueil : héro conforme PPT slide 2 + 5 qualités (slide 3, à enrichir Étape 2)
- [x] Vérifications : 0 erreur console, desktop + mobile, contrastes nav OK

## ✅ Étape 2 — Pages statiques patient (TERMINÉE — vérifiée le 16/07/2026)
- [x] Accueil complet : 5 qualités, dentistes experts, 4 étapes (photos PPT), section Résultats (6 cas nommés, photos → Étape 6), avantages 3 col avec icônes du kit, « Nous aimons votre sourire », traitement invisible + WhatsApp, témoignages Tarik J / Nouha S
- [x] Pourquoi Cleartrack®align ? (4 raisons, comparaison matériau, polyuréthane, CTA consultation)
- [x] Avantages (8 blocs + CTA « Qu'attendez-vous ? »)
- [x] À propos (histoire, mission, standards, CTA)
- [x] Cas traitables (7 malocclusions + illustrations du kit)
- [x] Fabrication (étapes cliniques/labo, procédure, instructions de base)
- [x] Politique de confidentialité (texte intégral PPT, 10 sections)
- [x] CGU (texte intégral PPT)
- [x] Vérification visuelle des 8 pages (Chrome headless 1440px) + titres H1/H2 contrôlés
- [ ] Reste pour Étape 6 : photos avant/après Résultats, carrousels, photo thermoformage dédiée

## ✅ Étape 3 — FAQ + Blog + admin (TERMINÉE — vérifiée le 17/07/2026)
- [x] Migrations + modèles Faq (groupe/question/réponse/ordre/actif) et Post (titre/slug/extrait/contenu/image/publié_le)
- [x] Seed : 19 réponses FAQ patient intégrales (3 générales + 16 traitement, source docs Word) + 1 article blog « Suivre la règle des 22 heures par jour » (corps assemblé à partir des contenus client)
- [x] Page /faq : accordéons ± (design PPT) en 2 groupes, testés ouverture/fermeture + CTA WhatsApp/RDV
- [x] Blog : /blog (cartes + pagination) + /blog/{slug} (gabarit article + CTA RDV)
- [x] Back-office Filament v5 : /admin brandé ClearTrack (#2A9EFC, logo, favicon), login testé, CRUD Faqs + Posts fonctionnels
- [x] Compte admin : admin@cleartrack.ma (mot de passe dans ../admin-credentials.txt — hors du dépôt)
- [x] Site en ligne mis à jour (Vercel) : FAQ + blog + article vérifiés en production
- [ ] FAQ Médecin : questions listées dans le PPT mais réponses non fournies → à seeder à l'Étape 5 (réponses client requises)
## ✅ Étape 4 — Prendre RDV + annuaire cabinets (TERMINÉE — vérifiée le 17/07/2026)
- [x] Tables villes / cabinets / demandes_rdv / photos_rdv + modèles
- [x] Seed : 21 villes du PPT + 3 fiches cabinet placeholder « Dr. M. XXXXX » (Casablanca, identiques au PPT — vraies données à fournir, Q5)
- [x] Page /prendre-rdv : en-tête PPT, bloc « 2 visites », formulaire 6 champs (validation FR) + 6 zones photo glisser-déposer avec confirmation visuelle + note confidentialité (lien vers la politique)
- [x] Annuaire accordéon par ville avec fiches médecin (tél cliquable) + message « bientôt référencés » si ville vide
- [x] Sécurité : CSRF, honeypot anti-spam, throttle 5 req/10 min, photos JPG/PNG max 10 Mo stockées hors racine web (noms aléatoires)
- [x] Email de notification (Mailable markdown) vers contact@cleartrack.ma (log en dev) — n'échoue jamais la demande
- [x] Admin : ressources Demande Rdvs (leads + statut nouveau/contacté/converti/clos), Villes, Cabinets
- [x] Test bout-en-bout réel : POST multipart avec 2 photos → 302 succès, lead en base, 2 fichiers privés, email loggé, lead visible dans l'admin
- [x] Vercel mis à jour (formulaire en mode démo avec alerte)
- [ ] « voir exemple » photos : liens en place, images d'exemple à intégrer (Étape 6, sources dans les ZIP client)
## ✅ Étape 5 — Espace Médecin (TERMINÉE — vérifiée le 17/07/2026)
- [x] Tables demandes_cas / fichiers_cas / demandes_certification / telechargements + modèles
- [x] Landing /espace-medecin : proposition de valeur + 7 services + sous-nav 4 onglets (design PPT)
- [x] Démarrer un traitement : formulaire clinique complet (médecin 5 champs, patient 2, prescription : type de demande / arcade / correction en radio-pills, dents à exclure ×2, instructions, 10 zones upload JPG/PNG/PDF 15 Mo — 9 requises + téléradio optionnelle, gouttière d'essai, contact formation, consentement CGU requis)
- [x] Devenir certifié : formulaire 6 champs + règle métier affichée (médecins déjà formés référencés directement)
- [x] Centre de téléchargement : 3 documents seedés (« Bientôt disponible » tant que les PDF client manquent) + bloc matériel marketing
- [x] FAQ Médecin : accordéons (1 seule réponse fournie dans les sources, seedée) + CTA WhatsApp/customer@
- [x] Emails de notification (cas + certification) vers customer@cleartrack.ma
- [x] Admin : ressources Demande Cas (statuts nouveau/en-étude/devis-envoyé/accepté/clos), Demande Certifications, Telechargements
- [x] Tests bout-en-bout réels : cas soumis avec 9 fichiers (stockés privés) ✓, certification enregistrée ✓, emails loggés ✓
- [x] Vercel mis à jour (formulaires en mode démo)
- [ ] En attente client : réponses des ~19 questions FAQ Médecin + les 3 PDF (prescription, consentements)
## ✅ Étape 6 — Carrousels résultats/témoignages + médias (TERMINÉE — vérifiée le 17/07/2026)
- [x] Composant `<x-carousel>` réutilisable (Alpine) : flèches rondes + points (design PPT), clavier/swipe-friendly, responsive (1 slide mobile / 3 desktop pour Résultats, 1/2 pour Témoignages), testé en réel (clics flèches + points → transform/index corrects, clamp aux bornes, recalcul au resize)
- [x] Carrousel Résultats : 6 cas nommés du PPT (Yassine, Wafae, Noureddine, Rania, Marwa, Ayman) — **vraies photos avant/après intégrées** (corrigé le 17/07 : extraites directement du ZIP/XML du PPT, elles étaient au format WebP non supporté par l'extracteur initial — voir CONTENT-DECISIONS.md D14)
- [x] Carrousel Témoignages : Tarik J + Nouha S
- [x] Vidéo « Comment ça marche » intégrée (kit média officiel du client, `Vidéos/how it works.mp4`, 77s) via façade cliquable (poster + bouton play, `<video>` chargée seulement au clic) — testée : lecture OK
- [x] Composant `<x-video-facade>` réutilisable
- [x] **Décision de contenu (voir CONTENT-DECISIONS.md D14-D16)** : PAS de fausses photos avant/après. Les cartes Résultats affichent honnêtement « Photo à venir » (icône appareil photo) tant que le cabinet n'a pas transmis de vraies photos avec consentement patient écrit. Les dossiers `Other illustations.zip` et `WEB ILLUSTRATIONS.zip` ne contiennent QUE des photos de tiers/concurrents (Invisalign, Spark, SDAlign, Acceledent, Orthosnap) — **jamais utilisées**, risque de marque/déontologie médicale.
- [x] Vercel mis à jour : vidéo + carrousels vérifiés en production
- [ ] En attente client : vraies photos avant/après consenties (6 cas) + éventuellement d'autres vidéos du kit (Impression.mp4, Pose des attachements.mp4) à intégrer sur les pages ressources Espace Médecin si le client les valide

## ✅ Étape 7 — SEO, accessibilité, performance, sécurité, tests (TERMINÉE — vérifiée le 17/07/2026)
- [x] **SEO** : meta title/description dynamiques par page, `<link rel="canonical">`, Open Graph + Twitter Card, `/sitemap.xml` (17 pages + articles publiés), `/robots.txt` (bloque /admin), JSON-LD **Dentist/Organization** sur toutes les pages (nom, adresse, téléphone), JSON-LD **FAQPage** sur /faq, JSON-LD **Article** sur les pages de blog — vérifiés en réel (curl + navigateur)
- [x] **Accessibilité — vraie non-conformité trouvée et corrigée** : le bleu de marque #2A9EFC en texte blanc ne fait que 2,84:1 de contraste (WCAG AA exige 3:1 minimum même en grand texte). Calcul vérifié par script. Créé `.bg-waves-dark` (brand-700 #1667D5, 5,34:1 conforme AA texte normal) appliqué à la nav et au footer (texte petit, usage fréquent) ; les sections héros gardent le bleu de marque exact du PPT (gros titres en gras, écart minime). Vérifié visuellement : toujours perçu comme « bleu ClearTrack », transition non choquante
- [x] Skip-link « Aller au contenu », landmarks sémantiques, `aria-label`/`aria-expanded`/`aria-current` sur nav mobile, accordéons et carrousels (déjà en place depuis les étapes précédentes), focus visibles sur tous les boutons/liens
- [x] **Performance** : lazy-loading sur toutes les images non critiques, `fetchpriority="high"` sur le héros, vidéo en façade cliquable (chargement différé), build Vite minifié (JS 46 Ko gzip 16 Ko / CSS optimisé)
- [x] **Sécurité** : middleware `SecurityHeaders` (X-Content-Type-Options, X-Frame-Options, Referrer-Policy, Permissions-Policy, HSTS si HTTPS), CSRF Laravel par défaut, rate limiting sur tous les formulaires POST (déjà en place), fichiers uploadés stockés hors racine web avec noms aléatoires (déjà en place), session `http_only`/`same_site=lax`
- [x] **Tests automatisés** : suite PHPUnit créée de zéro — **33 tests, 70 assertions, 100% de réussite** : les 16 pages publiques (200), sitemap/robots, 404, redirection admin non connecté, formulaire RDV (validation, succès + email + fichiers, honeypot anti-spam, throttle 429), formulaire cas médecin (consentement requis, 9 fichiers requis, rejet fichier .exe, email), formulaire certification, filtrage FAQ par groupe/statut actif, filtrage blog par statut publié + 404 sur brouillon, présence des schémas structurés
- [x] Style de code : Pint repassé (0 souci) après ajout de tout ce code
- [x] Vercel mis à jour (nav/footer contraste corrigé)

## Correction post-Étape 7 (17/07/2026)
- [x] **Section « 5 qualités » (PPT slide 3) reconstruite** : le client a repéré que j'avais remplacé le vrai design (photo de l'aligneur annotée avec lignes de rappel vers Amovible/Hygiénique/Confortable/Discret/Efficace) par une simple grille de cartes. Corrigé : diagramme annoté fidèle au PPT sur desktop/tablette (photo transparente + lignes SVG + labels positionnés), repli en liste simple sur mobile (le diagramme annoté ne fonctionne pas sur petit écran). Vérifié visuellement aux deux tailles.

## ✅ Animations premium (17/07/2026)
- [x] **Dépôt Git initialisé** — commit de sauvegarde `75c91ff` avant toute animation (restauration en un clic : `git reset --hard 75c91ff`)
- [x] Révélation douce au défilement (cartes/titres/images, IntersectionObserver, une fois) — exclut le contenu des carrousels (bug trouvé et corrigé : les diapositives hors champ ne croisaient jamais le viewport et restaient bloquées invisibles)
- [x] Héro : cascade titre→sous-titre→CTA au chargement + flottement subtil de l'aligneur
- [x] Cartes : soulèvement + ombre au survol · Boutons : élévation + scale 1.02 (bug trouvé et corrigé : la classe `.btn` n'existe jamais dans le HTML rendu à cause de `@apply`)
- [x] Accordéon FAQ/annuaire : x-collapse réactivé, expansion fluide mesurée et confirmée (20→72→132px sur ~300ms)
- [x] `prefers-reduced-motion` : tout désactivé, vérifié par émulation
- [x] Vérification via Playwright (scroll réel complet, hover, accordéon, contraste avant/après) — outils de capture habituels indisponibles ponctuellement, contournés proprement
- [x] 33/33 tests toujours au vert, Pint propre, aucune mise en page modifiée
- [x] Commit `c278846` + Vercel mis à jour

## ✅ Étape 8 — Retours de réunion client (08/08/2026)

### Contenus débloqués (ne dépendaient en fait pas du client)
- [x] **FAQ Médecin : les 20 réponses seedées** — le constat de l'Étape 5 (« une seule réponse fournie ») était faux : `CLEARTRACK - Part 2.docx` contient une section FAQ praticien couvrant toutes les questions du PPT. Voir CONTENT-DECISIONS.md **D17**
- [x] Accordéon rendu multi-paragraphes (les réponses longues ne forment plus un bloc unique) — bénéficie aussi à la FAQ patient
- [x] **Liens « voir exemple »** : schémas de cadrage vectoriels + consignes de prise de vue pour les 12 types de photos (6 patient, 10 médecin), sans fabriquer de fausses photos de patients — **D18**
- [x] Bug corrigé : le formulaire médecin acceptait les PDF côté validation mais le sélecteur de fichiers les masquait (`accept` codé en dur sur JPG/PNG)

### Phase 1 — Navigation et mise en page
- [x] Logo → accueil (déjà en place), **« Accueil » ajouté en premier élément** de la nav (desktop + mobile, icône maison)
- [x] Nav **et** footer repassés au bleu exact du PPT `#2A9EFC` — **arbitrage assumé contre le contraste WCAG AA, voir D19**
- [x] **Accueil : alternance stricte bleu/blanc** sur les 10 sections — héro bleu, avant-dernière blanche, footer bleu, conformément à la réunion
- [x] **Fond à vagues étendu à tout le site** : l'alternance n'avait été appliquée qu'aux 5 pages retravaillées (accueil, pourquoi, à propos, avantages, cas traitables) ; 14 autres pages gardaient des sections blanches nues. Les 16 sections concernées passent en `.bg-waves-light` (CGU, confidentialité, blog + article, FAQ, fabrication ×2, instructions, prendre RDV, les 5 pages Espace Médecin, `_stub`). Le fond est porté par une section pleine largeur avec le conteneur centré à l'intérieur — sinon les courbes s'arrêtent à la largeur du conteneur et laissent des marges blanches. Sur `prendre-rdv`, les deux blocs contigus partagent **un seul** fond, pour éviter une cassure du motif à la jointure
- [x] **Fond à courbes de niveau passé en vectoriel** : les PNG du PPT sont remplacés par `bg-waves-{blue,landscape,dark}.svg`, **relevés** sur ces PNG (seuillage → squelettisation Zhang-Suen → suivi directionnel → Douglas-Peucker → Bézier Catmull-Rom). La géométrie reste celle du client — ce n'est pas un motif redessiné. 27 tracés, épaisseur de trait 10,5 mesurée sur l'original. Couleurs et épaisseur désormais modifiables en 3 valeurs dans le `<style>` de chaque SVG. Chaîne de production et mode d'emploi dans `outils/waves/`. Poids : 321 Ko → 106 Ko (16,5 Ko gzip) pour le fond bleu, et le motif devient net à toute résolution
- [x] **Fond recontrôlé contre le PowerPoint** : palettes relevées dans `ppt/media/image1.png` (#1586C8 / #248ACA) et `image8.png` (#FFFFFF / #F6FAFD) — nos trois SVG portent exactement ces teintes. Vérifié aussi qu'`image1` et `image8` sont bien **le même dessin** (accord 96,3 %, IoU 74 % — un hasard donnerait ~6 %), ce qui valide une géométrie unique pour les deux nuanciers. Le PPT n'applique **aucun effet de couleur** (ni duotone, ni blend) : les images sont posées telles quelles
- [x] **Étirement du PPT reproduit** — le motif est écrasé verticalement à 79,7 %, comme sur les diapositives 16:9 — **D26**. Contrôle bout en bout contre le PPT : **accord pixel à pixel 98,8 %, IoU des traits 90,0 %**
- [x] **Dérive lente du fond** (version animée uniquement) : le motif monte et descend sur 28 s, seulement sur les sections visibles à l'écran (IntersectionObserver). `background-size` reste figé — l'animer forcerait une re-rastérisation des 27 tracés à chaque image. Nav et pied de page exclus. L'état de repos vaut `center`, identique à la version statique
- [x] Favicon vérifié dans le `<head>`
- [x] **Échelle typographique recalée sur le PPT** (titres de section 52 px, titres de page 48 px, sur-titre héro 40 px) — **D22**

### Phase 2 — Contenus
- [x] **Page « Pourquoi » : les 3 atouts** de la réunion (Clarté « sans stries » / Confort « bords polis à la main » / Durabilité « ne jaunit pas »), en fonds alternés
- [x] **« Casser la grille »** : images qui débordent réellement de leur section (débordement mesuré : 20 à 60 px en haut et en bas) + photo statique qui sort par le côté gauche
- [x] **Nouvelle page `/instructions`** (page dédiée, liée dans la nav et le footer) : système de signets à 4 catégories — mise en place, retrait, rangement/entretien, alimentation. Contenu tiré des documents client, pas inventé
- [x] Page ajoutée au sitemap

### Phase 3 — Animations (version animée par défaut, version statique en un réglage)
- [x] **Écran d'ouverture au logo** (accueil, une fois par session, 1,3 s, retiré du DOM ensuite)
- [x] **Effet « machine à écrire » au défilement** sur les puces (Pourquoi + accueil) — révélation mot à mot : le texte reste intégralement dans le DOM (SEO + lecteurs d'écran)
- [x] Bug trouvé et corrigé : la cible portant `clip-path: inset(0 100% 0 0)` n'est jamais « intersecting » — elle ne pouvait pas déclencher sa propre animation. C'est désormais un conteneur non découpé qui est observé
- [x] Bug trouvé et corrigé : les éléments en `display:none` à la largeur courante (blocs `md:hidden`) restaient à `opacity: 0` après redimensionnement
- [x] **Deux versions livrables** : `CLEARTRACK_ANIMATIONS=false` (ou retrait de `animations.css`/`animations.js` du `vite.config.js`) donne la version statique. **Vérifié : hauteur de page identique au pixel près** entre les deux modes
- [x] `prefers-reduced-motion` respecté par toutes les nouvelles animations

### Phase 4-5 — Responsive, médias
- [x] **Audit responsive automatisé** : 11 pages × 375 / 768 / 1440 px → aucun défilement horizontal, aucune erreur console
- [x] `overflow-x: clip` sur `html` **et** `body` (sur `body` seul la barre horizontale réapparaît ; `hidden` casserait la nav sticky)
- [x] Emplacement voix off prêt (`public/assets/audio/presentation.mp3`), lecture manuelle — **D21**

### Problèmes de contenu détectés et corrigés
- [x] **Filigrane de banque d'images** sur `photo-sourire-1.jpg`, publiée sur l'accueil et le blog → retirée et remplacée — **D20**
- [x] **Publicité comparative Spark (Ormco)** servie publiquement sous `/assets/ppt/` → sortie de la racine web — **D20-bis**
- [x] Test automatisé ajouté pour empêcher la réapparition de ces fichiers

### Vérifications
- [x] **40 tests, 91 assertions, 100 % de réussite** (33 → 40 : page instructions, onglets, nav, bascule animée/statique, absence de visuels tiers)
- [x] Pint propre

## ✅ Audit de conformité au PowerPoint (09/08/2026)
- [x] **Les 89 diapos recomparées phrase à phrase au site rendu** (script de couverture : runs `<a:t>` du PPT vs texte des 18 pages de l'aperçu, correspondance par fenêtres de 6 mots pour absorber les coupures de balises). **383 phrases de plus de 30 caractères → 382 présentes.**
- [x] **Structure : 12 sections du deck → 12 routes**, aucune manquante (Accueil, Pourquoi, Avantages, Blog, FAQ, À propos, Cas traitables, Fabrication, Confidentialité, CGU, Prendre RDV, Espace Médecin + ses 4 onglets)
- [x] Faux positifs écartés un par un après vérification : les 21 villes de l'annuaire sont bien seedées (rendues en boutons séparés), les 12 libellés de photos existent avec un trait d'union, la section 4 de la politique de confidentialité est complète (12 points), le chrome de gabarit (nav, pied de page, copyright) est présent mais découpé en éléments distincts
- [x] **Le PowerPoint ne contient aucune animation** : recherche exhaustive de `p:transition`, `p:timing`, `animEffect`, `animMotion`, `p:anim`, `videoFile`, `p:audio` sur **toutes** les parties XML du fichier → **0 occurrence**. Les 89 diapos sont statiques. Les animations du site ne viennent donc pas du deck mais de la réunion client (Phase 3, Étape 8)
- [ ] **Seul écart réel : la question FAQ de la diapo 38** — voir **D28**, réponse à obtenir du client

## ✅ Retours client du 25/08/2026

### Échelle et couleurs (tout le site)
- [x] **Site ramené à 90 %** : posé d’abord à 80 % comme demandé, remonté après relecture du client (« a bit smaller ») — une seule règle `html { font-size: 90% }`, toute la maquette étant en `rem` — D34
- [x] **Boutons agrandis** en compensation (`.btn` : `text-base px-7 py-3`) — D34
- [x] **Le bleu des textes devient le bleu des fonds** (`#1586C8`) ; les aplats et boutons gardent `#2A9EFC` — D35

### Accueil
- [x] Héro : « Choisissez » remonte sur la ligne de **SANS FIL**, le **logo** remplace le texte « ClearTrack Align » — D36
- [x] Héro : les deux boutons passent au gabarit `.btn-grand`
- [x] **Les cinq qualités de la diapo 3 rétablies** (Amovible, Hygiénique, Confortable, Discret, Efficace), aux coordonnées exactes du PPT — D37
- [x] **Les cinq se déploient au clic** : les explications de Hygiénique, Confortable et Discret retrouvées dans `CLEARTRACK - Part 2.docx` et la page Avantages — D54
- [x] « En savoir plus » de la diapo 3 → page **Fabrication** (au lieu de Pourquoi) — D38
- [x] « Votre Sourire est Magnifique ! » : **soulignement retiré** — D39
- [x] Photo du bloc sourire : plus agrandie au-delà de sa définition native (473 px) — D39

### Pourquoi
- [x] **Main gantée à l'horizontale**, comme le `rot="270°"` de la diapo 18 — D40
- [x] **Main gantée poussée jusqu'au bord droit de l'écran** (utilitaire `.bleed-right`) : le PPT la pose de 60 % à exactement 100 % — D55
- [x] **Rendu 3D agrandi** (32/44 rem) et débordant jusqu'au bord gauche, comme le x = −29,48 % de la diapo 19 — D41
- [x] Comparatif matériau : **une seule section, barre de bascule supprimée** — D42

### À propos
- [x] « Nos standards » : **fond bleu retiré**, section en blanc à courbes — D43
- [x] « Nous aimons votre sourire ! » : photo affichée à sa définition native, sans étirement ni recadrage — D44

### Fabrication (« Comment sont-ils fabriqués ? »)
- [x] **Visuel de la diapo 52 rétabli** dans l'en-tête — D45
- [x] **Icônes docteur et microscope** de la diapo 54 sur « Étapes cliniques » / « Étapes de laboratoire » — D46
- [x] **Coches remplacées par des numéros** (`<ul>` → `<ol>`), ici et sur « Instructions de base » — D46
- [x] **Procédure de laboratoire : chaque texte avec sa photo** du PPT ; le portrait de dentiste retrouve sa place sur « Instructions de base » — D47

### Politique de confidentialité
- [x] **Bandeau photo + logo** de la diapo 59 en en-tête — D48

### Prendre RDV
- [x] **GIF de la diapo 70** à droite du titre, avec image fixe en version statique et sous `prefers-reduced-motion` — D49
- [x] **Fond du GIF détouré** (20 images, remplissage depuis les bords) : il formait un rectangle gris clair sur le bandeau bleu — D49
- [x] **Étoiles sur les six photos**, et validation serveur qui les exige réellement — D50
- [x] **Casablanca alignée sur Mohammedia** : les 3 fiches placeholder « Dr. M. XXXXX » sont supprimées, et le seeder rejoué sur la base de dev — D51

### Suppressions
- [x] Page **« Instructions d'utilisation »** retirée (route, gabarit, liens, sitemap, tests) — D52
- [x] Page **« Aligner Care Instructions »** retirée — D52
- [x] **Blog masqué** derrière `CLEARTRACK_BLOG` (défaut `false`) : plus de lien, plus de sitemap, URL en 404 — D53

### Vérifications
- [x] `php artisan test` — **42 tests, 120 assertions, tout au vert** (4 nouveaux tests : photos obligatoires ×2, pages d'instructions retirées, blog masqué puis rallumé)
- [x] `./vendor/bin/pint` — aucun écart de style
- [x] `npm run build` — build Vite propre
- [x] Statuts HTTP relevés page par page : les 6 pages modifiées en 200, `/blog`, `/instructions` et `/aligner-care-instructions` en 404
- [x] Aucune référence morte : plus aucun `route('instructions')`, `route('aligner-care')` ni `text-brand-500/600/700`

### Retours du 26/08/2026 (suite)
- [x] **Échelle remontée de 80 % à 90 %** après relecture du client (« a bit smaller ») — D34
- [x] **Tous les boutons +7 %** (`.btn` et `.btn-grand`, valeurs écrites en clair) — D56
- [x] **Nav à la même taille que le reste** : libellés au corps de texte, bouton « Espace Médecin » au gabarit standard — D56
- [x] **Logo du héro centré** sur le bloc de texte (conteneur `inline-block`) — D56
- [x] **Les 7 traits de la diapo 3 relevés dans le PPT** : Amovible et Hygiénique retrouvent leur segment diagonal, aucun trait ne touche une lettre, les pastilles sont ancrées par leur centre — D59
- [x] **L'explication revient dans le cadre**, en bande basse sur voile bleu — D60
- [x] **« Nos standards » : fond bleu rétabli**, photo au bord droit et bord gauche estompé (`.fondu-gauche`) — D43 corrigée
- [x] **En-tête Fabrication en bandeau pleine largeur**, recadré comme le PPT (ratio 3,26), titre en dessous — D57
- [x] **GIF à 30 % (225 px) et boucle accélérée** (200 ms → 120 ms) ; fichier 440 Ko → 338 Ko — D61
- [x] **Page « Instructions d'utilisation » rétablie** en français, sur la mise en page de l'ancienne page anglaise — D58 (annule en partie D52)
- [x] `php artisan test` — **45 tests, 128 assertions, tout au vert**

### Performance (26/08/2026)
- [x] **Toutes les images redimensionnées** à ~2× leur taille d'affichage (certaines étaient servies à 3700 px pour une vignette de 264 px) — D62
- [x] **Photos détourées PNG → WebP** (alpha conservé, ~10× plus léger) ; deux PNG sans transparence → JPEG (−94 % et −87 %) — D62
- [x] **GIF de la page RDV → WebP animé** : 338 Ko → 102 Ko, cadence et transparence vérifiées dans les chunks ANMF — D62
- [x] **Accueil : 5 073 Ko → 1 019 Ko d'images (−80 %)** ; racine web 50 Mo → 22 Mo — mesuré page par page
- [x] **15,8 Mo jamais servis déplacés** hors de `public/` vers `storage/app/medias-origine/non-utilises/` (n'accélère pas les pages, allège le déploiement) — D63
- [x] Logo du pied de page en chargement différé ; dimensions posées sur les images pour éviter les sauts de mise en page
- [x] Main gantée bridée à sa définition réelle : elle était affichée à 178 % et donc floue — D64
- [x] `php artisan test` — **45 tests, 128 assertions** ; aucune image manquante après renommage

### Performance, 2e passe (26/08/2026)
- [x] **Poppins auto-hébergée** (44 Ko, 5 graisses, sous-ensemble latin) : plus aucune requête tierce bloquante dans le `<head>` — D66
- [x] **116 Ko de police fantôme supprimés** : `Instrument Sans` était construite et déployée alors que le site n'utilise que Poppins — D66
- [x] **Graisse 400 préchargée** (`crossorigin`, sinon double téléchargement)
- [x] **En-têtes de cache Vercel** : `/build/*` immutable 1 an (noms empreintés), `/assets/*` 7 jours — D67
- [x] **Trois photos agrandies par IA** à la demande du client, détourage réappliqué ; réserve sur les visages reconstruits acceptée — D68
- [x] **Pictogramme « Manger et boire » rendu visible** : il était blanc sur fond blanc — D65
- [x] Chemin critique : **192 Ko non compressé** (HTML + CSS + JS + police)

### Retours du 27/08/2026
- [x] **Héro** : « SANS FIL » et « Choisissez » à la même taille, « ! » retiré après le logo, logo agrandi (h-16/h-24 → h-20/h-28) — D69
- [x] **« En savoir plus »** : section des 5 qualités → Avantages (au lieu de Fabrication) ; section Dentistes experts → Fabrication (au lieu de la prise de RDV) — D69 (révise D38)
- [x] **Étape 1 « Consultation gratuite »** → « Consultation gratuite chez le dentiste » — D70 (interprétation à confirmer)
- [x] **Cas traitables** : logo retiré de l'en-tête, nom de marque repris en texte — D69
- [x] **« Traitement orthodontique invisible »** : les 3 boutons alignés en largeur égale (`w-full` dans `max-w-sm`) — D69
- [x] **Pied de page** : adresse postale retirée, téléphone et e-mail conservés — D69
- [x] **Instructions** : 2 onglets ajoutés (« Porter vos aligneurs », « Hygiène ») d'après la maquette française du client ; « Mettre en place » perd son 4e point (chewies) ; « Retirer », 2e point reformulé — D71
- [x] **Fabrication — Étapes cliniques** : points 3 et 4 remplacés (« Photographies intra et exobuccales » ; « Radiographie panoramique et de profil ») — D72
- [x] **Espace Médecin** : coche verte au lieu de bleue (liste des services) — D73
- [x] **Espace Médecin — Démarrer un traitement** : étoiles retirées des intitulés de photos, validation serveur inchangée — D73
- [x] Test `test_les_quatre_categories_d_instructions_sont_presentes` renommé et étendu à 6 catégories
- [x] **Page RDV** : animation remontée à sa résolution native (225 px → 450 px), repli statique inclus — D75
- [x] **Page RDV** : animation encore agrandie de 50 % (450 px → 675 px), au-delà de sa résolution native — D76 (perte de netteté possible, à surveiller)
- [x] **Page RDV** : animation doublée (675 px → 1350 px, 3× la résolution native) — D77, flou probable signalé au client
- [x] `./vendor/bin/pint --test` — aucun écart de style
- [x] `php artisan test` — **45 tests, 130 assertions, tout au vert**

### Retour du 28/08/2026 — dossier « Last pics »
- [x] **Reçu directement dans la conversation** (zip, 20,8 Mo) — le Drive restait inaccessible depuis le compte connecté (D74)
- [x] **Instructions : 4 photos posées** (Porter vos aligneurs, Rangement et entretien, Manger et boire, Hygiène) en WebP dans `public/assets/instructions/`, à la place des rendus 3D/pictogrammes génériques — D78
- [x] **Page RDV : animation remplacée** par le fichier source `gif/x2.gif` du client (1500 × 1018) — à 1350 px d'affichage (D77), le flou signalé est résolu sans agrandissement CSS au-delà du fichier — D78

### Retour du 29/08/2026 — optimisation mobile
- [x] **Main gantée et rendu 3D (Pourquoi), photo « Nos standards » (À propos)** : nouvelles classes `.bleed-mobile-left`/`-right` (app.css), elles touchent désormais le bord de l'écran sur mobile au lieu de rester centrées avec un espace — D79
- [x] **Espacements verticaux resserrés sous `sm:`** sur 40 sections (9 pages) — valeur desktop/tablette inchangée à partir de `sm:`/`md:` — D79
- [x] **Boutons** : audit du code des groupes de CTA, tous déjà en `flex-wrap`/`flex-col` sous leur point de bascule — aucune anomalie trouvée
- [x] `./vendor/bin/pint --test`, `php artisan test` (45 tests, 130 assertions) et `npm run build` — tout au vert
- [x] **Vérifié en émulation mobile réelle** (Chrome DevTools, 390 px) une fois la connexion établie : les 3 images touchent bien le bord, aucun chevauchement image/texte sur les 15 pages publiques
- [x] **Photo « aligneur tenu entre deux doigts » (accueil mobile)** : recadrée à part (`slide04_0-mobile.webp`) — le fichier partagé avec le diagramme desktop avait un vide transparent de 48 % à droite, invisible au code mais visible à l'écran — D80

## En attente du client (bloquants réels)
- [ ] **Réponse à « Pourquoi ne pas me faire livrer directement chez moi et devoir passer chez un dentiste ? »** (seule question du PPT absente du site — D28)
- [ ] Les **3 PDF** du centre de téléchargement (fiche de prescription, consentement éclairé, consentement contention)
- [ ] **Vraies photos avant/après** consenties par écrit (6 cas) — les cartes actuelles utilisent les photos du PPT
- [ ] **Vraies fiches cabinets** ville par ville — l'annuaire est désormais entièrement vide, les placeholders de Casablanca ayant été retirés (D51)
- [ ] **URL des réseaux sociaux** (Facebook / YouTube / Instagram — actuellement `href="#"`)
- [ ] **Fichier audio de la voix off** (+ préciser : piste seule ou bande sonore d'une vidéo à monter ?)
- [ ] Validation de l'usage des vidéos `Impression.mp4` et `Pose des attachements.mp4` sur l'Espace Médecin
- [ ] **Deux photos en haute définition** : la patiente du bloc « Votre Sourire est Magnifique ! » (473 px aujourd'hui, D39) et les trois jeunes femmes de « Nous aimons votre sourire ! » (600 × 600, D44) — ni le PPT ni les 11 documents Word ne contiennent mieux
- [ ] Arbitrages à confirmer : **D17-bis** (délais devis), **D19** (contraste nav), **D22** (corps de texte 20 px vs 24 px), **D34** (corps de texte à 14,4 px après la réduction à 90 %), **D54** (rattachement des cinq explications de la diapo 3), **D50** (photos du RDV obligatoires — un patient sans photos ne peut plus réserver)
- [ ] **Confirmer l'étape 1 « Consultation gratuite chez le dentiste »** — formulation client ambiguë, interprétation appliquée à valider (D70)
- [ ] **Arbitrer la contradiction dentifrice** entre les onglets « Hygiène » (dentifrice non abrasif) et « Rangement et entretien » (pas de dentifrice) de la page Instructions (D71)
- [ ] **Confirmer si les photos « Démarrer un traitement » doivent rester obligatoires** malgré la disparition du marqueur * (D73)

## Étape 9 — Déploiement Heberjahiz
