<?php

namespace Prosperoking\LaravelQuickSMS\Traits;

use Prosperoking\LaravelQuickSMS\Drivers\SMSLive247;
use Prosperoking\LaravelQuickSMS\Exceptions\UnknownDriver;
use Prosperoking\QuickSMS\Drivers\SmsMobile;

trait HasDriver
{
    private $drivers = [
        'smslive'=>SMSLive247::class,
        'smsmobile'=>SmsMobile::class
    ];

    /**
     * @param string $name
     * @param $config
     * @return mixed
     * @throws UnknownDriver
     */
    private function loadDriver(string $name,$config)
    {
       if(!isset($this->drivers[$name])){
        throw new UnknownDriver("The driver '{$name}' is not supported. Please check your spelling");
       }
       return new $this->drivers[$name]($config);
    }
}