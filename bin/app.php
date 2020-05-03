<?php

use App\Service;

require_once __DIR__.'/../vendor/autoload.php';
$messages = [
    'authSucces' => "Вы авторизованы \n",
    'authFaild' => "Логин или пароль не верны! \n",
    'connectFail' => 'Ошибка подключения код: ',
];
$user = ['slayerhan1997', 'slayer.han1997@gmail.com', '0ff60cca81234b0532ed48e5f7597c6d00eb1628'];
$cookiePath = 'bin/cookieJar.txt';
$headers =  [
    'User-Agent' => 'amoCRM-API-client/1.0',
    'content-type' => 'application/json',
];

$cookieJar = new GuzzleHttp\Cookie\FileCookieJar($cookiePath, true);
$app = new Service(new GuzzleHttp\Client(['cookies' => $cookieJar, 'headers' => $headers]));

try {
    $succes = $app->authorization(...$user);
    echo $succes ? $messages['authSucces'] : $messages['authFaild'];
} catch (Exception $e) {
    echo $messages['connectFail'].$e;
}
