<?php
/**
 * Created by PhpStorm.
 * User: swpi
 * Date: 21.07.19
 * Time: 14:04
 */

namespace Logger;

use Illuminate\Support\ServiceProvider;


class LoggerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([__DIR__ . '/../config/' => config_path() . '/']);

        $this->publishes([__DIR__ . '/../app/' => app_path() . '/']);
    }
    public function register()
    {

        $this->app->singleton(Logger::class, function(){
            return new Logger;
        });

    }
}