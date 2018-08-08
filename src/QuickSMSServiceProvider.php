<?php

namespace Prosperoking\LaravelQuickSMS;

use Illuminate\Support\ServiceProvider;

class QuickSMSServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__."/config/QuickSMS.php"=>config_path('QuickSMS.php')
        ]);
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . "/config/QuickSMS.php",'QuickSMS.php');
        $this->app->singleton(QuickSMSServiceProvider::class,function($app){
            return new QuickSMSServiceProvider(config('QuickSMS'));
        });
    }
}