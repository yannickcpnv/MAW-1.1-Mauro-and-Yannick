<?php

namespace Looper\Models\database;

use Looper\Models\database\entities\Answer;

class EntityConverter
{

    /**
     * Map an array of answer (ex : $array['index']['value']) to an array of {@link Answer}.
     *
     * @param array[] $answersForm The answers from the form.
     *
     * @return Answer[]
     */
    public static function answersFormToAnswers(array $answersForm): array
    {
        return array_map(static function ($answerForm): Answer {
            return new Answer($answerForm);
        }, $answersForm);
    }
}
