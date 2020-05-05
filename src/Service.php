<?php

namespace App;

class Service
{
    private $http;
    private $subdomain;

    public function __construct($httpClient)
    {
        $this->http = $httpClient;
    }

    /**
     * 
     * returns true with succes authorization
     */
    public function authorization($user)
    {
        $this->subdomain = $user->getSubdomain();
        $link = 'https://' . $this->subdomain . '.amocrm.ru/private/api/auth.php?type=json';
        $responseBody = $this->post($link, $user->toArray());
        return $responseBody['response']['auth'];
    }

    public function listOf($entity)
    {
        $link = 'https://' . $this->subdomain . '.amocrm.ru/api/v2/' . $entity;
        $response = $this->get($link);
        return Factory::collectionOf($entity, $response);
    }

    public function addLeads($leads)
    {
        $postBody = ['add' => $leads];
        $link = 'https://' . $this->subdomain . '.amocrm.ru/api/v2/leads';
        return $this->post($link, $postBody);
    }

    public function addTasks($tasks)
    {
        $postBody = ['add' => $tasks];
        $link = 'https://' . $this->subdomain . '.amocrm.ru/api/v2/tasks';
        return $this->post($link, $postBody);
    }

    private function get($link)
    {
        $response = $this->http->get($link);
        return json_decode($response->getBody(), true);
    }

    private function post($link, $postBody)
    {
        $response = $this->http->post($link, [
            'body' => json_encode($postBody),
        ]);
        $code = $response->getStatusCode();
        if ($code != 200 && $code != 204) {
            throw new Exception($code);
        }
        return json_decode($response->getBody(), true);
    }

    /**
     * didnt work
     * filter/tasks	Выбрать сделки без задач – 1
     */

    public function listLeadsFilter()
    {
        $link = 'https://' . $this->subdomain . '.amocrm.ru/api/v2/leads?filter/tasks';
        $response = $this->http->get($link);
        $responseBody = json_decode($response->getBody(), true);
        return $responseBody;
    }
    
}
