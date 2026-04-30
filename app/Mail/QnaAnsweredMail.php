<?php

namespace App\Mail;

use App\Models\Qna;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QnaAnsweredMail extends Mailable
{
    use Queueable, SerializesModels;

    public $qna;

    public function __construct(Qna $qna)
    {
        $this->qna = $qna;
    }

    public function build()
    {
        return $this->subject('Pertanyaan Anda Telah Dijawab!')
                    ->markdown('emails.qna_answered');
    }
}
