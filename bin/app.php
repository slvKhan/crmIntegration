<?php 

use App\Client;

require_once __DIR__.'/../vendor/autoload.php';

$user = ['slayerhan1997', 'slayer.han1997@gmail.com', '0ff60cca81234b0532ed48e5f7597c6d00eb1628'];
$cookiePath = 'bin/cookieJar.txt';
$headers =  [
    'User-Agent' => 'amoCRM-API-client/1.0',
    'content-type' => 'application/json',
];

$cookieJar =  new GuzzleHttp\Cookie\FileCookieJar($cookiePath, TRUE);
$app = new Client(new GuzzleHttp\Client(['cookies' => $cookieJar, 'headers' => $headers]));

try {
    $app->authorization(...$user);
    echo 'Авторизация прошла успешно';
} catch (Exception $e) {
    echo 'Авторизация провалилась!';
}


