<?php

namespace AccessManager\Setup\Providers;


use AccessManager\Setup\Commands\ConfigDatabaseCommand;
use AccessManager\Setup\Commands\FreshAssetsCommand;
use AccessManager\Setup\Commands\FreshSetupCommand;
use Illuminate\Support\ServiceProvider;

/**
 * Class SetupServiceProvider
 * @package AccessManager\Setup
 */
class SetupServiceProvider extends ServiceProvider
{
    /**
     * Define artisan commands to be registered.
     *
     * @var array
     */
    protected $commands = [
        FreshSetupCommand::class,
        FreshAssetsCommand::class,
        ConfigDatabaseCommand::class,
    ];

    /**
     * Register defined artisan commands.
     */
    public function boot()
    {
        $this->commands( $this->commands );
    }
}