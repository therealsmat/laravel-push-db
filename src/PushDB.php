<?php

namespace therealsmat\PushDB;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class PushDB
{
    use Notifiable;

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
     * @var
     */
    protected $directory;

    /**
     * Path to store the output file
     * @var
     */
    protected $file_name;

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

        $this->directory = Config::get('pushdb.storage_directory');

        $this->file_name = Config::get('pushdb.file_name');
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
                                . $this->getFileName();

        return $command;
    }

    /**
     * Return a unique file name for storage
     * @return string
     */
    private function getFileName()
    {
        if (!Storage::exists($this->directory)) {
            Storage::makeDirectory($this->directory);
        }
        return storage_path('app/'.$this->directory.'/'.date('Y-m-d_h:i:s_').$this->file_name);
    }

    /**
     * Get a list of your backups
     * @return mixed
     */
    public function backups()
    {
        return Storage::files($this->directory);
    }

}