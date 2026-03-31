<?php

namespace App\Mail;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketMail extends Mailable
{
    use SerializesModels;

    public $participant;
    public $pdf;

    public function __construct($participant, $pdf)
    {
        $this->participant = $participant;
        $this->pdf = $pdf;
    }

    public function build()
    {
        return $this->subject('EPD2026 Registration Successful')
            ->view('emails.ticket')
            ->attachData($this->pdf, 'EPD2026-Ticket.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
}