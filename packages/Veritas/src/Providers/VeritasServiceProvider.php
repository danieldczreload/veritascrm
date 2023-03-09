<?php

namespace Veritas\Providers;
use Illuminate\Support\ServiceProvider;
class VeritasServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'veritas');
        $this->loadRoutesFrom(__DIR__ . '/../Http/routes.php');
    }
    public function register()
    {
        /*$this->mergeConfigFrom(__DIR__ . '/../config/veritas.php', 'veritas');*/
    }

}
