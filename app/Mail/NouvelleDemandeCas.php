<?php

namespace App\Mail;

use App\Models\DemandeCas;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NouvelleDemandeCas extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public DemandeCas $demande) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nouveau cas soumis — Dr '.$this->demande->medecin_nom.' / patient '.$this->demande->patient_nom,
        );
    }

    public function content(): Content
    {
        return new Content(markdown: 'emails.nouvelle-demande-cas');
    }
}
