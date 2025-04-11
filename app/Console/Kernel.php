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
        \App\Console\Commands\PublishFormationsCommand::class,
    ];
    

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('formations:publish') // Juste le nom de la commande, sans "php artisan"
            ->everyMinute()
            ->description('Publication automatique des formations programmées')
            ->withoutOverlapping()
            ->appendOutputTo(storage_path('logs/formation_publish.log'));
    }
    
    


    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');// Charge automatiquement toutes les commandes


        require base_path('routes/console.php');
    }
}
