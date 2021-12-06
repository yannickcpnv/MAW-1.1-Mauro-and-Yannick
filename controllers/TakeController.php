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

    public function createTake(array $takeForm, int $exerciseId, array $server)
    {
        $take = new Take();
        $takeAnswers = $this->mapAnswers($takeForm['answers']);
        $take->create($takeAnswers);

        header("Location: {$server['HTTP_ORIGIN']}?action=edit-take&exercise-id=$exerciseId&take-id=$take->id");
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
        return array_map(function ($answerArray): Answer {
            $answer = new Answer(['value' => $answerArray['value'], 'question_id' => $answerArray['questionId']]);
            if (isset($answerArray['id'])) {
                $answer->id = $answerArray['id'];
            }
            return $answer;
        }, $answers);
    }

    public function openTakeResults(int $takeid, $exerciseid)
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