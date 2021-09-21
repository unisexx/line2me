<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

// use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\GenerateSitemap::class,
        Commands\DeleteStickerView::class,
        Commands\CacheFlush::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('cron:sitemap-generate')->hourly()->runInBackground();
        $schedule->command('cron:delete-stickerview')->weekly()->runInBackground();
        $schedule->command('cron:crawler')->everyFiveMinutes()->runInBackground();
        $schedule->command('cron:cache-flush')->twiceDaily(1, 13)->runInBackground();

        // $schedule->call(function () {
        //     DB::delete("DELETE FROM sticker_views WHERE created < DATE_SUB(NOW(), INTERVAL 7 DAY)");
        // })->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
