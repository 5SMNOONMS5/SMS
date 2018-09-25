<?php

namespace Maxin\Sms;

use Illuminate\Support\ServiceProvider;
use Laravel\Socialite\Contracts\Factory;

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

        $this->bootDatabase();

        $this->bootModels();
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
  
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [Factory::class];
    }

    private function bootDatabase()
    {
        $this->publishes([
            __DIR__.'/../database/seeds/'      => database_path('seeds'),
            __DIR__.'/../database/migrations/' => database_path('migrations'),
            __DIR__.'/../database/factory/'    => database_path('factories'),
            __DIR__.'/../database/faker/'      => app_path()
        ], "SMS");
    }

    private function bootModels() 
    {
        $this->publishes([
            __DIR__.'/../models/' => app_path("Http"),
        ], "SMS");
    }

}

