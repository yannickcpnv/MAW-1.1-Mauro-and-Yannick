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
        $takeAnswers = $this->mapAnswers($takeForm['answers']);
        $takeId ? $take->save($takeAnswers) : $take->create($takeAnswers);

        $exercise = Exercise::get($exerciseId);
        $questions = $exercise->getQuestions();

        $answers = [];
        foreach ($questions as $question) {
            $answerFiltered = array_filter($question->getAnswers(), function ($answer) use ($take) {
                return $answer->take_id == $take->id;
            });
            $answers[$question->id] = reset($answerFiltered);
        }

        ViewController::renderPage('take_exercise', [
            'exercise'  => $exercise,
            'questions' => $questions,
            'answers'   => $answers,
            'take'      => $take,
            'mode'      => 'edit',
        ]);
    }

    private function mapAnswers($answers): array
    {
        return array_map(fn($answer): Answer => new Answer(
            [
                'value'       => $answer['value'],
                'question_id' => $answer['questionId'],
            ]
        ), $answers);
    }
}
