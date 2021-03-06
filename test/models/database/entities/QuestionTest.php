<?php

namespace Looper\Test\Models\database\entities;

use Looper\Models\database\entities\Answer;
use Looper\Models\database\entities\Question;

class QuestionTest extends AbstractDatabaseEntityTest
{

    public function testGetAnswers(): void
    {
        /* Given */
        $question = new Question(['id' => 2]);

        /* When */
        $answers = $question->getAnswers();

        /* Then */
        $this->assertContainsOnlyInstancesOf(Answer::class, $answers);
        $this->assertNotNull($answers[0]->value);
    }

    public function testGetAnswerByTakeId(): void
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
