<?php

namespace Looper\Models\database\entities;

class Answer extends AbstractEntity
{

    protected const TABLE_NAME = 'answers';

    protected string $value;
    protected int    $take_id;
    protected int    $question_id;
}
