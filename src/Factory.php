<?php

namespace App;

class Factory
{
    public static function collectionOf(string $entity, array $args): object
    {
        $mapping = [
            'leads' => models\Lead::class,
            'tasks' => models\Task::class
        ];
        $class = $mapping[$entity];
        return new $class($args);
    }
}
