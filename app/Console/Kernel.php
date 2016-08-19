<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // Commands\Inspire::class,
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

        // Monthly user point account update
        // Calculate user point level based on number of points
        $schedule->call(function(){
            $rate = 5;
            \DB::table('user_points')->update([
               'level' => \DB::raw('round(points/' . $rate . ')'),
               'points' => 0
            ]);
        })->monthly();
    }
}
