<?php

namespace App\Mail;

use App\Models\EventFeedback;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EventFeedbackInvitationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public EventFeedback $feedback)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Como foi sua experiencia em '.$this->feedback->event->title.'?',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.event-feedback-invitation',
            with: [
                'feedback' => $this->feedback,
                'event' => $this->feedback->event,
            ],
        );
    }
}
