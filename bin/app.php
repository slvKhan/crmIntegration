<?php

namespace App;

require_once __DIR__.'/../vendor/autoload.php';

$cookiePath = 'bin/cookieJar.txt';
$httpParams = [
    'cookies' => new \GuzzleHttp\Cookie\FileCookieJar($cookiePath, true),
    'headers' =>  [
        'User-Agent' => 'amoCRM-API-client/1.0',
        'content-type' => 'application/json',
    ],
];

$httpClient = new \GuzzleHttp\Client($httpParams);
$service = new Service($httpClient);
$app = new Application($service);
$app->run();
