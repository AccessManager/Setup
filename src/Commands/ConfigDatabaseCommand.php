<?php

namespace AccessManager\Setup\Commands;


use Illuminate\Config\Repository;
use Illuminate\Console\Command;
use Jackiedo\DotenvEditor\DotenvEditor;

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
     * @var DotenvEditor
     */
    protected $env;

    /**
     * @var Repository
     */
    protected $config;

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

        $this->writeEnvironmentVariablesToEnv([
            'APP_NAME'      =>  'Access Manager',
            'DB_HOST'       =>  $dbHost,
            'DB_DATABASE'   =>  $dbName,
            'DB_USERNAME'   =>  $dbUser,
            'DB_PASSWORD'   =>  $dbPass,
        ]);

        $this->setEnvironmentVariables([
            'host'      =>  $dbHost,
            'database'  =>  $dbName,
            'username'  =>  $dbUser,
            'password'  =>  $dbPass,
        ]);
    }

    /**
     * Updates .env file with new variable values.
     * @param array $params
     */
    protected function writeEnvironmentVariablesToEnv( array $params )
    {
        $variables = [];
        foreach ($params as $key => $value )
        {
            $variables[] = [
                'key'       =>  $key,
                'value'     =>  $value,
                'comment'   =>  'set via access-manager config:db command',
            ];
        }
        $this->env->setKeys($variables);
        $this->env->save();
    }

    /**
     * update current request with new config values.
     * @param array $params
     */
    protected function setEnvironmentVariables( array $params )
    {
        foreach ( $params as $key => $value )
        {
            $this->config->set("database.connections.mysql.$key", $value);
//            config(['database.connections.mysql.'. $key => $value]);
        }
    }

    /**
     * ConfigDatabaseCommand constructor.
     * @param DotenvEditor $env
     * @param Repository $config
     */
    public function __construct( DotenvEditor $env, Repository $config  )
    {
        parent::__construct();
        $this->env = $env;
        $this->config = $config;
    }


}