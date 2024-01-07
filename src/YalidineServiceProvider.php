<?php

namespace Yacinediaf\Yalidine;

use Illuminate\Support\ServiceProvider;

class YalidineServiceProvider extends ServiceProvider
{


    public function register()
    {
        $this->app->singleton(Yalidine::class, function () {

            return new Yalidine();
        });
    }


    public function boot()
    {
        /**
         * publish yalidine config file into the laravel config files
         */

        $this->publishes([

            __DIR__ . '/../config/yalidine.php' => config_path('yalidine.php')

        ]);
    }
}
