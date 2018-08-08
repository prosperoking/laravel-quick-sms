<?php

namespace Prosperoking\LaravelQuickSMS\Facades;

use Illuminate\Support\Facades\Facade;

class QuickSMSFacade extends Facade {

    protected static function getFacadeAccessor()
    {
        return "quicksms";
    }
}