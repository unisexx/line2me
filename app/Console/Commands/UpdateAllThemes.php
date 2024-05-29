<?php

namespace App\Console\Commands;

use App\Http\Controllers\ScraperController;
use Illuminate\Console\Command;
// แทนที่ด้วยชื่อของคอนโทรลเลอร์ที่มีฟังก์ชัน updateAllThemes

class UpdateAllThemes extends Command
{
    protected $signature   = 'themes:update';
    protected $description = 'Update all themes every minute';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $controller = new ScraperController(); // แทนที่ด้วยชื่อของคอนโทรลเลอร์ที่มีฟังก์ชัน updateAllThemes
        $controller->updateAllThemes();
    }
}
