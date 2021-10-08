<?php

namespace Looper\Models\database\entities;

abstract class QuestionType
{

    public const SINGLE_LINE_TEXT = 0;
    public const SINGLE_LINE_LIST = 1;
    public const MULTI_LINE_TEXT  = 2;

    static function toString(int $value): ?string
    {
        return match ($value) {
            default => "SINGLE_LINE_TEXT",
            QuestionType::SINGLE_LINE_LIST => "SINGLE_LINE_LIST",
            QuestionType::MULTI_LINE_TEXT => "MULTI_LINE_TEXT",
        };
    }
}
