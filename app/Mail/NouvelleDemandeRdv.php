<?php

namespace App\Mail;

use App\Models\DemandeRdv;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NouvelleDemandeRdv extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public DemandeRdv $demande) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nouvelle demande de RDV — '.$this->demande->nom_complet,
        );
    }

    public function content(): Content
    {
        return new Content(markdown: 'emails.nouvelle-demande-rdv');
    }
}
