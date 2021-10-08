<?php

namespace Looper\Models\database\entities;

class Question extends AbstractEntity
{

    protected const TABLE_NAME = 'questions';

    protected string   $label;
    protected int      $questionType;
    protected Exercise $exercise;
    protected array    $answers;
}
