<?php

namespace App\Mail;

use App\Models\DemandeCertification;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NouvelleDemandeCertification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public DemandeCertification $demande) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Demande de certification — Dr '.$this->demande->medecin_nom,
        );
    }

    public function content(): Content
    {
        return new Content(markdown: 'emails.nouvelle-demande-certification');
    }
}
