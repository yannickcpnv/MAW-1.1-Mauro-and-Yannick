<?php

namespace Looper\Models\database\entities;

class Question extends AbstractEntity
{

    protected const TABLE_NAME = 'questions';

    protected string $label;
    protected int    $question_type_id;
    protected int    $exercise_id;
    /* @var Answer[] */
    protected array $answers;

}
