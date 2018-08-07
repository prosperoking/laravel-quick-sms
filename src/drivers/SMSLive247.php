<?php

namespace Prosperoking\QuickSMS\Drivers;

use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use Prosperoking\QuickSMS\Exceptions\DefaultException;
use Prosperoking\QuickSMS\Traits\CanSendSms;

class SMSLive247 extends BaseDriver
{
    use CanSendSms;
    private $baseUrl= "http://www.smslive247.com/http/index.aspx";
    private $config =[
      'owner_email'=>'',
      'subacc'=>'',
      'subacc_pwd'=>''
    ];
    private $senderId = "";
    private $httpClient;
    public function __construct($config)
    {
       $this->config['owner_email'] = $config['owner_email'];
       $this->config['subacc'] = $config['subacc'];
       $this->config['subacc_pwd'] = $config['subacc'];
       $this->httpClient = $this->client();
    }

    public function sendSms(array $numbers,string $message)
    {

        try{
            $phones = implode(',',$numbers);
            $response = $this->httpClient->request('GET',[
                ''
            ]);

        }catch (ConnectException $connectException)
        {
            return [
                'message'=>$connectException->getMessage(),
                "status"=>false
            ];
        }catch(RequestException $requestException){
            return [
                'message'=>$requestException->getMessage(),
                "status"=>false
            ];
        }catch (DefaultException $exception)
        {
            return [
                'message'=>$exception->getMessage(),
                "status"=>false
            ];
        }
    }

    private function getLoginUrl($action)
    {
        return null;
    }

    private function getDefaultParams(){
        return [
          'ownerEmail'=>$this->config['owner_email'],
          'subacct'=>$this->config['subacc'],
          'subacctpwd'=>$this->config['subacc_pwd']
        ];
    }

}