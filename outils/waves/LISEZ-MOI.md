# Fond à courbes de niveau — chaîne de vectorisation

Les fonds `.bg-waves`, `.bg-waves-light` et `.bg-waves-dark` s'appuient sur
`public/assets/brand/bg-waves-*.svg`. Ces SVG ne sont **pas un motif redessiné** :
ce sont les **axes médians relevés** sur le PNG du PowerPoint client. La forme
est donc celle de la maquette, au pixel près — seule la représentation change
(vecteur au lieu de bitmap).

## Modifier l'aspect sans rien régénérer

C'est le cas courant. Ouvrir le `.svg` : tout est dans le bloc `<style>` en tête
de fichier.

```
.fond  { fill: #1586c8; }                          ← couleur de fond
.trait { stroke: #248aca; stroke-width: 10.5; }    ← couleur et épaisseur des courbes
```

`stroke-width` est exprimé dans le `viewBox` (2474 × 1394,81). **10.5 est la valeur
mesurée sur les PNG d'origine** — la changer écarte du rendu PPT.

### L'étirement vertical (`scale(1 0.79749)`)

Le groupe des tracés porte un `transform="scale(1 0.79749)"`. Ce n'est pas un
choix esthétique : **la maquette n'affiche pas l'image à ses proportions natives**.
Elle la fait pivoter de 90° (`rot="5400000"`) puis l'étire sur la diapositive
entière (`<a:stretch><a:fillRect/>`), qui est en 16:9 — le motif y est donc écrasé
verticalement.

| | rapport largeur/hauteur |
|---|---|
| cadre rendu dans le PPT (12 192 000 × 6 873 696 EMU) | 1,7737 |
| image à ses proportions natives (2474 × 1749) | 1,4145 |
| **écrasement appliqué** | **0,79749** |

La diapositive 5 (fond clair) donne 0,7906 — même traitement à 1 % près.

L'écrasement porte sur le groupe, pas sur les coordonnées : le trait devient donc
**elliptique**, plus fin à l'horizontale qu'à la verticale. C'est exactement ce que
produit l'étirement d'un bitmap, et c'est donc fidèle.

**Pour revenir aux proportions natives** : mettre `ETIREMENT` à 1 dans
`emettre-svg.php` et régénérer (le `viewBox` suit automatiquement), ou éditer les
deux valeurs dans le SVG (`scale(1 1)` et `viewBox="0 0 2474 1749"`).

Les trois nuanciers actuels :

| Fichier | Fond | Courbes | Usage |
|---|---|---|---|
| `bg-waves-blue.svg` | `#1586c8` | `#248aca` | `.bg-waves` — sections bleues |
| `bg-waves-landscape.svg` | `#ffffff` | `#f6fafd` | `.bg-waves-light` — sections blanches |
| `bg-waves-dark.svg` | `#1667d5` | `#256bd7` | `.bg-waves-dark` — tenu prêt si D19 s'inverse |

## Régénérer la géométrie

Nécessaire seulement si le client fournit un nouveau fond, ou pour retoucher la
finesse du relevé. PHP avec GD suffit, aucune dépendance.

```bash
cd outils/waves

# 1. Relever les tracés (le 3e argument est le facteur de réduction : 1 = pleine résolution)
#    Les PNG d'origine du PPT sont conservés dans source/ — hors de public/,
#    puisqu'ils ne sont plus servis depuis que les SVG les remplacent.
php vectoriser.php source/bg-waves-blue.png traces.json 1

# 2. Écrire les trois nuanciers
php emettre-svg.php traces.json ../../public/assets/brand

# 3. Vérifier : rastérise les VRAIES courbes de Bézier du SVG, à comparer à l'original
php verifier.php traces.json verif.png 0.8 10.5
```

### Réglages du relevé (`vectoriser.php`)

| Constante | Rôle | Effet si on l'augmente |
|---|---|---|
| `SEUIL` | luminance séparant trait et fond | trop haut : traits perdus |
| `POOL` | réduction avant squelettisation | plus rapide, mais **fusionne les courbes serrées** — garder 1 |
| `COS_MIN` | virage max toléré en suivant un trait | trop bas : le tracé saute sur la courbe voisine |
| `EPS` | tolérance Douglas-Peucker | fichier plus léger, courbes plus anguleuses |
| `LONG_MIN` | longueur minimale d'un tracé | supprime plus de barbules… et de vraies petites boucles |

### Pourquoi ces valeurs

- **`POOL = 1`.** À `POOL = 2`, le max-pooling soude les courbes distantes de
  2-3 px en haut à gauche : la squelettisation n'en tire alors qu'un seul axe et
  le motif s'appauvrit visiblement dans cette zone.
- **`COS_MIN = 0.6`.** Sans critère de direction, arrivé au bout d'une courbe le
  suivi sautait sur la voisine et fabriquait des ponts : 44 905 px de squelette
  se retrouvaient dans 30 polylignes au lieu de ~800. Une courbe de niveau étant
  lisse, elle ne tourne quasiment pas d'un pixel au suivant ; exiger cos ≥ 0,6
  (virage ≤ 53°) coupe les sauts sans tronquer les vraies courbes.
- **Lissage Catmull-Rom.** Les polylignes simplifiées sont converties en Béziers
  cubiques (tension 1/6). `verifier.php` existe pour contrôler que ce lissage ne
  produit ni dépassement ni boucle parasite — il rastérise les mêmes points de
  contrôle que ceux écrits dans le SVG.
