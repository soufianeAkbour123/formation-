<?php

namespace App\Mail;

use App\Models\Payment; // Assurez-vous d'importer la classe Payment
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;

class InvalidationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $payment;
    public $imagePath;

    /**
     * Create a new message instance.
     */
    public function __construct(Payment $payment, $imagePath)
    {
        $this->payment = $payment;
        $this->imagePath = $imagePath;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reçu invalide',
        );
    }

    /**
     * Build the message content.
     */
    public function build()
    {
        return $this->view('mail.invalidation')
                    ->subject('Invalidation de reçu')
                    ->with([
                        'name' => strtoupper($this->payment->name),
                        'imagePath' => $this->imagePath, // Utilisation de l'image dans le message
                    ])
                    ->attach($this->imagePath, [
                        'as' => 'recu.jpg',
                        'mime' => 'image/jpeg',
                    ]);
    }


    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}