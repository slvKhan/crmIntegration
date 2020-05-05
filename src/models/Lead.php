<?php

namespace App\models;

class Lead
{
    private $leads;

    public function __construct($leads)
    {
        $this->leads = $leads['_embedded']['items'];
    }

    public function toArray()
    {
        return $this->leads;
    }

    public function getLeadsWithoutTasks()
    {
        return array_filter($this->leads, function ($lead) {
            return $lead['closest_task_at'] === 0;
        });
    }

    public static function listOfId($leads)
    {
        return array_map(function ($lead) {
            return [
                'element_id' => $lead['id'],
                'responsible_user_id' => $lead['responsible_user_id']
            ];
        }, $leads);
    }
}