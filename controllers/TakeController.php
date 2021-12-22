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

    public function createTake(array $takeForm, int $exerciseId)
    {
        require_once "config/.env";
        $take = new Take();
        $takeAnswers = $this->mapAnswers($takeForm['answers']);
        $take->create($takeAnswers);
        $hostname = $_ENV["HOST_NAME"];
        header("Location: $hostname/exercises/$exerciseId/takes/$take->id/edit");
    }

    private function mapAnswers(array $answers): array
    {
        return array_map(function ($answerForm): Answer {
            $answer = new Answer(['value' => $answerForm['value'], 'question_id' => $answerForm['questionId']]);
            if (isset($answerForm['id'])) {
                $answer->id = $answerForm['id'];
            }
            return $answer;
        }, $answers);
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

    public function openTakeResult(int $takeid, $exerciseid)
    {
        $exercise = Exercise::get($exerciseid);
        $take = Take::get($takeid);
        $questions = $take->getQuestions();
        $answers = [];
        foreach ($questions as $question) {
            $answers[$question->id] = $question->getAnswerByTakeId($take->id);
        }
        ViewController::renderPage('result_take', [
            'exercise'  => $exercise,
            'take'      => $take,
            'questions' => $questions,
            'answers'   => $answers,
        ]);
    }
}
