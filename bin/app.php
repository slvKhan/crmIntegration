<?php

namespace App;

require_once __DIR__.'/../vendor/autoload.php';

$cookiePath = 'bin/cookieJar.txt';
$messages = [
    'authSucces' => "Вы авторизованы \n",
    'authFaild' => "Логин или пароль не верны! \n",
    'connectFail' => 'Ошибка подключения код: ',
    'fetchLeads' => "Сделки загружены \n",
    'addTaskSucces' => "Задачи добавленны \n",
    'empty' => "У всех сделок есть задачи \n"
];
$httpParams = [
    'cookies' => new \GuzzleHttp\Cookie\FileCookieJar($cookiePath, true),
    'headers' =>  [
        'User-Agent' => 'amoCRM-API-client/1.0',
        'content-type' => 'application/json',
    ],
];

$httpClient = new \GuzzleHttp\Client($httpParams);
$app = new Service($httpClient);

try {
    $succes = $app->authorization(new models\User());
    echo $succes ? $messages['authSucces'] : $messages['authFaild'];
    $leads = $app->listOf('leads');
    echo $messages['fetchLeads'];
    $emptyLeadsID = models\Lead::listOfId($leads->getLeadsWithoutTasks());

    if (count($emptyLeadsID) === 0) {
        echo $messages['empty'];
        die;
    }

    $tasksList = array_map(function ($lead) {
        return models\Task::TaskForEmptyDeal($lead['element_id'], $lead['responsible_user_id']);
    }, $emptyLeadsID);

    $app->addTasks($tasksList);
    echo $messages['addTaskSucces'];

} catch (Exception $e) {
    echo $messages['connectFail'] . $e;
}
