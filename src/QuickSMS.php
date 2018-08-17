<?php

namespace Prosperoking\LaravelQuickSMS;

use Prosperoking\LaravelQuickSMS\Drivers\BaseDriver;
use Prosperoking\LaravelQuickSMS\Traits\HasDriver;

class QuickSMS {
    use HasDriver;
    /**
     * @var BaseDriver $messenger
     */
    private $messenger;

    public function __construct(array $config)
    {
        $provider = $config['default'];
        $setUpConfig = $config['providers'][$provider];
        $this->messenger = $this->loadDriver($setUpConfig['driver'],$setUpConfig);
    }

    /**
     * <p>Sends QuickSMS
     * </p>
     * @param array $number
     * @param $message
     * @param null $sender
     * @return array|mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendSms(array $number,$message,$sender=null)
    {
        return $this->messenger->sendSms($number,$message,$sender);
    }

}