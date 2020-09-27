<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DevInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dev:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        $output = shell_exec('composer run-script post-root-package-install'); 
        $output = shell_exec('php artisan key:generate'); 
        $output = shell_exec('php artisan storage:link'); 
        $output = shell_exec('php artisan config:cache'); 
        $output = shell_exec('php artisan migrate'); 
        return 0;
    }
}
