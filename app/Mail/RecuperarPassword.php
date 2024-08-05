<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class RecuperarPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

    public $asunto;
    public $contrasena;
    public $from_cuenta;
    public $reply_cuenta;

    public function __construct($asunto, $contrasena, $from_cuenta, $reply_cuenta)
    {
        $this->asunto = $asunto;
        $this->contrasena = $contrasena;
        $this->from_cuenta = $from_cuenta;
        $this->reply_cuenta = $reply_cuenta;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('luisokokoa@gmail.com', 'Reestablecer Contraseña'),
            replyTo: [
                new Address('silva23062001@hotmail.com', 'Restablecer Contraseña'),
            ],
            subject: $this->asunto,
        );

    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'correo.correo',
        );
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