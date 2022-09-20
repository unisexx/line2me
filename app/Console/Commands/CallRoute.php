<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\InputOption;

class CallRoute extends Command
{

    protected $name        = 'route:call';
    protected $description = 'Call route from CLI';

    public function __construct()
    {
        parent::__construct();
    }

    public function fire()
    {
        $request = Request::create($this->option('uri'), 'GET');
        $this->info(app()['Illuminate\Contracts\Http\Kernel']->handle($request));
    }

    protected function getOptions()
    {
        return [
            ['uri', null, InputOption::VALUE_REQUIRED, 'The path of the route to be called', null],
        ];
    }

    public function handle()
    {
        $request = Request::create($this->option('uri'), 'GET');
        $this->info(app()['Illuminate\Contracts\Http\Kernel']->handle($request));
        // return [
        //     ['uri', null, InputOption::VALUE_REQUIRED, 'The path of the route to be called', null],
        // ];
    }

}
