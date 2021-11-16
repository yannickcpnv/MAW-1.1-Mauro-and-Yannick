<?php

namespace Looper\Controllers;

use Looper\Models\database\entities\Take;
use Looper\Models\database\entities\Answer;
use Looper\Models\database\entities\Exercise;

class TakeController extends ViewController
{

    public function editTake(array $takeForm, int $exerciseId, int $takeId)
    {
        $take = Take::get($takeId);
        $takeAnswers = $this->mapAnswers($takeForm['answers']);
        $take->save($takeAnswers);

        $this->showDetails($exerciseId, $take->id);
    }

    public function createTake(array $takeForm)
    {
        $take = new Take();
        $takeAnswers = $this->mapAnswers($takeForm['answers']);
        $take->create($takeAnswers);

        header('Location: http://localhost:8080?action=edit-take&exercise-id=3&take-id=25');
    }

    public function showDetails(int $exerciseId, int $takeId)
    {
        $exercise = Exercise::get($exerciseId);
        $questions = $exercise->getQuestions();

        $answers = [];
        foreach ($questions as $question) {
            $answerFiltered = array_filter($question->getAnswers(), function ($answer) use ($takeId) {
                return $answer->take_id == $takeId;
            });
            $answers[$question->id] = reset($answerFiltered);
        }

        ViewController::renderPage('take_exercise', [
            'exercise'  => $exercise,
            'questions' => $questions,
            'answers'   => $answers,
            'take'      => Take::get($takeId),
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
