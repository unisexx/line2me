<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DeleteOldProductViews extends Command
{
    protected $signature   = 'productviews:delete-old';
    protected $description = 'Delete product views older than 5 days';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        DB::table('product_views')->where('created_at', '<', now()->subDays(5))->delete();
        $this->info('Old product views deleted successfully.');
    }
}
