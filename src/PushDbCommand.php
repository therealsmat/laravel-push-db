<?php

namespace therealsmat\PushDB;

use Illuminate\Console\Command;
use Symfony\Component\Process\Exception\ProcessFailedException;

class PushDbCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:push';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export the specified database';

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
        $db = new \therealsmat\PushDB\PushDB();

        try{
            if ($db->export()) {
                return 'Database Export Successful';
            }
            return 'Database export not successful';
        } catch (ProcessFailedException $e)
        {
            return $e->getMessage();
        }
    }
}
