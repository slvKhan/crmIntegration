<?php

namespace App;

require_once __DIR__.'/../vendor/autoload.php';

$cookiePath = 'bin/cookieJar.txt';
$userData = [
    'subdomain' => 'slayerhan1997',
    'login' => 'slayer.han1997@gmail.com',
    'hash' => '0ff60cca81234b0532ed48e5f7597c6d00eb1628'
];
$httpParams = [
    'cookies' => new \GuzzleHttp\Cookie\FileCookieJar($cookiePath, true),
    'headers' =>  [
        'User-Agent' => 'amoCRM-API-client/1.0',
        'content-type' => 'application/json',
    ],
];

$httpClient = new \GuzzleHttp\Client($httpParams);
$service = new Service($httpClient);
$app = new Application($service, $userData);
$app->run();