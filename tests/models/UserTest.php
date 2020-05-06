<?php

use \PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private $userData = [
        'subdomain' => 'superAdmin',
        'login' => 'admin@gmail.com',
        'hash' => '123hash'
    ];
    private $user;

    public function setUp(): void
    {
        $this->user = new App\models\User($this->userData);
    }
    
    public function testToArray()
    {
        $expect = [
            'USER_LOGIN' => $this->userData['login'],
            'USER_HASH' => $this->userData['hash'],
        ];
        $actual = $this->user->toArray();
        $this->assertEquals($expect, $actual);
    }

    public function testGetSubdomain()
    {
        $expect = 'superAdmin';
        $actual = $this->user->getSubdomain();
        $this->assertEquals($expect, $actual);
    }
}
