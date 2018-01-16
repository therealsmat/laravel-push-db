<?php

namespace therealsmat\PushDB;

use Illuminate\Support\Facades\Config;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class PushDB
{
    /**
     * Your database name
     * @var
     */
    protected $db_name;

    /**
     * Your database username
     * @var
     */
    protected $db_username;

    /**
     * Your database password
     * @var
     */
    protected $db_password;

    /**
     * Path to store the output file
     * @var
     */
    protected $outputPath;

    public function __construct()
    {
        $this->setConfig();
    }

    /**
     * Get database name, username and password
     */
    private function setConfig()
    {
        $this->db_name = Config::get('pushdb.db_database');

        $this->db_username = Config::get('pushdb.db_username');

        $this->db_password = Config::get('pushdb.db_password');

        $this->outputPath = Config::get('pushdb.output_path');
    }

    /**
     * Perform the actual export function
     * @param null $database
     * @return bool
     */
    public function export($database = null)
    {
        if (NULL != $database) $this->db_name = $database;

        $process = new Process($this->command());
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        return true;
    }

    /**
     * Build the command to be processed and return as a string
     * @return string
     */
    private function command()
    {
        $command = "mysqldump --opt --user=". $this->db_username
                                ." --password=". $this->db_password
                                . " ".$this->db_name ." > "
                                . $this->outputPath;

        return $command;
    }
}