<?php

namespace Looper\Models;
class Question
{
    private int $id;
    private string $label;
    private int $questionType;
    private Exercise $exercise;
    private array $answers;

    public function __construct(int $id)
    {
        //TODO
    }
}