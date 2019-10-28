<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class DeleteStickerView extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:deletestickerview';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete Sticker_View';

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
        DB::delete("DELETE FROM sticker_views WHERE created < DATE_SUB(NOW(), INTERVAL 7 DAY)");
    }
}
