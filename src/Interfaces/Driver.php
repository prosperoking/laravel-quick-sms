<?php
/**
 * Created by PhpStorm.
 * User: prosperoking
 * Date: 8/7/18
 * Time: 1:04 PM
 */

namespace Prosperoking\QuickSMS\Interfaces;


interface Driver
{
    public function sendSms(array $numbers,string $message);
}