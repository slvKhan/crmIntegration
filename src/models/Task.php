<?php

namespace App\models;

class Task
{
    private $tasks;

    public function __construct(array $tasks)
    {
        $this->tasks = $tasks['_embedded']['items'];
    }

    public function all()
    {
        return $this->tasks;
    }

    public static function taskForEmptyLead(array $lead): array
    {
        $tomorrow = time() + (24 * 60 * 60);
        return [
            'element_id' => $lead['element_id'],
            'element_type' => 2,
            'task_type' => 1,
            'text' => 'Сделка без задачи',
            'responsible_user_id' => $lead['responsible_user_id'],
            'complete_till_at' => $tomorrow
        ];
    }
}
