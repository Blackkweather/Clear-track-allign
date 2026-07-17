<x-mail::message>
# Nouvelle demande de consultation

Une nouvelle demande de RDV a été envoyée depuis www.cleartrack.ma :

- **Nom complet :** {{ $demande->nom_complet }}
- **Date de naissance :** {{ $demande->date_naissance->format('d/m/Y') }}
- **Adresse :** {{ $demande->adresse }}
- **Téléphone :** {{ $demande->telephone }}
- **E-mail :** {{ $demande->email }}
@if ($demande->message)
- **Message :** {{ $demande->message }}
@endif
- **Photos jointes :** {{ $demande->photos->count() }}

<x-mail::button :url="url('/admin/demande-rdvs')">
Voir dans l'admin
</x-mail::button>

ClearTrack® align
</x-mail::message>
