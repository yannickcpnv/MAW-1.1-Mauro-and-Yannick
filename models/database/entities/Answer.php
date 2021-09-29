<?php

namespace Looper\Models\database\entities;

class Answer extends AbstractEntity
{

    protected const TABLE_NAME = 'answers';

    private string   $value;
    private Take     $take;
    private Question $question;
}
