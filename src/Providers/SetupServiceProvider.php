<?php

namespace AccessManager\Setup\Providers;


use Illuminate\Support\ServiceProvider;

class SetupServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . "/../Routes/web.php");
        $this->loadViewsFrom( __DIR__ . "/../Views", "Setup");
    }
}