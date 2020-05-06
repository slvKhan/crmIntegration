<?php

namespace App;

class Service
{
    private $http;
    private $subdomain;

    public function __construct(object $httpClient)
    {
        $this->http = $httpClient;
    }

    public function authorization(models\User $user): bool
    {
        $this->subdomain = $user->getSubdomain();
        $link = 'https://' . $this->subdomain . '.amocrm.ru/private/api/auth.php?type=json';
        $responseBody = $this->post($link, $user->toArray());
        return $responseBody['response']['auth'];
    }

    public function listOf(string $entity): object
    {
        $link = 'https://' . $this->subdomain . '.amocrm.ru/api/v2/' . $entity;
        $response = $this->get($link);
        return Factory::collectionOf($entity, $response);
    }

    public function addLeads(array $leads): array
    {
        $postBody = ['add' => $leads];
        $link = 'https://' . $this->subdomain . '.amocrm.ru/api/v2/leads';
        return $this->post($link, $postBody);
    }

    public function addTasks(array $tasks): array
    {
        $postBody = ['add' => $tasks];
        $link = 'https://' . $this->subdomain . '.amocrm.ru/api/v2/tasks';
        return $this->post($link, $postBody);
    }

    private function get(string $link): array
    {
        $response = $this->http->get($link);
        return json_decode($response->getBody(), true);
    }

    private function post(string $link, array $postBody): array
    {
        $response = $this->http->post($link, [
            'body' => json_encode($postBody),
        ]);
        $code = $response->getStatusCode();
        $this->check($code);
        return json_decode($response->getBody(), true);
    }

    private function check(int $code)
    {
        if ($code != 200 && $code != 204) {
            throw new Exception($code);
        }
    }

    public function listLeadsFilter()
    {
        $link = 'https://' . $this->subdomain . '.amocrm.ru/api/v2/leads?filter/tasks';
        $response = $this->http->get($link);
        $responseBody = json_decode($response->getBody(), true);
        return $responseBody;
    }
}
