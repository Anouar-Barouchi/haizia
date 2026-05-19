<?php

namespace App\Mail;

use App\Models\Candidate;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CandidateInvitationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $candidate;
    public $setupUrl;

    /**
     * Create a new message instance.
     */
    public function __construct(Candidate $candidate)
    {
        $this->candidate = $candidate;
        $this->setupUrl = \Illuminate\Support\Facades\URL::signedRoute('portal.setup', ['id' => $candidate->id]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'دعوة حضور نهائية',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.candidate_invitation',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        $pdf = \Mccarlosen\LaravelMpdf\Facades\LaravelMpdf::loadView('pdf.badges', ['candidates' => [$this->candidate]], [], [
            'mode' => 'utf-8',
            'format' => [106, 155], // B4 derived size 106x155 mm
            'margin_left' => 0,
            'margin_right' => 0,
            'margin_top' => 0,
            'margin_bottom' => 0,
            'margin_header' => 0,
            'margin_footer' => 0,
            'autoScriptToLang' => true,
            'autoLangToFont' => true,
        ]);
        
        return [
            Attachment::fromData(fn () => $pdf->output(), 'badge.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
