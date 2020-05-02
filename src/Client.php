<?php

namespace App;

class Client
{
    private $client;

    public function __construct($httpClient)
    {
        $this->client = $httpClient;
    }

    public function authorization($subdomain, $login, $hash)
    {
        $link = 'https://' . $subdomain . '.amocrm.ru/private/api/auth.php?type=json';
        $user = [
            'USER_LOGIN' => $login,
            'USER_HASH' => $hash,
        ];
        $response = $this->client->post($link, [
            'body' => json_encode($user),
        ]);
        $code = $response->getStatusCode();

        if ($code != 200 && $code != 204) {
            throw new Exception($code);
        }
        print_r(json_decode($response->getBody())); 
        return true;
    }

    
}