<?php
namespace Vonage;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;

class Vonage
{
    protected $apiDomain = 'https://my.vonagebusiness.com';
    private $cookie;
    private $client;
    public $data = array();
    public $auth = array();
    public $finalUrl;
    public $restBaseUrl;

    /**
     * @param $username
     * @param $password
     * @param array $options
     */
    public function __construct($username, $password, $options = array())
    {
        $this->restBaseUrl = $this->apiDomain . '/presence/rest/';
        $this->client = new Client(array('base_uri' => $this->restBaseUrl));
        $this->cookie = new CookieJar();
        $response = $this->client->get($this->apiDomain.'/appserver/rest/user/null',
            ['cookies' => $this->cookie, 'query' => ['htmlLogin' => $username, 'htmlPassword' => $password]]);
        $body = $response->getBody()->getContents();

        if (!empty($body)) {
            $this->auth = json_decode($body);
        }
    }

    /**
     * @param $url
     * @param array $params
     * @param array $options
     * @return array|string
     */
    public function request($url, $params = array(), $options = array())
    {
        try {
            if(isset($params) && !empty($params) && is_array($params)){
                $response = $this->client->get($url, ['cookies' => $this->cookie, 'query' => http_build_query($params)]);
                $this->finalUrl = urldecode($this->restBaseUrl . $url . '?' . http_build_query($params));
            }else{
                $response = $this->client->get($url, ['cookies' => $this->cookie]);
                $this->finalUrl = urldecode($this->restBaseUrl . $url);
            }

            return $response->getBody()->getContents();
        } catch (\Exception $e) {
            return array();
        }

    }
}