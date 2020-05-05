<?php

namespace App\models;

class User
{
    private $user = [
        'subdomain' => 'slayerhan1997',
        'login' => 'slayer.han1997@gmail.com',
        'hash' => '0ff60cca81234b0532ed48e5f7597c6d00eb1628'
    ];

    public function toArray()
    {
        return [
            'USER_LOGIN' => $this->user['login'],
            'USER_HASH' => $this->user['hash'],
        ];
    }

    public function getSubdomain()
    {
        return $this->user['subdomain'];
    }
}