<?php
/**
 * Created by PhpStorm.
 * User: prosperoking
 * Date: 8/7/18
 * Time: 12:54 PM
 */

namespace Prosperoking\LaravelQuickSMS\Traits;

use GuzzleHttp\Client as HTTPClient;

trait CanSendSms
{
    public function client()
    {
        return new HTTPClient([
            "base_uri"=>$this->baseUrl,
            "timeout"=>2.0,
        ]);
    }

}