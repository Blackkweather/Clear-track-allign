<x-mail::message>
# Nouvelle demande de certification Cleartrack®

- **Médecin :** {{ $demande->medecin_nom }}
@if ($demande->structure)
- **Structure :** {{ $demande->structure }}
@endif
- **Adresse :** {{ $demande->adresse }} — {{ $demande->ville }}
- **Téléphone :** {{ $demande->telephone }}
- **E-mail :** {{ $demande->email }}
- **Souhaite être contacté pour la prochaine formation :** {{ $demande->contact_formation ? 'Oui' : 'Non' }}
@if ($demande->message)

**Message :**
{{ $demande->message }}
@endif

<x-mail::button :url="url('/admin/demande-certifications')">
Voir dans l'admin
</x-mail::button>

ClearTrack® align
</x-mail::message>
