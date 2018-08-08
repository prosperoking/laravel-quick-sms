<?php

namespace Prosperoking\LaravelQuickSMS;

use Illuminate\Support\Facades\Facade;

class QuickSMSFacade extends Facade {

    protected static function getFacadeAccessor()
    {
        return "quicksms";
    }
}