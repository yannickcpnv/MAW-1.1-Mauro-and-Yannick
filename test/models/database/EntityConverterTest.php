<?php

namespace Looper\Test\Models\database;

use PHPUnit\Framework\TestCase;
use Looper\Models\database\EntityConverter;
use Looper\Models\database\entities\Answer;

class EntityConverterTest extends TestCase
{

    public function testAnswersFormToAnswers(): void
    {
        /* Given */
        $answersForm = [
            ['question_id' => 1, 'value' => 'Pulp'],
            ['question_id' => 2, 'value' => 'Fiction'],
        ];
        $expectedAnswers = [
            new Answer(['question_id' => 1, 'value' => 'Pulp']),
            new Answer(['question_id' => 2, 'value' => 'Fiction']),
        ];

        /* When */
        $actualAnswers = EntityConverter::answersFormToAnswers($answersForm);

        /* Then */
        $this->assertEquals($expectedAnswers, $actualAnswers);
    }

    public function testAnswersFormToAnswersWithIds(): void
    {
        /* Given */
        $answersForm = [
            ['id' => 6, 'question_id' => 1, 'value' => 'Pulp'],
            ['id' => 7, 'question_id' => 2, 'value' => 'Fiction'],
        ];
        $expectedAnswers = [
            new Answer(['id' => 6, 'question_id' => 1, 'value' => 'Pulp']),
            new Answer(['id' => 7, 'question_id' => 2, 'value' => 'Fiction']),
        ];

        /* When */
        $actualAnswers = EntityConverter::answersFormToAnswers($answersForm);

        /* Then */
        $this->assertEquals($expectedAnswers, $actualAnswers);
    }
}
