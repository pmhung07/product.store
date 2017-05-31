<?php

namespace App\Hocs\Sms;

class SmsService implements SmsInterface {

    protected $apiKey;

    protected $secret;

    protected $restUri = 'http://rest.esms.vn/MainService.svc/json/SendMultipleMessage_V4_get';

    protected $successData = array();

    protected $success;

    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function getApiKey()
    {
        return $this->apiKey;
    }

    public function setSecret($secret)
    {
        $this->secret = $secret;
    }

    public function getSecret()
    {
        return $this->secret;
    }

    public function send($phone, $message)
    {
        $url = $this->restUri ."?".http_build_query([
            'Phone' => $phone,
            'ApiKey' => $this->getApiKey(),
            'SecretKey' => $this->getSecret(),
            'Content' => urlencode($message),
            'SmsType' => 4
        ]);

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_FAILONERROR, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($curl);
        $obj = json_decode($result,true);

        if($obj['CodeResult'] == 100) {
            $this->successData[] = $obj;
            $this->success = true;
        } else {
            throw new \Exception("Send message error: ".$obj['ErrorMessage'], 1);
        }
    }

    public function successData()
    {
        return $this->successData;
    }

    public function success()
    {
        return $this->success;
    }
}