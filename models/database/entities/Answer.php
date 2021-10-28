<?php

namespace Looper\Models\database\entities;

class Answer extends AbstractEntity
{

    protected const TABLE_NAME = 'answers';

    protected string $value;
    protected int    $take_id;
    protected int    $question_id;

    public function save(): void
    {
        $query = "UPDATE answers SET value=:value WHERE take_id=$this->take_id AND question_id=$this->question_id";
        $queryParams = ['value' => $this->value];
        self::createDatabase()->update($query, $queryParams);
    }
}
