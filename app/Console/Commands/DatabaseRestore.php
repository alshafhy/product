<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DatabaseRestore extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:restore {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs the mysql utility to restore database using info from .env';

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
        $ds = DIRECTORY_SEPARATOR;

        $host = env('DB_HOST');
        $username = env('DB_USERNAME');
        $password = env('DB_PASSWORD');
        $database = env('DB_DATABASE');
        
        $ts = time();

        //$path = database_path() . $ds . 'backups' . $ds . date('Y', $ts) . $ds . date('m', $ts) . $ds . date('d', $ts) . $ds;
        $path = database_path() . $ds . 'backups' . $ds ;
        // $file = date('Y-m-d-His', $ts) . '-dump-' . $database . '.sql';
        $file = $this->argument('file');
        // $command = sprintf('mysqldump -h %s -u %s -p\'%s\' %s > %s', $host, $username, $password, $database, $path . $file);

        $command = sprintf('mysql -u %s -p%s -h %s %s < %s', $username, $password, $host, $database, $path . $file);
        $this->info("Start Run:- " .$this->removePasswordFromCommand($command) ." on database : $database on host : $host ");
        exec($command);
        $this->info("Finished Successfully");
    }

    /**
     * Remove the -ppassword with -p***
     *
     * @param $command
     *
     * @return mixed
     */
    protected function removePasswordFromCommand($command)
    {
        return preg_replace('/-p.* /', '-p**** ', $command) ;
    }
}
