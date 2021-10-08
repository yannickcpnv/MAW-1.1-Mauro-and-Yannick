<?php

namespace Looper\Models\database\entities;

class Answer extends AbstractEntity
{

    protected const TABLE_NAME = 'answers';

    protected string   $value;
    protected Take     $take;
    protected Question $question;
}
