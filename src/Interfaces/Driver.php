<?php
/**
 * Created by PhpStorm.
 * User: prosperoking
 * Date: 8/7/18
 * Time: 1:04 PM
 */

namespace Prosperoking\LaravelQuickSMS\Interfaces;


interface Driver
{

    /**
     * <p> Sends a quick message
     * </p>
     * @param array $numbers
     * @param $message
     * @param null $sender
     * @return array|mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendSms(array $numbers, $message,$sender=null);

    /**
     * @param array $config
     * @return void
     */
    public function setConfig(array $config);
}