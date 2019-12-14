<?php

namespace App\Console\Commands;

use App\Http\Controllers\Admin\CrawlerController;
use Illuminate\Console\Command;

class Crawler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:crawler';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawler';

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
        // Sticker
        echo CrawlerController::getstickerstore('1', 'new', '1');
        echo CrawlerController::getstickerstore('1', 'top', '1');
        echo CrawlerController::getstickerstore('2', 'new_creators', '1');
        echo CrawlerController::getstickerstore('2', 'top_creators', '1');
        echo CrawlerController::getstickerstore('2', 'new_top_creators', '1');

        // Theme
        echo CrawlerController::getthemestore('1', 'top', '1');
        echo CrawlerController::getthemestore('1', 'new', '1');
        echo CrawlerController::getthemestore('2', 'top_creators', '1');
        echo CrawlerController::getthemestore('2', 'new_creators', '1');

        // Emoji
        echo CrawlerController::getemojistore('1', 'new', '1');
        echo CrawlerController::getemojistore('1', 'top', '1');
        echo CrawlerController::getemojistore('2', 'top_creators', '1');
        echo CrawlerController::getemojistore('2', 'new_top_creators', '1');
        echo CrawlerController::getemojistore('2', 'new_creators', '1');
    }
}
