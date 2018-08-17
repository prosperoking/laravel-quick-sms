<?php

namespace Prosperoking\LaravelQuickSMS;

use Illuminate\Support\ServiceProvider;

class QuickSMSServiceProvider extends ServiceProvider
{
    protected $defer = true;

    public function boot()
    {
        $this->publishes([
            __DIR__."/config/QuickSMS.php"=>config_path('QuickSMS.php')
        ]);
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . "/config/QuickSMS.php",'QuickSMS.php');
        $this->app->singleton('quickSms',function($app){
            $config = $app->make('config');
            $data = $config->get('QuickSMS');
            return new QuickSMS($data);
        });
    }

    public function provides()
    {
        return ['quickSms'];
    }
}