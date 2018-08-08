<?php

namespace Prosperoking\LaravelQuickSMS\Drivers;

use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use Prosperoking\LaravelQuickSMS\Exceptions\DefaultException;
use Prosperoking\LaravelQuickSMS\Exceptions\UnknownAction;
use Prosperoking\LaravelQuickSMS\Traits\CanSendSms;

class SMSLive247 extends BaseDriver
{
    use CanSendSms;
    protected $baseUrl= "http://www.smslive247.com/http/index.aspx";
    protected $config =[
      'owner_email'=>'',
      'subacc'=>'',
      'subacc_pwd'=>''
    ];


    public function __construct(array $config)
    {
        $this->setConfig($config);
    }

    /**
     * <p> Sends a quick message
     * </p>
     * @param array $numbers
     * @param $message
     * @param null $sender
     * @return array|mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendSms(array $numbers,$message,$sender=null)
    {

        try{
            $sender = $sender?$sender:$this->senderId;
            $phones = implode(',',$numbers);
            $options = array_merge($this->getDefaultParams(),[
                'cmd'=>'sendquickmsg',
                'message'=>$message,
                'sendto'=>$phones,
                'sender'=>$sender,
                'msgType'=>0
            ]);
            $response = $this->httpClient->request('GET',$options);

            $data = $response->getBody()->getContents();

            return $this->generateResult($data);

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

    /**
     * @return array
     */
    private function getDefaultParams(){
        return [
          'ownerEmail'=>$this->config['owner_email'],
          'subacct'=>$this->config['subacc'],
          'subacctpwd'=>$this->config['subacc_pwd']
        ];
    }

    /**
     * Sets configuration options of provider
     * @param array $config
     */
    public function setConfig(array $config)
    {
        $this->config['owner_email'] = $config['owner_email'];
        $this->config['subacc'] = $config['subacc'];
        $this->config['subacc_pwd'] = $config['subacc'];
        $this->senderId = $config['senderId'];
        $this->httpClient = $this->client();
    }


    public function generateResult($content)
    {
        $info = explode($content);

        if($info[0] === 'OK')
        {
            return [
                'status'=>true,
                'message_id'=>trim($info[1])
            ];
        }

        if($info[1]==='ERR')
        {
            return [
                'status'=>false,
                'err_number'=>trim($info[1]),
                'err_description'=>trim($info[2]),
                'message'=>trim($info[2])
            ];
        }

        throw new UnknownAction('Unable to determine operation: '.$content);
    }
}