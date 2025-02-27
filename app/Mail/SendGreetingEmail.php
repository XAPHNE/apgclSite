<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendGreetingEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $subject, $employeeName, $salutationName, $body, $signature;

    /**
     * Create a new message instance.
     */
    public function __construct($subject, $employeeName, $salutationName, $body, $signature)
    {
        $this->subject = $subject;
        $this->employeeName = $employeeName;
        $this->salutationName = $salutationName;
        $this->body = $body;
        $this->signature = $signature;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'admin.emails.email-template',
            with: [
                'employeeName' => $this->employeeName,
                'salutationName' => $this->salutationName,
                'body' => $this->body,
                'signature' => $this->signature,
            ],
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
