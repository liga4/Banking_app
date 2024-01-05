<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        Commands\RefreshDataFromApi::class,
    ];
    protected function schedule(Schedule $schedule):void
    {
        $schedule->command('currencyRates:refresh')->daily();
        $schedule->command('cryptoRates:refresh')->everyMinute();
    }

    protected function commands():void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
