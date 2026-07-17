# ClearTrack — Journal des décisions de contenu

Chaque choix fait sur un point ambigu/conflictuel des sources est consigné ici pour validation client.
Règle : le PowerPoint (déc. 2021) fait foi ; à défaut, le document Word le plus récent.

| # | Sujet | Décision appliquée | Source retenue | À valider |
|---|-------|--------------------|----------------|-----------|
| D1 | Périmètre portail médecin | v1 = formulaires publics (pas de connexion médecin) ; portail type EON ACCESS reporté en v2 | Maquettes PPT (aucun écran de login) | Client (Q1) |
| D2 | Langue | Français uniquement, structure lang/ prête pour AR/EN | Toutes les sources sont FR | Client (Q4) |
| D3 | Stack | Laravel 13 + MySQL (SQLite en dev), hébergeable Heberjahiz mutualisé | Blueprint approuvé | OK (approbation globale) |
| D4 | Nom de l'espace pro | « Espace Médecin » | PPT | Client (conflit 8) |
| D5 | Numéro WhatsApp | +212 693 133 170 (wa.me) | Seul numéro fourni | Client (Q8) |
| D6 | Réseaux sociaux | Icônes FB/YouTube/Instagram avec href="#" en attendant les URLs | PPT (icônes présentes) | Client (Q8) |
| D7 | Copyright | « © Cleartrack {année courante} » au lieu de « © Cleartrack 2021 » | Adaptation évidente | Client (info) |
| D8 | Police | Poppins (sans-serif géométrique arrondie, la plus proche des maquettes) | Non spécifiée dans les sources | Client (Q13) |
| D9 | Fond vagues bleu | Image « Base sans logo-1 » en blend multiply sur #2A9EFC (couleur exacte garantie) | Kit de marque + nuancier | OK visuel |
| D10 | Emails cibles des formulaires | À décider avant Étape 4 (customer@ vs contact@) | — | Client (Q6/Q7) |
| D11 | Marques tierces dans les textes fabrication | « Structo » retiré (→ « nos imprimantes 3D MSLA ») ; « Active Aligner » remplacé par Cleartrack® ; version slide 55 (débrandée) retenue | Conflit 9 du rapport | Client (info) |
| D12 | Durée de traitement affichée | « 3 à 12 mois » (page Avantantages) et « résultats visibles en 6 mois en moyenne » (Accueil) = valeurs du PPT | PPT slides 29 et 9 | Client (conflit 3) |
| D13 | Images sections Sourire/Mission | Photos propres du kit (shutterstock/story) au lieu des composites PPT avec texte incrusté coupé | Kit de marque | OK visuel |
| D14 | Photos avant/après (carrousel Résultats) | **Corrigé le 17/07/2026** : les 6 vraies photos existent bien dans le PPT, au format WebP — un format que la librairie python-pptx utilisée en Phase 1 ne sait pas décoder (d'où le faux diagnostic « image cassée »). Extraction directe réussie depuis le XML/ZIP du PPT, ré-identifiées une à une par inspection visuelle et intégrées aux 6 cartes (Yassine=image16, Wafae=image15, Noureddine=image17, Rania=image19, Marwa=image20, Ayman=image18) | Website conception.pptx, slides 9-10 (extraction directe ppt/media/*.webp) | OK — ce sont les propres photos du client dans son design approuvé, pas des images tierces |
| D15 | Contenu de « Other illustations.zip » / « WEB ILLUSTRATIONS.zip » | **Non utilisés.** Ces dossiers contiennent majoritairement des visuels tiers/concurrents (Invisalign, Spark, SDAlign, Acceledent, Orthosnap) et de la documentation de recherche personnelle, pas des assets ClearTrack | Inspection des ZIP | Client (info — à ne jamais publier tel quel) |
| D16 | Vidéo « Comment ça marche » | Auto-hébergée depuis `Vidéos/how it works.mp4` (kit officiel, 77s, façade cliquable) | Kit de marque + référencée dans ACCEUIL.docx | OK — vidéos additionnelles (Impression, Pose des attachements) disponibles si le client valide leur usage sur l'Espace Médecin |
