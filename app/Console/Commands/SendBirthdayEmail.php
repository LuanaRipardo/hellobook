<?php

namespace App\Commands;

use App\Models\Reader;
use Illuminate\Support\Facades\Cache;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendBirthdayEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send-birthday';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send birthday email to readers';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $readers = Reader::whereRaw('day(birthdate) = day(now()) and month(birthdate) = month(now())')->get();

        foreach ($readers as $reader) {
            $booksRead = Cache::get("reader.{$reader->id}.books_read");
            $pagesRead = Cache::get("reader.{$reader->id}.pages_read");

            Mail::send('emails.birthday', [
                'reader' => $reader,
                'booksRead' => $booksRead,
                'pagesRead' => $pagesRead,
            ], function ($message) use ($reader) {
                $message->to($reader->email, $reader->name)->subject('Happy birthday!');
            });
        }
    }
}
