<?php

namespace Looper\Test\Models\database\entities;

use DateTime;
use PDOException;
use Looper\Models\database\entities\Take;
use Looper\Models\database\entities\Answer;
use Looper\Models\database\entities\Question;

class TakeTest extends AbstractDatabaseEntityTest
{

    public function testGetAll(): void
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

    public function testGet(): void
    {
        /* Given */
        $takeId = 1;
        $expectedTimeStamp = DateTime::createFromFormat('Y-m-d H:i:s', '2021-09-10 11:16:58');

        /* When */
        $take = Take::get($takeId);

        /* Then */
        $this->assertEquals($expectedTimeStamp, $take->timestamp);
    }

    public function testCreate(): void
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
    public function testSave(): void
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

    public function testGetAnswerByQuestionId(): void
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

    public function testGetQuestions(): void
    {
        /* Given */
        $takeId = 1;
        $questionId = 2;
        $take = TAKE::get($takeId);
        $question = Question::get($questionId);
        /* When */
        $resultingQuestion = $take->getQuestions()[0];

        /* Then */
        $this->assertEquals($question, $resultingQuestion);
    }
}
