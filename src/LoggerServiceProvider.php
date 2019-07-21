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
    }
    public function register()
    {

        App::singleton('logger', function(){
            return new Logger();
        });

    }
}