<?php 

use \PHPUnit\Framework\TestCase;

class TaskTest extends TestCase
{
    public function testAll()
    {
        $testArray = [
            '_embedded' => [
                'items' => [],
            ],
        ];
        $testArray1 = [
            '_embedded' => [
                'items' => [1,2,3],
            ],
        ];

        $leads = new App\models\Task($testArray);
        $leads1 = new App\models\Task($testArray1);
        $this->assertCount(0, $leads->all());
        $this->assertCount(3, $leads1->all());
    }

    public function testTaskForEmptyLead()
    {
        $lead = [
            'element_id' => 42,
            'responsible_user_id' => 36,
        ];
        $time = time();
        $tomorrow = $time + (24 * 60 * 60);
        $expect = [
            'element_id' => $lead['element_id'],
            'element_type' => 2,
            'task_type' => 1,
            'text' => 'Сделка без задачи',
            'responsible_user_id' => $lead['responsible_user_id'],
            'complete_till_at' => $tomorrow
        ];

        $actual = App\models\Task::taskForEmptyLead($lead, $time);
        $this->assertEquals($expect, $actual);
    }
}
