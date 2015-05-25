<?php

namespace Vonage;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;

class Vonage
{
    private $cookie;
    private $client;

    public $auth = array();

    protected $vonageApiUrl = 'https://my.vonagebusiness.com';

    public function __construct($username, $password, $options = array())
    {
        $this->client = new Client();
        $this->cookie = new CookieJar();

        $response = $this->client->get($this->vonageApiUrl . '/appserver/rest/user/null',
            [
                'cookies' => $this->cookie,
                'query' => ['htmlLogin' => $username, 'htmlPassword' => 'ltqpsmr7']
            ]
        );

        if (!empty($response->getBody()->getContents())) {
            $this->auth = json_decode($response->getBody()->getContents());
        }
    }

    /**
     * @param $number
     * @return bool|string
     */
    public function makeCall($number)
    {
        try {
            $response = $this->client->get($this->vonageApiUrl . '/presence/rest/clicktocall/' . $number,
                ['cookies' => $this->cookie]);

            return $response->getBody()->getContents();
        } catch (\Exception $e) {
            return false;
        }
    }
}