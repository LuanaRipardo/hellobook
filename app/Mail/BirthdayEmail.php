<?php

namespace App\Mail;

use App\Models\Reader;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BirthdayEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $reader;
    public $totalBooksRead;
    public $totalPagesRead;

    public function __construct(Reader $reader, $totalBooksRead, $totalPagesRead)
    {
        $this->reader = $reader;
        $this->totalBooksRead = $totalBooksRead;
        $this->totalPagesRead = $totalPagesRead;
    }

    public function build()
    {
        return $this->view('emails.birthday');
    }
}
