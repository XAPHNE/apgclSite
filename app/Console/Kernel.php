<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('app:send-scheduled-greeting-emails')
            ->dailyAt('09:30')
            ->before(function () {
                Log::info('Scheduled task is about to run.');
            })
            ->after(function () {
                Log::info('Scheduled task finished execution.');
            })
            ->onSuccess(function () {
                Log::info('Scheduled command executed successfully.');
            })
            ->onFailure(function () {
                Log::error('Scheduled command execution failed.');
            });
            
        $schedule->command('queue:work --timeout=90 --tries=3')
            ->everyMinute()
            ->withoutOverlapping();

        $schedule->command('queue:restart')->daily();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
