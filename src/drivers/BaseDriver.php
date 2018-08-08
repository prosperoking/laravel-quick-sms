<?php
/**
 * Created by PhpStorm.
 * User: prosperoking
 * Date: 8/7/18
 * Time: 12:58 PM
 */

namespace Prosperoking\LaravelQuickSMS\Drivers;

use GuzzleHttp\Client;
use Prosperoking\LaravelQuickSMS\Interfaces\Driver;

abstract class BaseDriver implements Driver
{
    /**
     * @var string $senderId
     */
    protected $senderId = '';
    /**
     * @var string $baseUrl
     */
    protected $baseUrl;
    /**
     * @var array $config
     */
    protected $config;
    /**
     * @var Client $httpClient
     */
    protected $httpClient;
}