<?php

namespace App;

class Client
{
    private $subdomain;
    private $login;
    private $hash;
    private $client;

    public function __construct($httpClient)
    {
        $client = $httpClient;
    }

    public function authorization($subdomain, $login, $hash)
    {
        $this->subdomain = $subdomain;
        $this->login = $login;
        $this->hash = $hash;
        $link = 'https://' . $subdomain . '.amocrm.ru/private/api/auth.php?type=json';
        $user = [
            'USER_LOGIN' => $login,
            'USER_HASH' => $hash,
        ];
        $headers =  [
            'User-Agent' => 'amoCRM-API-client/1.0',
            'content-type' => 'application/json',
        ];

        $response = $this->client->request('POST', $link, $headers, json_encode($user));
        $code = $response->getStatusCode();
        if ($code != 200 && $code != 204) {
            throw new Exception($code);
        }
        return true;
    }

    
}