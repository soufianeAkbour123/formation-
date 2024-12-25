<?php

namespace App\Mail;

use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;

class PromoEmail extends Mailable
{
    use Queueable;

    public $code;
    public $expirationDate;
    public $course;

    /**
     * Créer une nouvelle instance.
     */
    public function __construct($code, $expirationDate, $courses = [])
    {
        $this->code = $code;
        $this->expirationDate = $expirationDate;
        $this->courses = $courses;  // Accepter une liste de cours
    }

    /**
     * Définir l'enveloppe de l'email.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Votre Code Promo Exclusif',
        );
    }

    /**
     * Définir le contenu de l'email.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.promo',
            with: [
                'code' => $this->code,
                'expirationDate' => $this->expirationDate,
                'courses' => $this->courses,  // Passer la liste des cours
            ],
        );
    }

    /**
     * Ajouter des pièces jointes (si nécessaire).
     */
    public function attachments(): array
    {
        return [];
    }
}