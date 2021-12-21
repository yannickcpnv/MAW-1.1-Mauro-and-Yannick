<?php

namespace Looper\Controllers;

use Looper\Models\database\entities\Take;
use Looper\Models\database\EntityConverter;
use Looper\Models\database\entities\Exercise;

class TakeController extends ViewController
{

    public function openCreateTake(int $exerciseId): void
    {
        $exercise = Exercise::get($exerciseId);
        $questions = $exercise->getQuestions();

        $this->render('take_exercise', compact('exercise', 'questions'));
    }

    public function createTake(array $takeForm, int $exerciseId, string $httpOrigin): void
    {
        $take = new Take();
        $take->create(EntityConverter::answersFormToAnswers($takeForm['answers']));

        $this->redirect("$httpOrigin?action=edit-take&exercise-id=$exerciseId&take-id=$take->id");
    }

    /**
     * @param array $takeForm
     * @param int   $exerciseId
     * @param int   $takeId
     */
    public function editTake(array $takeForm, int $exerciseId, int $takeId): void
    {
        $take = Take::get($takeId);
        $take->save(EntityConverter::answersFormToAnswers($takeForm['answers']));

        $this->openEditTake($exerciseId, $take->id);
    }

    public function openEditTake(int $exerciseId, int $takeId): void
    {
        $take = Take::get($takeId);
        $exercise = Exercise::get($exerciseId);
        $questions = $exercise->getQuestions();

        $this->render('edit_take', compact('take', 'exercise', 'questions'));
    }

    public function openTakeResult(int $takeId, int $exerciseId): void
    {
        $exercise = Exercise::get($exerciseId);
        $take = Take::get($takeId);
        $questions = $take->getQuestions();

        $this->render('result_take', compact('exercise', 'take', 'questions'));
    }
}
