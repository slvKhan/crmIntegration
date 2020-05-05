<?php

use App\Service;
use App\models\User;

require_once __DIR__.'/../vendor/autoload.php';

$cookiePath = 'bin/cookieJar.txt';
$messages = [
    'authSucces' => "Вы авторизованы \n",
    'authFaild' => "Логин или пароль не верны! \n",
    'connectFail' => 'Ошибка подключения код: ',
];

$httpParams = [
    'cookies' => new GuzzleHttp\Cookie\FileCookieJar($cookiePath, true),
    'headers' =>  [
        'User-Agent' => 'amoCRM-API-client/1.0',
        'content-type' => 'application/json',
    ],
];
$httpClient = new GuzzleHttp\Client($httpParams);
$app = new Service($httpClient);

try {
    $succes = $app->authorization(new User());
    echo $succes ? $messages['authSucces'] : $messages['authFaild'];
} catch (Exception $e) {
    echo $messages['connectFail'] . $e;
}

$leads = $app->listOf('leads');
dump($leads->getLeadsWithoutTasks());
