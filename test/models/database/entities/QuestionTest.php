<?php

namespace Looper\Test\Models\database\entities;

use Looper\Test\TestHelper;
use PHPUnit\Framework\TestCase;
use Looper\Models\database\entities\Answer;
use Looper\Models\database\entities\Question;

class QuestionTest extends TestCase
{

    public static function setUpBeforeClass(): void
    {
        TestHelper::createDatabase();
    }

    public final function setUp(): void
    {
        TestHelper::createDatabase();
    }

    public function testGetAnswers()
    {
        /* Given */
        $question = new Question(['id' => 2]);

        /* When */
        $answers = $question->getAnswers();

        /* Then */
        $this->assertContainsOnlyInstancesOf(Answer::class, $answers);
        $this->assertNotNull($answers[0]->value);
    }

    public function testGetAnswerByTakeId()
    {
        /* Given */
        $takeId = 1;
        $questionId = 2;
        $question = Question::get($questionId);
        $answerId = 1;
        $answer = Answer::get($answerId);

        /* When */
        $resultingAnswer = $question->getAnswerByTakeId($takeId);

        /* Then */
        $this->assertEquals($answer, $resultingAnswer);
    }
}
