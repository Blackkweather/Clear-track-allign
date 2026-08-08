<?php

namespace App\Support;

/**
 * Consignes de cadrage affichées derrière chaque lien « voir exemple » des zones d'upload.
 *
 * Le PPT client ne contient aucune photo d'exemple (les liens « voir exemple » y sont des
 * placeholders) et aucune source ne fournit de cliché exploitable. Plutôt que de publier de
 * fausses photos de patients, on illustre le cadrage attendu par un schéma vectoriel neutre
 * accompagné de consignes de prise de vue. Voir CONTENT-DECISIONS.md D18.
 */
class GuidesPhotos
{
    /**
     * type => [titre affiché, consignes de prise de vue]
     *
     * @return array<string, array{titre: string, consignes: list<string>}>
     */
    public static function all(): array
    {
        return [
            'visage_souriant' => [
                'titre' => 'Visage de face, sourire',
                'consignes' => [
                    'Patient de face, tête droite, regard vers l’objectif.',
                    'Sourire large et naturel, dents visibles.',
                    'Cadrez du haut du front au bas du menton, sans couper les oreilles.',
                ],
            ],
            'face_fermee' => [
                'titre' => 'Visage de face, bouche fermée',
                'consignes' => [
                    'Patient de face, tête droite, regard vers l’objectif.',
                    'Lèvres jointes au repos, sans forcer ni serrer.',
                    'Même cadrage que la photo de face souriante.',
                ],
            ],
            'profil_droit' => [
                'titre' => 'Visage de profil droit, bouche fermée',
                'consignes' => [
                    'Patient tourné à 90°, côté droit face à l’objectif.',
                    'Lèvres jointes au repos, regard à l’horizontale.',
                    'Dégagez l’oreille et le contour du menton (cheveux attachés si besoin).',
                ],
            ],
            'profil_gauche' => [
                'titre' => 'Visage de profil gauche, bouche fermée',
                'consignes' => [
                    'Patient tourné à 90°, côté gauche face à l’objectif.',
                    'Lèvres jointes au repos, regard à l’horizontale.',
                    'Dégagez l’oreille et le contour du menton (cheveux attachés si besoin).',
                ],
            ],
            'profil_ferme' => [
                'titre' => 'Visage de profil, bouche fermée',
                'consignes' => [
                    'Patient tourné à 90°, lèvres jointes au repos.',
                    'Regard à l’horizontale, tête ni relevée ni baissée.',
                    'Dégagez l’oreille et le contour du menton.',
                ],
            ],
            'intra_face' => [
                'titre' => 'Intra-buccale de face, en occlusion',
                'consignes' => [
                    'Écarteurs en place, dents serrées en occlusion.',
                    'Ligne médiane au centre du cadre, plan occlusal horizontal.',
                    'L’arcade doit occuper toute la largeur de l’image.',
                ],
            ],
            'intra_droite' => [
                'titre' => 'Intra-buccale droite, en occlusion',
                'consignes' => [
                    'Écarteur côté droit, dents serrées en occlusion.',
                    'Le rapport molaire et canin doit être bien visible.',
                    'Cadrez de la canine jusqu’à la dernière molaire visible.',
                ],
            ],
            'intra_gauche' => [
                'titre' => 'Intra-buccale gauche, en occlusion',
                'consignes' => [
                    'Écarteur côté gauche, dents serrées en occlusion.',
                    'Le rapport molaire et canin doit être bien visible.',
                    'Cadrez de la canine jusqu’à la dernière molaire visible.',
                ],
            ],
            'occlusale_maxillaire' => [
                'titre' => 'Vue occlusale du maxillaire',
                'consignes' => [
                    'Miroir occlusal, arcade supérieure, bouche grande ouverte.',
                    'Incisives vers le haut du cadre, arcade complète et symétrique.',
                    'Soufflez sur le miroir pour éviter la buée.',
                ],
            ],
            'occlusale_mandibulaire' => [
                'titre' => 'Vue occlusale de la mandibule',
                'consignes' => [
                    'Miroir occlusal, arcade inférieure, langue rétractée.',
                    'Incisives vers le bas du cadre, arcade complète et symétrique.',
                    'Soufflez sur le miroir pour éviter la buée.',
                ],
            ],
            'radio_panoramique' => [
                'titre' => 'Radiographie panoramique',
                'consignes' => [
                    'Panoramique récente (moins de 6 mois), les deux arcades entières.',
                    'Cliché net et lisible, ni surexposé ni tronqué.',
                    'JPG, PNG ou PDF — un scan ou une photo à plat du cliché convient.',
                ],
            ],
            'teleradio_profil' => [
                'titre' => 'Téléradiographie de profil',
                'consignes' => [
                    'Facultative : utile pour les cas complexes ou en croissance.',
                    'Profil complet, du vertex au menton.',
                    'JPG, PNG ou PDF.',
                ],
            ],
        ];
    }

    /** @return array{titre: string, consignes: list<string>}|null */
    public static function pour(string $type): ?array
    {
        return self::all()[$type] ?? null;
    }
}
