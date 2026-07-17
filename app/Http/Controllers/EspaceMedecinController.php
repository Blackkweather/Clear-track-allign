<?php

namespace App\Http\Controllers;

use App\Mail\NouvelleDemandeCas;
use App\Mail\NouvelleDemandeCertification;
use App\Models\DemandeCas;
use App\Models\DemandeCertification;
use App\Models\Faq;
use App\Models\Telechargement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class EspaceMedecinController extends Controller
{
    /** Fichiers du dossier clinique (PPT slides 81-83). Le suffixe * = requis. */
    public const TYPES_FICHIERS = [
        'visage_souriant' => ['Visage face souriant', true],
        'face_fermee' => ['Visage face bouche fermée', true],
        'profil_ferme' => ['Visage profil bouche fermée', true],
        'intra_face' => ['Photo intra-buccale face', true],
        'intra_droite' => ['Photo intra-buccale droite', true],
        'intra_gauche' => ['Photo intra-buccale gauche', true],
        'occlusale_maxillaire' => ['Photo maxillaire occlusale', true],
        'occlusale_mandibulaire' => ['Photo mandibulaire occlusale', true],
        'radio_panoramique' => ['Radio panoramique', true],
        'teleradio_profil' => ['Téléradio de profil', false],
    ];

    public function index(): View
    {
        return view('pages.medecin.index');
    }

    public function demarrer(): View
    {
        return view('pages.medecin.demarrer', ['typesFichiers' => self::TYPES_FICHIERS]);
    }

    public function demarrerStore(Request $request): RedirectResponse
    {
        if ($request->filled('site_web')) {
            return redirect()->route('medecin.demarrer')->with('succes', true);
        }

        $regles = [
            'medecin_nom' => ['required', 'string', 'max:150'],
            'cabinet_adresse' => ['required', 'string', 'max:255'],
            'ville' => ['required', 'string', 'max:100'],
            'telephone' => ['required', 'string', 'max:30'],
            'email' => ['required', 'email', 'max:150'],
            'patient_nom' => ['required', 'string', 'max:150'],
            'patient_age' => ['required', 'integer', 'min:5', 'max:100'],
            'type_demande' => ['required', 'in:estimation,conception,conception-fabrication'],
            'arcade' => ['required', 'in:bimaxillaire,haut,bas'],
            'correction' => ['required', 'in:esthetique,esthetique-fonctionnelle'],
            'dents_ne_pas_deplacer' => ['nullable', 'string', 'max:255'],
            'dents_sans_attachements' => ['nullable', 'string', 'max:255'],
            'instructions' => ['nullable', 'string', 'max:3000'],
            'gouttiere_essai' => ['nullable', 'boolean'],
            'contact_formation' => ['nullable', 'boolean'],
            'consentement' => ['accepted'],
        ];
        foreach (self::TYPES_FICHIERS as $type => [$label, $requis]) {
            $regles["fichier_$type"] = [
                $requis ? 'required' : 'nullable',
                'file', 'mimes:jpg,jpeg,png,pdf', 'max:15360',
            ];
        }

        $messages = [
            'required' => 'Ce champ est obligatoire.',
            'accepted' => 'Vous devez accepter les conditions générales et la politique de confidentialité.',
            'email' => 'Veuillez saisir une adresse e-mail valide.',
            'integer' => 'Veuillez saisir un nombre.',
            'in' => 'Choix invalide.',
            'file' => 'Le fichier est invalide.',
            'mimes' => 'Formats acceptés : JPG, PNG ou PDF.',
            'max.file' => 'Le fichier ne doit pas dépasser 15 Mo.',
        ];

        $valide = $request->validate($regles, $messages);

        $demande = DemandeCas::create([
            ...collect($valide)->except(['consentement', 'gouttiere_essai', 'contact_formation'])
                ->filter(fn ($v, $k) => ! str_starts_with($k, 'fichier_'))->all(),
            'gouttiere_essai' => $request->boolean('gouttiere_essai'),
            'contact_formation' => $request->boolean('contact_formation'),
        ]);

        foreach (array_keys(self::TYPES_FICHIERS) as $type) {
            if ($fichier = $request->file("fichier_$type")) {
                $chemin = $fichier->store("cas/{$demande->id}", 'local');
                $demande->fichiers()->create(['type' => $type, 'chemin' => $chemin]);
            }
        }

        try {
            Mail::to(config('mail.notifications_cas', 'customer@cleartrack.ma'))
                ->send(new NouvelleDemandeCas($demande));
        } catch (\Throwable $e) {
            report($e);
        }

        return redirect()->route('medecin.demarrer')->with('succes', true);
    }

    public function certifie(): View
    {
        return view('pages.medecin.certifie');
    }

    public function certifieStore(Request $request): RedirectResponse
    {
        if ($request->filled('site_web')) {
            return redirect()->route('medecin.certifie')->with('succes', true);
        }

        $valide = $request->validate([
            'medecin_nom' => ['required', 'string', 'max:150'],
            'structure' => ['nullable', 'string', 'max:150'],
            'adresse' => ['required', 'string', 'max:255'],
            'ville' => ['required', 'string', 'max:100'],
            'telephone' => ['required', 'string', 'max:30'],
            'email' => ['required', 'email', 'max:150'],
            'contact_formation' => ['nullable', 'boolean'],
            'message' => ['nullable', 'string', 'max:2000'],
        ], [
            'required' => 'Ce champ est obligatoire.',
            'email' => 'Veuillez saisir une adresse e-mail valide.',
        ]);

        $demande = DemandeCertification::create([
            ...collect($valide)->except('contact_formation')->all(),
            'contact_formation' => $request->boolean('contact_formation'),
        ]);

        try {
            Mail::to(config('mail.notifications_cas', 'customer@cleartrack.ma'))
                ->send(new NouvelleDemandeCertification($demande));
        } catch (\Throwable $e) {
            report($e);
        }

        return redirect()->route('medecin.certifie')->with('succes', true);
    }

    public function telechargements(): View
    {
        return view('pages.medecin.telechargements', [
            'documents' => Telechargement::where('actif', true)->orderBy('ordre')->get(),
        ]);
    }

    public function faq(): View
    {
        return view('pages.medecin.faq', [
            'faqs' => Faq::actif()->where('groupe', 'medecin')->get(),
        ]);
    }
}
