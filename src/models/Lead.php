<?php

namespace App\models;

class Lead
{
    private $leads;

    public function __construct($leads)
    {
        $this->leads = $leads['_embedded']['items'];
    }

    public function getLeadsWithoutTasks()
    {
        return array_filter($this->leads, function ($lead) {
            return $lead['closest_task_at'] === 0;
        });
    }

    public function toArray()
    {
        return $this->leads;
    }
}