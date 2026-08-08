<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\Telechargement;
use Illuminate\Database\Seeder;

class EspaceMedecinSeeder extends Seeder
{
    /**
     * FAQ Médecin — questions dans l'ordre du PPT (slides 87-89), réponses issues
     * du document client « CLEARTRACK - Part 2.docx » (section FAQ praticien).
     * Voir CONTENT-DECISIONS.md D17 pour le détail des retouches appliquées.
     *
     * @return array<int, array{0: string, 1: string}>
     */
    private function questionsMedecin(): array
    {
        return [
            [
                'Pourquoi choisir Cleartrack ?',
                "Il y a tellement de traitements d'orthodontie esthétique sur le marché dentaire, alors pourquoi choisir Cleartrack ? L'orthodontie cosmétique est un terme utilisé pour décrire les appareils qui corrigent et alignent les dents pour obtenir un résultat plus esthétique. Les adultes, en particulier, préfèrent l'orthodontie cosmétique aux appareils fixes, car elle leur permet de suivre un traitement en toute discrétion. Cleartrack® est un système d'appareils dentaires transparents idéal pour ces types de cas.",
            ],
            [
                "Pourquoi choisir les aligneurs Cleartrack® plutôt que d'autres aligneurs ?",
                "Grâce aux progrès de la technologie numérique, les systèmes d'aligneurs sont devenus plus populaires et les dentistes ont désormais plus de choix pour leurs patients. Historiquement, il n'y avait qu'un ou deux systèmes disponibles, ce qui entraînait des coûts de laboratoire élevés et de longs délais d'attente pour que les aligneurs arrivent de l'étranger.\nNous fabriquons tout au Maroc. Il n'y a pas de longs délais et nous pouvons vous renvoyer le plan de traitement du patient dans les 7 jours ouvrables suivant l'envoi des empreintes. Lors de la conception de notre système, nous avons écouté certains des meilleurs fournisseurs d'orthodontie cosmétique et avons mis au point un système dans lequel près de 50 % des cas terminent le traitement en moins de 6 mois, et presque tous en moins de 12 mois.",
            ],
            [
                'Quels dossiers dois-je envoyer ?',
                "L'envoi d'un dossier pour l'évaluation et la planification du traitement Cleartrack® ne pourrait pas être plus simple. Tout ce dont nous avons besoin, ce sont des empreintes. Il n'y a pas de frais initiaux ni de cours de formation obligatoires — nous voulons simplement que vous, et votre patient, puissiez commencer le traitement.\nVoici les éléments dont nous avons besoin : des empreintes supérieures et inférieures en silicone (ou similaire), une brève description de la malocclusion du patient et les objectifs du traitement. Parfois, nous demandons également des photos et des radiographies. Elles peuvent être envoyées par courriel ou via le formulaire « Démarrer un traitement ». S'il y a des détails spécifiques concernant le cas (reprise d'empreintes, radio céphalométrique ou enregistrement de l'occlusion), merci de nous en informer. Vous pouvez aussi télécharger et imprimer la fiche de prescription depuis le « Centre de téléchargement » et la joindre aux empreintes.",
            ],
            [
                'Cleartrack® offre-t-il une garantie ?',
                "Cleartrack® est un moyen efficace d'aligner les dents et fonctionne comme les méthodes traditionnelles d'orthodontie. Le succès dépend en grande partie de l'assiduité du patient. De ce fait, Cleartrack®, comme tout traitement orthodontique, ne peut pas garantir que les dents du patient bougeront exactement comme prévu. Il incombe à l'orthodontiste ou au dentiste prescripteur d'utiliser son expérience et ses compétences pour surveiller l'évolution du traitement. Si nécessaire, un traitement supplémentaire avec Cleartrack® peut être envisagé. Il est essentiel que le consentement soit discuté et obtenu du patient avant de commencer le traitement.",
            ],
            [
                "Que sont les gouttières d'essai ?",
                "Les gouttières d'essai sont uniques à Cleartrack®. Nous les fournissons dans le cadre du plan de traitement avec deux objectifs en tête : vérifier l'ajustement de l'aligneur et voir si les aligneurs sont un traitement acceptable pour le patient une fois en bouche. Il s'agit d'un ajustement passif conçu pour reproduire un aligneur Cleartrack® actif, et nous recommandons au patient de les porter pendant quelques jours, comme il le ferait pendant le traitement, avant de poursuivre.",
            ],
            [
                "Pourquoi utilisons-nous des gouttières d'essai ?",
                "Les gouttières d'essai permettent de vérifier l'ajustement des aligneurs avant que les aligneurs de traitement dits actifs ne soient produits. Elles sont également idéales pour les patients qui ne sont pas convaincus à 100 % par le traitement par gouttières transparentes. Si votre patient est à mi-chemin d'un traitement et qu'il est passé à Cleartrack®, elles maintiendront aussi les dents en position et les empêcheront de revenir à leur position initiale.",
            ],
            [
                'Quel est le meilleur silicone pour empreintes ?',
                "Nous acceptons volontiers tous les matériaux en silicone, mais nous recommandons les matériaux Zhermack.\nNous acceptons tout matériau d'empreinte à base de silicone, y compris les polyvinylsiloxanes (PVS/VPS) et les polyéthers. Nous vous recommandons d'utiliser des matériaux lourds et légers : les techniques d'empreinte qui utilisent les deux semblent présenter les meilleurs résultats.",
            ],
            [
                'Quel type de composite utiliser pour les attachements ?',
                "Nous recommandons l'utilisation d'un composite régulier plutôt qu'un composite fluide. Le composite ordinaire aura tendance à être plus durable et plus résistant à l'usure dans le temps.\nLorsque nos techniciens recommandent un attachement, nous vous envoyons également une préforme pour vous aider à le placer. La préforme ressemble aux aligneurs, mais elle est plus fine et clairement marquée : le matériau plus fin la rend flexible et permet une polymérisation plus facile du composite à la lumière UV.",
            ],
            [
                'Quel instrument devrais-je utiliser pour effectuer un stripping ?',
                "Pour le stripping, vous aurez besoin de bandes abrasives (extra-fines, fines et moyennes), d'un disque unilatéral de 0,1 mm et de disques bilatéraux de 0,15 et 0,2 mm. Vous aurez également besoin d'une jauge de stripping.\nBien que les aligneurs Cleartrack® nécessitent beaucoup moins de réductions interproximales (RIP) que les autres aligneurs, vous devrez peut-être en effectuer à un moment ou à un autre. Nous vous suggérons toutefois de commencer par des cas simples : une fois plus à l'aise et plus expérimenté, vous pourrez traiter des cas plus complexes.",
            ],
            [
                'Je veux transférer un cas à Cleartrack®',
                "Si vous, ou vos patients, utilisez actuellement un autre fournisseur d'aligneurs et souhaitez passer à Cleartrack®, nous pouvons prendre en charge vos cas de manière fluide et efficace.\nMême si vous êtes en possession du plan de traitement de l'autre fournisseur, nous devons effectuer une évaluation. Cela implique le scan 3D de nouveaux modèles à partir d'empreintes récentes. À partir des données numériques, nous serons en mesure de vous donner un coût précis des aligneurs supplémentaires nécessaires pour compléter le traitement, ainsi que la durée restante. Vous recevrez un rapport sur les mouvements des dents, y compris les RIP si nécessaire, et un plan de traitement en 3D à visualiser pour chaque cas.",
            ],
            [
                'Combien de temps faut-il pour obtenir un plan de traitement ?',
                "Nos scanners et logiciels permettent à notre équipe de travailler rapidement sur tous les cas. Nous fournissons des plans de traitement en moins de 7 jours ouvrables à partir de la réception des empreintes. Une fois le plan de traitement prêt, il arrive dans votre boîte électronique en quelques minutes.\nNous fabriquons également des pré-aligneurs pour votre patient, conçus pour vous permettre de vérifier l'ajustement et la précision de vos empreintes initiales. Ils servent aussi d'appareils de rétention pour les patients qui ont déjà porté des gouttières, et sont parfaits pour les patients qui hésitent à poursuivre le traitement. Une fois les pré-aligneurs ajustés et le plan de traitement approuvé, nous commençons la fabrication des aligneurs actifs.",
            ],
            [
                'Combien de temps faut-il pour fabriquer les aligneurs ?',
                "Une fois que vous avez posé les pré-aligneurs et que vous nous avez donné votre accord, nous vous envoyons les gouttières actives dans les 5 jours ouvrables. Nous vous donnerons toujours une date précise pour l'envoi des aligneurs. Nous fabriquons tout au Maroc, il n'y a donc pas de longs délais d'expédition.",
            ],
            [
                'Mon patient devra-t-il recommencer le traitement depuis le début ?',
                "Non, nous pouvons reprendre le traitement à n'importe quel stade. La bonne nouvelle est que Cleartrack® sera probablement plus rapide et nécessitera moins d'aligneurs que les autres fournisseurs. Nous déplaçons individuellement et simultanément les dents jusqu'à 0,3 mm par étape. Par exemple, en seulement 20 semaines, nous pouvons constater un déplacement de 3 mm par dent — c'est tout ce qui est nécessaire dans de nombreux cas d'encombrement léger à modéré.",
            ],
            [
                'Sélection de cas Cleartrack®',
                "Les aligneurs sont un traitement orthodontique très efficace dans de nombreux cas. Il existe cependant des cas difficiles à traiter, car trop complexes pour des aligneurs. Nos techniciens Cleartrack® pourront vous conseiller au cas par cas : notre objectif est toujours de fournir des plans de traitement réalistes, prévisibles et réalisés dans un délai raisonnable.\nAu stade de la planification, la position des dents est évaluée pour s'assurer que les gouttières transparentes sont une option de traitement appropriée avant que le technicien ne commence la planification. Le mouvement de chaque dent est ensuite tracé manuellement, déterminant l'action requise pour obtenir le futur sourire de votre patient. Si vous, ou votre patient, décidez de modifier le plan ou de ne pas poursuivre le traitement, il n'y a pas de frais supplémentaires.",
            ],
            [
                "Quels sont les facteurs essentiels à la réussite d'un cas Cleartrack® ?",
                "Prise d'empreintes — qu'il s'agisse d'empreintes en polyéther, en PVS ou de scans intra-oraux, la base d'un bon résultat commence par une bonne empreinte du patient (assurez-vous que le matériau a bien pris et n'oubliez jamais 2 à 4 mm de tissu gingival).\nPlanification du traitement — le patient est généralement préoccupé par certains aspects précis de son sourire. Vos commentaires et demandes aux planificateurs du traitement sont déterminants pour le résultat final.\nAligner chewies — les patients ne comprennent pas toujours l'importance de ce petit morceau de matériau spongieux fourni dans la boîte de l'aligneur. Les chewies aident à bien positionner les aligneurs pour un meilleur suivi des dents, surtout au passage à une nouvelle étape.",
            ],
            [
                'Est-ce que les empreintes en alginate sont acceptées ?',
                "Non. Nous ne pouvons pas produire de gouttières à partir de modèles en plâtre ou d'empreintes en alginate : les alginates sèchent et le matériau peut rétrécir ou s'élargir en fonction des facteurs environnementaux. Nous avons besoin d'empreintes en polyéther ou en PVS.\nLes modèles en plâtre ne résistent pas toujours à l'expédition : nous constatons en général des ébréchures, en particulier au niveau des cuspides et des bords incisifs, et il ne nous est pas possible d'en contrôler la qualité. Si vous nous envoyez de l'alginate ou du plâtre, nous ne pourrons rien faire de plus qu'une évaluation.\nComme pour les scans, nous exigeons les empreintes supérieures et inférieures, même si vous ne traitez qu'une seule arcade. L'enregistrement de l'occlusion est facultatif ; il reste bénéfique dans certains cas (béance postérieure ou asymétrie mandibulaire, par exemple).",
            ],
            [
                'Quels types de scanners intrabuccaux sont acceptés ?',
                "Tous les principaux scanners intra-oraux sont acceptés. Les scans numériques doivent être soumis au format STL. Le format STL étant un standard ouvert, vous n'êtes pas obligé d'acheter un scanner spécifique.",
            ],
            [
                'Combien de temps faut-il pour recevoir une estimation du devis ?',
                "24 heures si vous utilisez un scanner intra-oral.\n48 heures si vous nous envoyez une empreinte en polyéther ou en PVS.",
            ],
            [
                'Combien de temps un patient doit-il porter chaque étape ?',
                "La durée recommandée de port des gouttières est de 22 heures par jour pendant environ 2 semaines par étape (en l'absence de tout autre dispositif d'accélération orthodontique).",
            ],
            [
                'Que faire si mon patient perd un aligneur ?',
                "Si le patient a porté le jeu perdu pendant moins de 7 jours, demandez-lui d'utiliser temporairement le jeu précédent pendant que les aligneurs de remplacement sont commandés et fabriqués. Les aligneurs de remplacement sont disponibles à l'achat et sont expédiés dans les 3 jours ouvrables suivant la commande.\nSi le patient a porté le jeu perdu pendant au moins 7 jours, demandez-lui de passer au jeu suivant.",
            ],
        ];
    }

    public function run(): void
    {
        // Documents du centre de téléchargement (PPT slide 86) — PDF à fournir par le client
        foreach ([
            'Fiche de prescription simplifiée',
            'Consentement éclairé du patient',
            'Consentement pour la contention',
        ] as $i => $titre) {
            Telechargement::updateOrCreate(['titre' => $titre], ['ordre' => $i]);
        }

        foreach ($this->questionsMedecin() as $ordre => [$question, $reponse]) {
            Faq::updateOrCreate(
                ['groupe' => 'medecin', 'question' => $question],
                ['reponse' => $reponse, 'ordre' => $ordre, 'actif' => true]
            );
        }
    }
}
