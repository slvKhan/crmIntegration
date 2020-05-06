<?php

use \PHPUnit\Framework\TestCase;

class FactoryTest extends TestCase
{
    public function testCollectoinOf()
    {
        $entity = 'leads';
        $leads = [
            '_embedded' => [
                'items' => [],
            ],
        ];
        $actual = App\Factory::collectionOf($entity, $leads);
        $this->assertTrue($actual instanceof App\models\Lead);
    }
}
