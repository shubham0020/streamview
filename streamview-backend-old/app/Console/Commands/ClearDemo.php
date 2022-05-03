<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ClearDemo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command used only for demo purpose';

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
        \Artisan::call('db:wipe');

        \DB::unprepared(file_get_contents(public_path('DB/streamview.sql')));

        $demo_file_path = public_path('demos/uploads.zip');

        $extract_path = public_path('uploads');

        if(file_exists($demo_file_path) && file_exists($extract_path)) {

            shell_exec("unzip $demo_file_path -d $extract_path");
        }

        $this->info('Your Demo Restored');
    }
}
