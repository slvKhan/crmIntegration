<?php

use \PHPUnit\Framework\TestCase;

class LeadTest extends TestCase
{
    public function testAll()
    {
        $testArray = [
            '_embedded' => [
                'items' => [],
            ],
        ];

        $leads = new App\models\Lead($testArray);
        $this->assertCount(0, $leads->all());
    }

    public function testFilter()
    {
        $testArray = [
            '_embedded' => [
                'items' => ['test','another','test'],
            ],
        ];
        $leads = new App\models\Lead($testArray);
        $this->assertCount(3, $leads->all());
        $leads->filter(function ($lead) { return $lead !== 'test'; });
        $this->assertCount(1, $leads->all());
    }

    public function testMap()
    {
        $testArray = [
            '_embedded' => [
                'items' => [1, 2, 3],
            ],
        ];
        $expected = [2, 4, 6];
        $leads = new App\models\Lead($testArray);
        $leads->map(function ($lead) { return $lead * 2;});
        $this->assertEquals($expected, $leads->all());
    }
}
