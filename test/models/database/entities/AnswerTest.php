<?php

namespace Looper\Test\Models\database\entities;

use Looper\Models\database\entities\Answer;

class AnswerTest extends AbstractDatabaseEntityTest
{

    public function testGetByTakeId(): void
    {
        /* Given */
        $takeId = 2;
        $expectedAnswers = [
            new Answer(
                [
                    'id'          => 2,
                    'take_id'     => $takeId,
                    'question_id' => 2,
                    'value'       => 'OMG SAME POGGERS',
                ]
            ),
            new Answer(
                [
                    'id'          => 3,
                    'take_id'     => $takeId,
                    'question_id' => 3,
                    'value'       => 'OMGG ANOTHER POGGERS',
                ]
            ),
        ];

        /* When */
        $actualAnswers = Answer::GetByTakeId($takeId);

        /* Then */
        $this->assertEquals($expectedAnswers, $actualAnswers);
    }
}
