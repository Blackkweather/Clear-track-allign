<?php

namespace App\Http\Controllers;

use App\Mail\NouvelleDemandeRdv;
use App\Models\DemandeRdv;
use App\Models\Ville;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class RdvController extends Controller
{
    /** Types de photos demandés par la maquette (PPT slide 72). */
    public const TYPES_PHOTOS = [
        'visage_souriant' => 'Visage face souriant',
        'profil_droit' => 'Visage profil droit bouche fermée',
        'profil_gauche' => 'Visage profil gauche bouche fermée',
        'intra_face' => 'Photo intra-buccale face en occlusion',
        'intra_droite' => 'Photo intra-buccale droite en occlusion',
        'intra_gauche' => 'Photo intra-buccale gauche en occlusion',
    ];

    public function show(): View
    {
        return view('pages.rdv', [
            'typesPhotos' => self::TYPES_PHOTOS,
            'villes' => Ville::orderBy('ordre')->with('cabinets')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        // Anti-spam : champ pot de miel invisible
        if ($request->filled('site_web')) {
            return redirect()->route('rdv')->with('succes', true);
        }

        $regles = [
            'nom_complet' => ['required', 'string', 'max:150'],
            'date_naissance' => ['required', 'date', 'before:today'],
            'adresse' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'string', 'max:30'],
            'email' => ['required', 'email', 'max:150'],
            'message' => ['nullable', 'string', 'max:2000'],
        ];
        foreach (array_keys(self::TYPES_PHOTOS) as $type) {
            $regles["photo_$type"] = ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:10240'];
        }

        $messages = [
            'required' => 'Ce champ est obligatoire.',
            'email' => 'Veuillez saisir une adresse e-mail valide.',
            'date' => 'Veuillez saisir une date valide.',
            'before' => 'Veuillez saisir une date valide.',
            'image' => 'Le fichier doit être une image.',
            'mimes' => 'Formats acceptés : JPG ou PNG.',
            'max.file' => 'La photo ne doit pas dépasser 10 Mo.',
            'max.string' => 'Ce champ est trop long.',
        ];

        $valide = $request->validate($regles, $messages);

        $demande = DemandeRdv::create([
            'nom_complet' => $valide['nom_complet'],
            'date_naissance' => $valide['date_naissance'],
            'adresse' => $valide['adresse'],
            'telephone' => $valide['telephone'],
            'email' => $valide['email'],
            'message' => $valide['message'] ?? null,
        ]);

        foreach (array_keys(self::TYPES_PHOTOS) as $type) {
            if ($fichier = $request->file("photo_$type")) {
                // Stockage privé (hors racine web) — noms aléatoires
                $chemin = $fichier->store("rdv/{$demande->id}", 'local');
                $demande->photos()->create(['type' => $type, 'chemin' => $chemin]);
            }
        }

        // Notification à l'équipe (SMTP en production ; log en local)
        try {
            Mail::to(config('mail.notifications_rdv', 'contact@cleartrack.ma'))
                ->send(new NouvelleDemandeRdv($demande));
        } catch (\Throwable $e) {
            report($e); // l'échec d'e-mail ne doit pas bloquer la demande
        }

        return redirect()->route('rdv')->with('succes', true);
    }
}
