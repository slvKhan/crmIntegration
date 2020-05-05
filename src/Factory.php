<?php 

namespace App;

class Factory
{
    public static function collectionOf($entity, $args)
    {
        $mapping = [
            'leads' => models\Lead::class,
            'tasks' => models\Task::class
        ];
        $class = $mapping[$entity];
        return new $class($args);
    }
}