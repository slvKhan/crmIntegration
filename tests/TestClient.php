<?php 

require_once __DIR__.'/../vendor/autoload.php';

use GuzzleHttp\Client as Client;

$http = new Client();

$url = 'https://yandex.ru';

$response = $http->request('GET', $url);

echo $response->getBody();