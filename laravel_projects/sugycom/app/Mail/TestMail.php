<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address as MailablesAddress;
use Illuminate\Mail\Mailables\Content as MailablesContent;
use Illuminate\Mail\Mailables\Envelope as MailablesEnvelope;
use Illuminate\Queue\SerializesModels;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

    public function __construct(public $name){}

    /**
     * Get the message envelope.
     */
    public function envelope(): MailablesEnvelope
    {
        return new MailablesEnvelope(
            subject: 'Hola',
            // from: new Address('hectoralonzomartinez00@gmail.com', 'Hector Martinez'),
            from: new MailablesAddress(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME')),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): MailablesContent
    {
        return new MailablesContent(
            view: 'emails.test',
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
