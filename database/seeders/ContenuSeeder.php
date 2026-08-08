<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\Post;
use Illuminate\Database\Seeder;

/**
 * Contenus rédactionnels fournis par le client
 * (source : Cleartrack.ma - Schéma WEBSITE.docx + Website conception.pptx).
 */
class ContenuSeeder extends Seeder
{
    public function run(): void
    {
        // ── FAQ patient — Questions générales ──────────────────────────
        $general = [
            ['Que sont les aligneurs ClearTrack ?', "Les aligneurs ClearTrack sont fabriqués sur mesure pour vous. Ils sont en plastique transparent et sont parfaitement adaptés à vos dents. Les aligneurs ne contiennent pas de BPA. Le mouvement de la dent pour votre traitement se fait en plusieurs petites étapes (un maximum de 0,2 mm de mouvement de la dent par aligneur). À chaque étape, vous recevrez des aligneurs fabriqués sur mesure, qui exercent une pression sur les dents afin d'effectuer le mouvement partiel envisagé."],
            ['Pourquoi ne peut-on pas traiter tous les déplacements de dents avec des aligneurs ?', "Pour nous, la priorité absolue est votre santé. C'est pourquoi nos dentistes décident si un traitement avec les aligneurs ClearTrack est nécessaire en fonction de la position actuelle de vos dents. En principe, nous rectifions tout mouvement mineur ou modéré des dents de devant et montrons en détail comment cette correction se déroulera avant de commencer le traitement."],
            ['Ma mutuelle paiera-t-elle le traitement avec les aligneurs de ClearTrack ?', "La correction dentaire n'est pas prise en charge par l'assurance maladie légale. En revanche, une nécessité médicale peut être prise en charge par l'assurance maladie privée, ce qui est rarement le cas lorsque les dents de devant sont légèrement ou modérément déplacées."],
        ];

        // ── FAQ patient — Comment le traitement fonctionne ─────────────
        $traitement = [
            ['ClearTrack soigne-t-elle une mâchoire à la fois ou les deux en même temps ?', "À chaque traitement, le déplacement de dents peut modifier l'occlusion. Afin de maintenir une occlusion adéquate, les deux mâchoires (celle du haut et du bas) doivent être prises en considération dans votre traitement. Par conséquent, les mâchoires sont toujours ajustées."],
            ['Quelle est la durée du traitement avec ClearTrack ?', 'Le traitement avec les aligneurs dentaires ClearTrack est généralement de 4 à 12 mois.'],
            ['Dans combien de temps recevrai-je mes aligneurs ?', "La première étape est d'effectuer une empreinte ou un scan en 3D par un dentiste. Nous les recevons ensuite dans nos laboratoires et de là, il faut compter environ 10 à 14 jours avant que vous receviez la simulation de votre traitement par e-mail. Dès que vous acceptez la simulation proposée, la fabrication de vos aligneurs personnalisés peut enfin commencer : vous recevez votre traitement environ cinq à dix jours après."],
            ['Pendant combien de temps dois-je porter les aligneurs ?', "Vous devez porter vos aligneurs 22 heures par jour et les enlever uniquement lorsque vous mangez, buvez et brossez vos dents. Il est important que vous respectiez la durée recommandée pour le port des aligneurs afin d'obtenir les résultats souhaités."],
            ['Dois-je me limiter à manger pendant le traitement ?', "Pas du tout, car contrairement aux appareils dentaires classiques, vous pouvez manger et boire tout ce que vous voulez pendant ce traitement. Il suffit juste d'enlever les aligneurs lorsque vous mangez. Vous pouvez donc procéder à une hygiène dentaire normale après chaque repas, en gardant une santé bucco-dentaire optimale."],
            ['Dois-je retirer mon aligneur lorsque je mange et que je bois ?', "Vous pouvez boire de l'eau froide en gardant les aligneurs. Les boissons chaudes peuvent endommager ou déformer le plastique des aligneurs. En général, vous devez les enlever pour manger et boire et les ranger dans l'étui fourni. Après un repas vous devez vous brosser les dents car la salive ne peut pas reminéraliser vos dents comme d'habitude. N'oubliez pas de rincer vos aligneurs à l'eau avant de les remettre."],
            ['Comment dois-je prendre soin de mes aligneurs ?', "Idéalement, nettoyez vos aligneurs deux fois par jour avec une brosse à dents. N'utilisez pas de dentifrice, car les aligneurs risquent de devenir troubles. Utilisez plutôt un savon doux et rincez les aligneurs à l'eau froide. Des températures trop élevées peuvent abîmer et déformer le matériel. Les aligneurs perdent alors leur forme et deviennent inefficaces. Des soins attentifs et adéquats permettront à vos aligneurs de rester en parfait état."],
            ['Aurai-je des douleurs pendant le traitement ?', 'Dans les premiers jours suivant le changement des aligneurs, vous ressentirez une certaine pression que les aligneurs exercent afin de bouger vos dents. Cette pression diminuera progressivement et vous ne ressentirez plus aucune douleur.'],
            ['Que se passe-t-il si je perds un aligneur ?', "Si vous perdez un aligneur, contactez-nous et nous vous en fabriquerons un de remplacement dès que possible. En attendant votre remplacement, portez l'ancien aligneur pour maintenir vos dents dans leur position actuelle."],
            ["Le port de l'aligneur entraîne-t-il des troubles de langage ?", "Pour la plupart des patients, la parole n'est pas affectée. Comme pour les appareils dentaires classiques, il faut d'abord s'habituer à la présence d'un corps étranger dans la bouche. Au bout d'une semaine au plus tard, la plupart des patients parlent normalement."],
            ['Est-il possible de fumer pendant le traitement ?', 'Nous vous recommandons de ne pas fumer pendant le traitement, car cela pourrait tacher vos dents.'],
            ['ClearTrack me conviendra-t-il ?', "Nos orthodontistes au Maroc et à l'étranger sont des experts reconnus et prennent en charge la correction dentaire au plus haut niveau médical. La correction du déplacement des dents en utilisant des aligneurs est très bien établie et bien étudiée. Il est donc très probable que vous obteniez les résultats prévus du traitement. Il existe des éléments dans chaque traitement médical qui peuvent influencer le succès du traitement. C'est pourquoi nous garantissons que même si les résultats de votre traitement sont différents de ce que vous attendez, nous vous soignerons jusqu'à ce que vos résultats prévus soient atteints."],
            ['Est-il possible de passer au prochain aligneur plus tôt que prévu ?', "Nous avons planifié le traitement de manière très précise et il est nécessaire de respecter la durée de port prévue (à la fois par jour et par aligneur). Le mouvement de dent le plus important se produit dans les deux ou trois premiers jours après le changement d'aligneur, puis la pression diminue. Cependant, les dents ont besoin de la durée de port calculée d'une à deux semaines par aligneur, afin que la reconstruction osseuse soit terminée et que la dent s'habitue à sa nouvelle position pour qu'elle puisse continuer à bouger."],
            ['Dois-je porter une contention après le traitement ?', "Il est important de porter des contentions après chaque traitement orthodontique pour conserver les résultats souhaités. Il peut s'agir de contention amovible ou de contention fixe."],
            ['Comment doit-on porter les contentions amovibles ?', "Les contentions amovibles ClearTrack sont plus transparentes et légèrement plus épaisses que les aligneurs. Elles seront portées 22 heures par jour pendant les deux premières semaines suivant le traitement, puis pendant 12 heures par jour pendant les six premiers mois après le traitement. Ensuite, vous devrez les porter tous les soirs à vie ou opter pour une pose de fil de contention fixe avec votre dentiste. Nous recommandons de changer les contentions amovibles ClearTrack tous les 12 mois pour qu'elles restent fraîches, douces et transparentes."],
            ['De quels matériaux les aligneurs sont-ils fabriqués ?', "Les aligneurs ClearTrack sont fabriqués à partir d'un matériau en plastique spécial qui permet de positionner vos dents de façon idéale pendant toute la durée du traitement. Ce matériau est testé cliniquement et convient aux personnes qui ont des allergies. Nos aligneurs sont fabriqués sans plastifiants."],
        ];

        foreach ($general as $i => [$q, $r]) {
            Faq::updateOrCreate(['groupe' => 'patient-general', 'question' => $q], ['reponse' => $r, 'ordre' => $i]);
        }
        foreach ($traitement as $i => [$q, $r]) {
            Faq::updateOrCreate(['groupe' => 'patient-traitement', 'question' => $q], ['reponse' => $r, 'ordre' => $i]);
        }

        // ── Article de blog (PPT slide 33) — corps assemblé à partir des
        //    contenus client existants (règle des 22 h : FAQ + instructions) ──
        Post::updateOrCreate(['slug' => 'suivre-la-regle-des-22-heures-par-jour'], [
            'titre' => 'Suivre la règle des 22 heures par jour',
            'extrait' => "Lorsque vous devez faire corriger un mauvais alignement de vos dents, le traitement orthodontique est le seul moyen d'y parvenir. Le traitement orthodontique est traditionnellement connu pour ses appareils métalliques — mais les aligneurs changent la donne.",
            'contenu' => "<p>Lorsque vous devez faire corriger un mauvais alignement de vos dents, le traitement orthodontique est le seul moyen d'y parvenir. Le traitement orthodontique est traditionnellement connu pour ses brackets métalliques, ses fils et ses vis. Avec les aligneurs Cleartrack®, vous portez une série de gouttières transparentes qui déplacent vos dents par étapes — à condition de respecter une règle d'or : le port 22 heures par jour.</p><h2>Pourquoi 22 heures ?</h2><p>Le mouvement de dent le plus important se produit dans les deux ou trois premiers jours après le changement d'aligneur, puis la pression diminue. Les dents ont besoin de la durée de port calculée d'une à deux semaines par aligneur, afin que la reconstruction osseuse soit terminée et que la dent s'habitue à sa nouvelle position.</p><h2>Quand puis-je retirer mes aligneurs ?</h2><p>Vous ne devez les enlever que lorsque vous mangez, buvez (autre que de l'eau froide) et brossez vos dents. Rangez-les toujours dans l'étui fourni, et rincez-les à l'eau avant de les remettre.</p><h2>Les bons réflexes</h2><ul><li>Portez vos aligneurs 20 à 22 heures par jour.</li><li>Passez au jeu suivant après 1 à 2 semaines (ou selon les instructions de votre dentiste).</li><li>Nettoyez vos gouttières deux fois par jour avec une brosse à dents et un savon doux — jamais de dentifrice ni d'eau chaude.</li><li>Si vous perdez un aligneur, contactez votre dentiste et portez l'aligneur précédent en attendant le remplacement.</li></ul><p>En respectant scrupuleusement la règle des 22 heures, vous mettez toutes les chances de votre côté pour obtenir le sourire prévu par votre plan de traitement, dans les délais prévus.</p>",
            // photo-sourire-1.jpg retirée : filigrane de banque d'images (voir CONTENT-DECISIONS.md D20)
            'image' => 'assets/photo-aligneur-main.png',
            'publie_le' => '2021-12-20 09:00:00',
        ]);
    }
}
