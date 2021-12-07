<?php

namespace Looper\Test\Models\database\entities;

use DateTime;
use PDOException;
use Looper\Test\TestHelper;
use PHPUnit\Framework\TestCase;
use Looper\Models\database\entities\Take;
use Looper\Models\database\entities\Answer;

class TakeTest extends TestCase
{

    public static function setUpBeforeClass(): void
    {
        TestHelper::createDatabase();
    }

    public final function setUp(): void
    {
        TestHelper::createDatabase();
    }

    public function testGetAll()
    {
        /* Given */
        $expectedTakeQuantity = 2;
        $expectedTimeStamp = DateTime::createFromFormat('Y-m-d H:i:s', '2021-09-10 11:16:58');

        /* When */
        $takes = Take::getAll();

        /* Then */
        $this->assertCount($expectedTakeQuantity, $takes);
        $this->assertEquals($expectedTimeStamp, $takes[0]->timestamp);
    }

    public function testGet()
    {
        /* Given */
        $takeId = 1;
        $expectedClass = Take::class;
        $expectedTimeStamp = DateTime::createFromFormat('Y-m-d H:i:s', '2021-09-10 11:16:58');

        /* When */
        $take = Take::get($takeId);

        /* Then */
        $this->assertInstanceOf($expectedClass, $take);
        $this->assertEquals($expectedTimeStamp, $take->timestamp);
    }

    public function testCreate()
    {
        /* Given */
        $take = new Take();
        $answers = [new Answer(['value' => 'I am the question', 'question_id' => 1]),];

        /* When */
        $take->create($answers);

        /* Then */
        try {
            $take->create();
        } catch (PDOException $e) {
            $this->assertEquals(1062, $e->errorInfo[1]);
        }
    }

    /**
     * @depends testGet
     */
    public function testSave()
    {
        /* Given */
        $takeId = 2;
        $take = Take::get($takeId);

        $answerId = 2;
        $expectedValue = 'I am the question';
        $answers = [new Answer(['id' => $answerId, 'value' => $expectedValue, 'question_id' => 1])];

        /* When */
        $take->save($answers);

        /* Then */
        $this->assertEquals($take->timestamp, Take::get($takeId)->timestamp);
        $this->assertEquals($expectedValue, Answer::get($answerId)->value);
    }

    public function testGetAnswerByQuestionId()
    {
        /* Given */
        $takeId = 1;
        $take = Take::get($takeId);

        $answerId = 1;
        $expectedAnswer = Answer::get($answerId);

        $questionId = 2;
        $expectedAnswerValue = 'I\'m here POG';

        /* When */
        $actualAnswer = $take->getAnswerByQuestionId($questionId);

        /* Then */
        $this->assertEquals($expectedAnswer, $actualAnswer);
        $this->assertEquals($expectedAnswerValue, $actualAnswer->value);
    }
}
