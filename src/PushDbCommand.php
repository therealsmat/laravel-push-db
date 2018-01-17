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
     * Instance of the push db class
     * @var
     */
    private $_db;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->_db = new PushDB();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try{
            if ($this->_db->export()) {
                $this->info('Database Export Successful');
                return;
            }
            $this->error('Could not export database');
        } catch (ProcessFailedException $e)
        {
            $this->error($e->getMessage());
        } catch (\Exception $e)
        {
            $this->error($e->getMessage());
        }
    }
}
