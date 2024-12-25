<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Orderconfirm extends Mailable
{
    use Queueable, SerializesModels;

    // Déclaration des propriétés pour stocker les données de l'email et le chemin du PDF
    private $data;
    private $pdfPath;

    /**
     * Create a new message instance.
     *
     * @param array $data
     * @param string|null $pdfPath
     */
    public function __construct($data, $pdfPath = null)
    {
        $this->data = $data;
        $this->pdfPath = $pdfPath; // Assignation correcte de $pdfPath
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Votre commande est confirmée', // Sujet de l'email
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.order_mail',
            with: ['data' => $this->data], // Passer les données à la vue
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            // Ajouter le PDF comme pièce jointe
            \Illuminate\Mail\Mailables\Attachment::fromPath($this->pdfPath)
                ->as('Validationpayment.pdf')
                ->withMime('application/pdf'),
        ];
    }
}