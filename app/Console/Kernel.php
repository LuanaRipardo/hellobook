<?php

namespace App\Console;

use App\Models\Reader;
use Carbon\Carbon;
use App\Mail\BirthdayEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $readers = Reader::whereRaw('DATE_FORMAT(birthdate, "%m-%d") = ?', [Carbon::now()->format('m-d')])->get();
            foreach ($readers as $reader) {
                $bookReaders = $reader->bookReaders()->get();
                $totalBooksRead = $bookReaders->count();
                $totalPagesRead = $bookReaders->sum('count');
                Mail::to($reader->email)->send(new BirthdayEmail($reader, $totalBooksRead, $totalPagesRead));
            }
        })->dailyAt('03:58');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
