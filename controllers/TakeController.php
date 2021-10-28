<?php

namespace Looper\Controllers;

use Looper\Models\database\entities\Take;
use Looper\Models\database\entities\Answer;
use Looper\Models\database\entities\Exercise;

class TakeController extends ViewController
{

    public function saveTake(array $takeForm, int $exerciseId, int $takeId = null)
    {
        $take = $takeId ? Take::get($takeId) : new Take();
        $answers = array_map(function ($answer) {
            return new Answer(['value' => $answer['value'], 'question_id' => $answer['questionId']]);
        }, $takeForm['answers']);
        $takeId ? $take->save($answers) : $take->create($answers);

        $exercise = Exercise::get($exerciseId);
        $exercise->loadQuestions();
        foreach ($exercise->questions as $question) {
            $question->loadAnswers();
            $question->answers = array_values(array_filter($question->answers, fn($a) => $a->take_id == $take->id));
        }

        $values = [
            'exercise' => $exercise,
            'take'     => $take,
            'mode'     => 'edit',
        ];
        ViewController::renderPage('take_exercise', $values);
    }
}
