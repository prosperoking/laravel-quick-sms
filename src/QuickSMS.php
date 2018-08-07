<?php

namespace Prosperoking\QuickSMS;

use Prosperoking\QuickSMS\Traits\HasDriver;

class QuickSMS {
    use HasDriver;

    private $messenger;

    public function __construct(array $config)
    {
        $provider = $config['default'];
        $this->messenger = $this->loadDriver($provider,$config['providers'][$provider]);
    }

    public function sendSms(string $string, string $phone)
    {
        return $this->messenger->sendSms($string,$phone);
    }

    public function sendQuickSms()
    {
        return $this->messenger->sendQuickSms($string, $phone);
    }

}