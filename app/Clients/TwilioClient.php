<?php

namespace App\Clients;

use Twilio\Rest\Client;

class TwilioClient
{
    /**
     *
     * @var array
     */
    protected array $config;

    protected Client $client;

    /**
     * 
     */
    public function __construct()
    {
        $this->config = config('services.twilio');

        $this->client = $this->initClient();
    }

    public function initClient() 
    {
        return $this->client = new Client(
            $this->config['account_sid'],
            $this->config['auth_token'],
        );
    }

    public function getClient()
    {
        return $this->client;
    }

}