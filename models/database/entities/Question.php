<?php

namespace Looper\Models\database\entities;

class Question extends AbstractEntity
{

    protected const TABLE_NAME = 'questions';

    private string   $label;
    private int      $questionType;
    private Exercise $exercise;
    private array    $answers;
}
