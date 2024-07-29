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
        Commands\CallRoute::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // อัพเดท theme section
        $schedule->command('themes:update')->everyMinute();

        // $schedule->command('cron:delete-stickerview')->weekly()->runInBackground();
        $schedule->command('cron:crawler')->everyThirtyMinutes()->appendOutputTo(storage_path('logs/crawler.log'))->runInBackground();
        $schedule->command('cron:cache-flush')->twiceDaily(1, 13)->appendOutputTo(storage_path('logs/cache-flush.log'))->runInBackground();
        $schedule->command('cron:sitemap-generate')->daily()->appendOutputTo(storage_path('logs/sitemap-generate.log'))->runInBackground();

        $schedule->command('backup:run')
            ->dailyAt('02:00')
            ->withoutOverlapping()
            ->runInBackground(); // ตั้งเวลาที่ต้องการ เช่น 02:00 น.

        $schedule->command('backup:clean')
            ->dailyAt('03:00')
            ->withoutOverlapping()
            ->runInBackground(); // ตั้งเวลาที่ต้องการ เช่น 03:00 น.

        $schedule->command('productviews:delete-old')
            ->dailyAt('04:00')
            ->withoutOverlapping()
            ->runInBackground(); // รันทุกๆ ตี 4

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
