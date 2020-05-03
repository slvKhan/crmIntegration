<?php

namespace App;

class Service
{
    private $http;

    public function __construct($httpClient)
    {
        $this->http = $httpClient;
    }

    /**
     * 
     * will return true with succes
     */
    public function authorization($subdomain, $login, $hash)
    {
        $link = 'https://' . $subdomain . '.amocrm.ru/private/api/auth.php?type=json';
        $user = [
            'USER_LOGIN' => $login,
            'USER_HASH' => $hash,
        ];
        $response = $this->http->post($link, [
            'body' => json_encode($user),
        ]);
        $code = $response->getStatusCode();
        if ($code != 200 && $code != 204) {
            throw new Exception($code);
        }
        $responseBody = json_decode($response->getBody(), true);
        if ($responseBody) {
            return true;
        }
        return false;
        // dump($responseBody);
        // dump($response);
    }

    
}
