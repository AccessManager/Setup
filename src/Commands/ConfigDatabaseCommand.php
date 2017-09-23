<?php

namespace AccessManager\Setup\Commands;


use AccessManager\Helpers\DotEnvEditor;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

/**
 * Class ConfigDatabaseCommand
 * @package AccessManager\Setup
 */
class ConfigDatabaseCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = "config:db";

    /**
     * @var string
     */
    protected $description = "configure or update database parameters.";

    /**
     * Takes parameters from user and update the .env file with new values.
     */
    public function handle()
    {
        $this->info("Please provide following database related parameters:");
        $dbHost = $this->ask("Database Host", '127.0.0.1');
        $dbName = $this->ask("Database Name", 'acmanager');
        $dbUser = $this->ask("Database Username", 'root');
        $dbPass = $this->ask("Database Password", 'root');

        $envEditor = new DotEnvEditor($this->laravel->environmentFilePath());

        $envEditor->setDbHost($dbHost)
            ->setDbDatabase($dbName)
            ->setDbUsername($dbUser)
            ->setDbPassword($dbPass)
            ->save();
        DB::purge('mysql');
        $this->info("Configuration Successfully Updated.");
    }

}