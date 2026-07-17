<?php

namespace App\Mail;

use App\Models\Sample;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Bus\Queueable;

class COAMail extends Mailable
{
    use Queueable, SerializesModels;

    public $sample;

    public function __construct(Sample $sample)
    {
        $this->sample = $sample;
    }

    public function build()
    {
        return $this->subject('Certificate Of Analysis')
            ->markdown('emails.coa')
            ->attachData(
                \Barryvdh\DomPDF\Facade\Pdf::loadView(
                    'coa.pdf',
                    ['sample'=>$this->sample]
                )->output(),
                $this->sample->coa->coa_number.'.pdf'
            );
    }
}