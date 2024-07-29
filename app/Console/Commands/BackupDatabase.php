<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class BackupDatabase extends Command
{
    protected $signature   = 'backup:run';
    protected $description = 'Run the database backup';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        Artisan::call('backup:run', ['--only-db' => true]);
        $this->info('Database backup completed successfully.');
    }
}
