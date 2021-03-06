<?php

namespace App;

class Application
{
    private $service;
    private $messages = [
        'authSucces' => "Вы авторизованы \n",
        'authFaild' => "Логин или пароль не верны! \n",
        'connectFail' => 'Ошибка подключения код: ',
        'fetchLeads' => "Сделки загружены \n",
        'addTaskSucces' => "Задачи добавленны \n",
        'empty' => "У всех сделок есть задачи \n"
    ];
    private $filePath = __DIR__.'/../bin/userData.json';

    public function __construct(object $service)
    {
        $this->service = $service;
    }

    public function run(): void
    {
        $userData = $this->getUser();

        try {
            $succes = $this->service->authorization(new models\User($userData));
            echo $succes ? $this->messages['authSucces'] : $this->messages['authFaild'];
            $leads = $this->service->listOf('leads');
            echo $this->messages['fetchLeads'];
            $tasksList = $this->getTasksOfEmptyLeads($leads);
            $this->service->addTasks($tasksList);
            echo $this->messages['addTaskSucces'];
        } catch (Exception $e) {
            echo $this->messages['connectFail'] . $e;
        }
    }

    private function getTasksOfEmptyLeads(models\Lead $leads): array
    {
        $emptyLeadsID = $leads
        ->filter(function ($lead) {
            return $lead['closest_task_at'] === 0;
        })
        ->map(function ($lead) {
            return [
                'element_id' => $lead['id'],
                'responsible_user_id' => $lead['responsible_user_id']
            ];
        })
        ->all();

        if (count($emptyLeadsID) === 0) {
            echo $this->messages['empty'];
            die;
        }

        return array_map(function ($lead) {
            return models\Task::taskForEmptyDeal($lead, time());
        }, $emptyLeadsID);
    }

    private function getUser(): array
    {
        $raw = file_get_contents($this->filePath);
        return json_decode($raw, true);
    }
}
