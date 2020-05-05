<?php

namespace App\models;

class Task
{
    private $tasks;

    public function __construct($tasks)
    {
        $this->tasks = $tasks['_embedded']['items'];
    }

    public function toArray()
    {
        return $this->tasks;
    }

    public static function TaskForEmptyDeal($taskID, $responsibleUserId)
    {
        $tomorrow = time() + (24 * 60 * 60);
        return [
            'element_id' => $taskID,
            'element_type' => 2,
            'task_type' => 1,
            'text' => 'Сделка без задачи',
            'responsible_user_id' => $responsibleUserId,
            'complete_till_at' => $tomorrow
        ];
    }
}