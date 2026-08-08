{{-- Schéma de cadrage neutre pour chaque type de photo demandé (voir App\Support\GuidesPhotos). --}}
@props(['type'])

@php
    // Arcade dentaire vue occlusale : dents réparties sur une ellipse, ouverture côté postérieur.
    $arcade = function (float $depart, float $balayage, int $nb = 14) {
        $dents = [];
        for ($i = 0; $i < $nb; $i++) {
            $angle = deg2rad($depart + $balayage * $i / ($nb - 1));
            // Les molaires (extrémités) sont plus larges que les incisives (milieu).
            $t = abs($i - ($nb - 1) / 2) / (($nb - 1) / 2);
            $dents[] = [
                round(60 + 34 * cos($angle), 2),
                round(60 + 30 * sin($angle), 2),
                round(3 + 3 * $t, 2),
            ];
        }

        return $dents;
    };
@endphp

<svg viewBox="0 0 120 120" class="h-40 w-40 shrink-0" role="img" aria-hidden="true" fill="none">
    <rect x="2" y="2" width="116" height="116" rx="12" class="fill-brand-50"/>

    @switch($type)
        {{-- ---------- Visages de face ---------- --}}
        @case('visage_souriant')
        @case('face_fermee')
            {{-- Épaules + cou --}}
            <path d="M30 118c0-13 13-20 30-20s30 7 30 20" class="fill-brand-100"/>
            <rect x="52" y="82" width="16" height="16" class="fill-brand-100"/>
            {{-- Tête --}}
            <ellipse cx="60" cy="56" rx="25" ry="32" class="fill-brand-200"/>
            <path d="M35 52a4 5 0 00-4 5 4 5 0 004 5M85 52a4 5 0 014 5 4 5 0 01-4 5" class="stroke-brand-300" stroke-width="2.5"/>
            {{-- Yeux + nez --}}
            <circle cx="50" cy="50" r="2.6" class="fill-brand-600"/>
            <circle cx="70" cy="50" r="2.6" class="fill-brand-600"/>
            <path d="M60 56v8h4" class="stroke-brand-500" stroke-width="2" stroke-linecap="round"/>
            @if ($type === 'visage_souriant')
                {{-- Sourire large, dents visibles --}}
                <path d="M46 74q14 14 28 0z" class="fill-white stroke-brand-600" stroke-width="2" stroke-linejoin="round"/>
                <path d="M47 75h26" class="stroke-brand-300" stroke-width="1.5"/>
                <path d="M55 74.5v4M60 74.5v5M65 74.5v4" class="stroke-brand-300" stroke-width="1.2"/>
            @else
                {{-- Lèvres jointes au repos --}}
                <path d="M49 76q11 4 22 0" class="stroke-brand-600" stroke-width="2.5" stroke-linecap="round"/>
            @endif
            {{-- Repères de cadrage --}}
            <path d="M60 12v10M60 98v10" class="stroke-brand-400" stroke-width="1.5" stroke-dasharray="3 3"/>
            @break

        {{-- ---------- Visages de profil ---------- --}}
        @case('profil_droit')
        @case('profil_gauche')
        @case('profil_ferme')
            <g transform="{{ $type === 'profil_gauche' ? 'translate(120,0) scale(-1,1)' : '' }}">
                {{-- Silhouette de profil, nez vers la droite --}}
                <path d="M58 16c-16 0-27 13-27 29 0 8 1 13 3 18 2 4 1 9-1 13l-3 6h12v20h34V96c0-6 3-9 8-12 5-3 6-8 2-12l-5-5c-2-2-2-4 1-6l7-6c2-2 2-4-1-5l-6-3c-2-1-2-2-2-4 0-14-4-27-22-27z"
                      class="fill-brand-200"/>
                {{-- Oreille --}}
                <circle cx="47" cy="56" r="6" class="stroke-brand-400" stroke-width="2"/>
                {{-- Œil --}}
                <circle cx="70" cy="46" r="2.6" class="fill-brand-600"/>
                {{-- Lèvres jointes --}}
                <path d="M76 68q6 3 10 0" class="stroke-brand-600" stroke-width="2.5" stroke-linecap="round"/>
            </g>
            {{-- Repère : plan horizontal du regard --}}
            <path d="M10 46h14M96 46h14" class="stroke-brand-400" stroke-width="1.5" stroke-dasharray="3 3"/>
            @break

        {{-- ---------- Intra-buccale de face ---------- --}}
        @case('intra_face')
            {{-- Ouverture labiale (écarteurs) --}}
            <path d="M14 60q46-34 92 0-46 34-92 0z" class="fill-white stroke-brand-300" stroke-width="2"/>
            {{-- Arcade supérieure --}}
            @foreach ([[60, 9], [51, 8], [42, 7], [34, 6], [27, 5]] as [$x, $w])
                <rect x="{{ $x - $w / 2 }}" y="{{ 60 - 13 }}" width="{{ $w }}" height="13" rx="2" class="fill-brand-100 stroke-brand-500" stroke-width="1.5"/>
                @if ($x !== 60)
                    <rect x="{{ 120 - $x - $w / 2 }}" y="{{ 60 - 13 }}" width="{{ $w }}" height="13" rx="2" class="fill-brand-100 stroke-brand-500" stroke-width="1.5"/>
                @endif
            @endforeach
            {{-- Arcade inférieure --}}
            @foreach ([[60, 8], [52, 7], [44, 6], [37, 5.5], [31, 5]] as [$x, $w])
                <rect x="{{ $x - $w / 2 }}" y="60" width="{{ $w }}" height="11" rx="2" class="fill-brand-100 stroke-brand-500" stroke-width="1.5"/>
                @if ($x !== 60)
                    <rect x="{{ 120 - $x - $w / 2 }}" y="60" width="{{ $w }}" height="11" rx="2" class="fill-brand-100 stroke-brand-500" stroke-width="1.5"/>
                @endif
            @endforeach
            {{-- Ligne médiane + plan occlusal --}}
            <path d="M60 30v8M60 82v8" class="stroke-brand-500" stroke-width="1.5" stroke-dasharray="3 3"/>
            <path d="M10 60h8M102 60h8" class="stroke-brand-400" stroke-width="1.5" stroke-dasharray="3 3"/>
            @break

        {{-- ---------- Intra-buccales latérales ---------- --}}
        @case('intra_droite')
        @case('intra_gauche')
            <g transform="{{ $type === 'intra_gauche' ? 'translate(120,0) scale(-1,1)' : '' }}">
                <path d="M10 60q50-32 100-6-50 30-100 6z" class="fill-white stroke-brand-300" stroke-width="2"/>
                {{-- Vue latérale : molaires à gauche, canine à droite --}}
                @php $x = 18; @endphp
                @foreach ([12, 11, 10, 9, 8, 7, 6] as $i => $w)
                    <rect x="{{ $x }}" y="{{ 44 + $i * 1.6 }}" width="{{ $w }}" height="13" rx="2" class="fill-brand-100 stroke-brand-500" stroke-width="1.5"/>
                    <rect x="{{ $x }}" y="{{ 57 + $i * 1.6 }}" width="{{ $w }}" height="11" rx="2" class="fill-brand-100 stroke-brand-500" stroke-width="1.5"/>
                    @php $x += $w + 1.5; @endphp
                @endforeach
            </g>
            {{-- Repère : plan d'occlusion --}}
            <path d="M8 62h10M102 54h10" class="stroke-brand-400" stroke-width="1.5" stroke-dasharray="3 3"/>
            @break

        {{-- ---------- Vues occlusales ---------- --}}
        @case('occlusale_maxillaire')
        @case('occlusale_mandibulaire')
            @php
                // Maxillaire : incisives vers le haut (ouverture en bas). Mandibule : l'inverse.
                $dents = $type === 'occlusale_maxillaire' ? $arcade(110, 320) : $arcade(-70, -320);
            @endphp
            {{-- Palais / plancher buccal --}}
            <ellipse cx="60" cy="60" rx="24" ry="20" class="fill-brand-100"/>
            @if ($type === 'occlusale_mandibulaire')
                {{-- Langue rétractée --}}
                <ellipse cx="60" cy="62" rx="15" ry="13" class="fill-brand-200"/>
            @endif
            @foreach ($dents as [$cx, $cy, $r])
                <circle cx="{{ $cx }}" cy="{{ $cy }}" r="{{ $r }}" class="fill-white stroke-brand-500" stroke-width="1.5"/>
            @endforeach
            {{-- Ligne médiane --}}
            <path d="{{ $type === 'occlusale_maxillaire' ? 'M60 10v10' : 'M60 100v10' }}" class="stroke-brand-500" stroke-width="1.5" stroke-dasharray="3 3"/>
            @break

        {{-- ---------- Radiographies ---------- --}}
        @case('radio_panoramique')
            <rect x="10" y="30" width="100" height="60" rx="4" class="fill-slate-700"/>
            {{-- Arcade panoramique déroulée --}}
            <path d="M20 48q40 34 80 0" class="stroke-slate-400" stroke-width="1.5"/>
            <path d="M22 58q38 30 76 0" class="stroke-slate-400" stroke-width="1.5"/>
            @foreach (range(0, 13) as $i)
                @php
                    $t = $i / 13;
                    $x = 22 + 76 * $t;
                    $y = 50 + 30 * (1 - pow(2 * $t - 1, 2));
                @endphp
                <rect x="{{ round($x - 2.5, 2) }}" y="{{ round($y - 4, 2) }}" width="5" height="9" rx="1.5" class="fill-slate-200"/>
            @endforeach
            <path d="M14 34h6M100 34h6" class="stroke-slate-500" stroke-width="1.5"/>
            @break

        @case('teleradio_profil')
            <rect x="18" y="16" width="84" height="88" rx="4" class="fill-slate-700"/>
            {{-- Profil radiographique --}}
            <path d="M58 28c-14 0-23 11-23 25 0 7 1 11 3 15 2 4 1 8-1 11l-2 5h10v14h29V88c0-5 3-8 7-10 4-3 5-7 2-10l-4-4c-2-2-2-3 1-5l6-5c2-2 2-3-1-4l-5-3c-2-1-2-2-2-3 0-12-4-16-20-16z"
                  class="fill-slate-500 stroke-slate-300" stroke-width="1.5"/>
            {{-- Arcades --}}
            <path d="M64 70h18M64 77h16" class="stroke-slate-100" stroke-width="2" stroke-linecap="round"/>
            @break

        @default
            <circle cx="60" cy="60" r="26" class="stroke-brand-400" stroke-width="2"/>
            <path d="M60 46v20M60 74h.01" class="stroke-brand-500" stroke-width="3" stroke-linecap="round"/>
    @endswitch
</svg>
