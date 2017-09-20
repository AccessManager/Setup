<?php

namespace AccessManager\Setup\Commands;


use AccessManager\Auth\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

/**
 * Class FreshSetupCommand
 * @package AccessManager\Setup
 */
class FreshSetupCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = "setup:fresh";

    /**
     * @var string
     */
    protected $description = "handles setting up fresh installation of Access Manager";

    /**
     * Method used to setup & configure fresh installation of Access Manager.
     */
    public function handle()
    {
        //copy assets.
        $this->call("assets:fresh");

        //update database configuration
        $this->call("config:db");

        //create default admin account.
        $this->addAdminAccount();
    }

    /**
     * Create a new Account for Administrator.
     */
    protected function addAdminAccount()
    {
        //disconnect existing DB connection to reconnect with new updated config variables.
        DB::purge('mysql');

        $this->line("Deleting any existing admin accounts.");
        //empty users table.
        User::truncate();

        $this->line("Creating admin account.");
        $username = 'admin';
        $password = 'AccessManager3';

        $user = new User([
            'username'  =>  $username,
            'password'  =>  $password,
            'name'      =>  'Administrator',
            'email'     =>  'access@manager',
        ]);
        $user->saveOrFail();

        $this->line("Account successfully created.");
        $this->info("Username: $username");
        $this->info("Password: $password");
        $this->line("Run 'php artisan admin:reset' to reset admin password.");
    }

}