<?php

namespace App\models;

class User
{
    private $user;

    public function __construct(array $user)
    {
        $this->user = $user;
    }

    public function toArray(): array
    {
        return [
            'USER_LOGIN' => $this->user['login'],
            'USER_HASH' => $this->user['hash'],
        ];
    }

    public function getSubdomain(): string
    {
        return $this->user['subdomain'];
    }
}
