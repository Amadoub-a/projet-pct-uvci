<?php

namespace App\Services;

use GuzzleHttp\Client;
use Brevo\Client\Configuration;
use Brevo\Client\Api\TransactionalSMSApi;
use Brevo\Client\Model\SendTransacSms;

class SmsService
{
    protected $apiInstance;

    public function __construct()
    {
        $config = Configuration::getDefaultConfiguration()
            ->setApiKey('api-key', config('services.brevo.key'));

        $this->apiInstance = new TransactionalSMSApi(
            new Client(),
            $config
        );
    }

    public function sendSms(string $to, string $message)
    {
        $sendSms = new SendTransacSms([
            'sender' => config('services.brevo.sender'),
            'recipient' => $to,
            'content' => $message,
            'type' => 'transactional'
        ]);

        try {
            $result = $this->apiInstance->sendTransacSms($sendSms);
            return $result;
        } catch (\Exception $e) {
            throw new \Exception("Erreur d'envoi SMS: " . $e->getMessage());
        }
    }
}
