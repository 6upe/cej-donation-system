<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade as PDF;

class DonationConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $donation;
    public $pdf;

    /**
     * Create a new message instance.
     */
    public function __construct($donation, $pdf)
    {
        $this->donation = $donation;
        $this->pdf = $pdf;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Donation Confirmation - Thank You!')
                    ->view('emails.donation_confirmation')
                    ->attachData($this->pdf->output(), 'donation_invoice.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}
