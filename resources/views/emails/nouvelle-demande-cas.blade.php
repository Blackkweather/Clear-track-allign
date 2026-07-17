<x-mail::message>
# Nouveau cas soumis via l'Espace Médecin

- **Médecin :** {{ $demande->medecin_nom }}
- **Cabinet :** {{ $demande->cabinet_adresse }} — {{ $demande->ville }}
- **Téléphone :** {{ $demande->telephone }}
- **E-mail :** {{ $demande->email }}

---

- **Patient :** {{ $demande->patient_nom }} ({{ $demande->patient_age }} ans)
- **Demande :** {{ ['estimation' => 'Estimation du devis (gratuit)', 'conception' => 'Conception', 'conception-fabrication' => 'Conception et fabrication'][$demande->type_demande] }}
- **Arcade :** {{ ['bimaxillaire' => 'Bimaxillaire', 'haut' => 'Haut seulement', 'bas' => 'Bas seulement'][$demande->arcade] }}
- **Correction :** {{ ['esthetique' => 'Esthétique seulement', 'esthetique-fonctionnelle' => 'Esthétique et fonctionnelle'][$demande->correction] }}
@if ($demande->dents_ne_pas_deplacer)
- **Ne pas déplacer :** {{ $demande->dents_ne_pas_deplacer }}
@endif
@if ($demande->dents_sans_attachements)
- **Sans attachements :** {{ $demande->dents_sans_attachements }}
@endif
- **Gouttière d'essai :** {{ $demande->gouttiere_essai ? 'Oui' : 'Non' }}
- **Contact formation :** {{ $demande->contact_formation ? 'Oui' : 'Non' }}
- **Fichiers joints :** {{ $demande->fichiers->count() }}

<x-mail::button :url="url('/admin/demande-cas')">
Voir dans l'admin
</x-mail::button>

ClearTrack® align
</x-mail::message>
