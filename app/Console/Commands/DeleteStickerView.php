<?php

namespace App\Console\Commands;

use DB;
use Illuminate\Console\Command;

class DeleteStickerView extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:delete-stickerview';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete Sticker_View';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        DB::delete("DELETE FROM sticker_views WHERE created < DATE_SUB(NOW(), INTERVAL 7 DAY)");
    }
}
