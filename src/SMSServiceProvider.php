<?php

namespace Maxin\Sms;

use Illuminate\Support\ServiceProvider;

class SMSServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services, this method is used to boot package functionality like routes
     * 
     * cf. https://medium.com/teknomuslim/how-to-build-your-own-laravel-package-chapter-1-9ffc0da9c04d
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/sms.php' => config_path('sms.php')
        ]);
    }

    /**
     * Register services, this method is used to bind any classes or functionality into app container.
     * 
     * cf. https://medium.com/teknomuslim/how-to-build-your-own-laravel-package-chapter-1-9ffc0da9c04d
     *
     * @return void
     */
    public function register()
    {    
        // $this->loadViewsFrom(__DIR__.'/Config', '');
    }
}
