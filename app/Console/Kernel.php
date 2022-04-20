<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\GenerateSitemap::class,
        // Commands\DeleteStickerView::class,
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
        // $schedule->command('cron:delete-stickerview')->weekly()->runInBackground();
        $schedule->command('cron:crawler')->everyFiveMinutes()->appendOutputTo(storage_path('logs/crawler.log'))->runInBackground();
        $schedule->command('cron:cache-flush')->twiceDaily(1, 13)->appendOutputTo(storage_path('logs/cache-flush.log'))->runInBackground();
        $schedule->command('cron:sitemap-generate')->hourly()->appendOutputTo(storage_path('logs/sitemap-generate.log'))->runInBackground();

        // $schedule->call(function () {
        //     DB::delete("DELETE FROM sticker_views WHERE created < DATE_SUB(NOW(), INTERVAL 7 DAY)");
        // })->daily();

        // reset viewcount sticker, theme, emoji
        $schedule->call(function () {
            DB::update("update stickers set threedays = CEILING(threedays/2)");
        })->dailyAt('2:00')->appendOutputTo(storage_path('logs/threedays_sticker.log'))->runInBackground();

        $schedule->call(function () {
            DB::update("update themes set threedays = CEILING(threedays/2)");
        })->dailyAt('3:00')->appendOutputTo(storage_path('logs/threedays_theme.log'))->runInBackground();

        $schedule->call(function () {
            DB::update("update emojis set threedays = CEILING(threedays/2)");
        })->dailyAt('4:00')->appendOutputTo(storage_path('logs/threedays_emoji.log'))->runInBackground();
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
