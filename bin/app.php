<?php 

use App\Client;

require_once __DIR__.'/../vendor/autoload.php';

$user = ['slayerhan1997', 'slayer.han1997@gmail.com', '0ff60cca81234b0532ed48e5f7597c6d00eb1628'];

$app = new Client(new Guzzle());

try {
    $app->authorization(...$user);
    echo 'Авторизация прошла успешно';
} catch($e) {
    'Авторизация провалилась!';
    printf($e);
}

