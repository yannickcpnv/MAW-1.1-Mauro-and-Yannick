<?php

namespace Looper\Models\database\entities;

abstract class QuestionType
{

    public const SINGLE_LINE_TEXT = 1;
    public const SINGLE_LINE_LIST = 2;
    public const MULTI_LINE_TEXT  = 3;

    /**
     * Get the string value of the enum integer.
     *
     * @param int $value The integer value of the enum.
     *
     * @return string The string value from the constant associated with the integer.
     */
    public static function toString(int $value): string
    {
        return match ($value) {
            default => "SINGLE_LINE_TEXT",
            QuestionType::SINGLE_LINE_LIST => "SINGLE_LINE_LIST",
            QuestionType::MULTI_LINE_TEXT => "MULTI_LINE_TEXT",
        };
    }
}
