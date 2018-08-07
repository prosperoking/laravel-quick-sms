<?php

namespace Prosperoking\QuickSMS;

use Illuminate\Support\ServiceProvider;
use Prosperoking\QuickSMS;

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
        $this->app->singleton(QuickSMS::class,function($app){
            return new QuickSMS(config('QuickSMS'));
        });
    }
}