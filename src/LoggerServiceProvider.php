<?php

namespace Eklundkristoffer\Logger;

use Illuminate\Support\ServiceProvider;

class LoggerServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/Config/laravel-user-logger.php' => config_path('laravel-user-logger.php')
        ], 'laravel-user-logger:config');
    }
}
