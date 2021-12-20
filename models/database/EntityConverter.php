<?php

namespace Looper\Models\database;

use Looper\Models\database\entities\Answer;

class EntityConverter
{

    /**
     * Map an array of answer (ex : $array['index']['value']) to an array of {@link Answer}.
     *
     * @param array[] $answersArray The answers from the form.
     *
     * @return Answer[]
     */
    public static function answersArrayToAnswers(array $answersArray): array
    {
        return array_map(static function ($formAnswer): Answer {
            $answer = new Answer(['value' => $formAnswer['value'], 'question_id' => $formAnswer['questionId']]);
            if (isset($formAnswer['id'])) {
                $answer->id = $formAnswer['id'];
            }
            return $answer;
        }, $answersArray);
    }
}
