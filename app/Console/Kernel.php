<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\Ticketing;
use App\Http\Controllers\TicketingController;
use App\Http\Controllers\NotifikasiEmailController;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        
        /*$schedule->call(function () {

            $ticketNeedClosed = DB::select("EXEC p_t_ticketing_need_confirmation_closed");
            if(count($ticketNeedClosed)>0){
                foreach($ticketNeedClosed as $record){
                    $idReq = $record->id;
                    $noReq = $record->nomor_request;

                    $request = Ticketing::where('id', $idReq)->first();
                    $request->status_doc = "Closed";
                    $request->status_need_confirmation = "Puas";
                    $request->save();
                }
            }

        })->everyMinute();*/
        
        $schedule->call('App\Http\Controllers\TicketingController@autoClosedTicket')->everyMinute(); // Auto closed ticket
        //$schedule->call('App\Http\Controllers\NotifikasiEmailController@kirimEmailAuto')->everyMinute();
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
