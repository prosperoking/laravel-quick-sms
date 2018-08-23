<?php
/**
 * Created by PhpStorm.
 * User: prosperoking
 * Date: 8/23/18
 * Time: 10:09 AM
 */
namespace Prosperoking\LaravelQuickSMS\Drivers;


use Prosperoking\LaravelQuickSMS\Traits\CanSendSms;

class SmsMobile  extends  BaseDriver
{
    use CanSendSms;
    protected $baseUrl= "http://www.smsmobile24.com/index.php";
    protected $confif = [
      'username'=>'',
      'password'=>''
    ];
    protected $senderId = "";
    protected $httpClient;
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
                'message'=>$message,
                'recipient'=>$phones,
                'sender'=>$sender,
            ]);
            $response = $this->httpClient->request('POST',null,['form_params'=>$options]);
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

    public function setConfig(array $config)
    {
        $this->config['username'] = $config['username'];
        $this->config['password'] = $config['password'];
        $this->senderId = $config['senderId'];
        $this->httpClient = $this->client();
    }

    /**
     * @return array
     */
    private function getDefaultParams(){
        return [
            'option'=>'com_spc',
            'comm'=>'spc_api',
        ];
    }

    public function generateResult($content)
    {
        $info = explode(' ',$content);
        if($info[0] === 'OK')
        {
            return [
                'status'=>true,
                'message_id'=>trim($info[1])
            ];
        }

        if($info[0]==='2904')
        {
            return [
                'status'=>false,
                'err_number'=>2904,
                'err_description'=>"SMS Sending Failed",
                'message'=>"SMS Sending Failed"
            ];
        }

        throw new UnknownAction('Unable to determine operation: '.$content);
    }
}