<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Carbon\Carbon;

class DatabaseBackUp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'database:backup';
  
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Everyday Database Backup';
  
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
        $filename = "backup-" . Carbon::now()->format('Y-m-d') . ".gz";
  
        $command = "mysqldump --user=".envfile('DB_USERNAME')." --password=".envfile('DB_PASSWORD')." --host=".envfile('DB_HOST')." ".envfile('DB_DATABASE')." | gzip > ".storage_path() . "/app/backup/".$filename;
  
        $returnVar = NULL;
        $output  = NULL;
  

        // mysqldump -u root -p'buildadoor~!@' fisheye > /dev/null 2>&1 /home/streamhash/streamview-backend-vu-package/public/DB-backup/streamview_$( date +"%Y_%m_%d" ).sql

        exec($command, $output, $returnVar);
    }
}