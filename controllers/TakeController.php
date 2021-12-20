<?php

namespace Looper\Controllers;

use Looper\Models\database\entities\Take;
use Looper\Models\database\EntityConverter;
use Looper\Models\database\entities\Exercise;
use Looper\Models\database\entities\EntityNotFoundException;

class TakeController extends ViewController
{

    /**
     * @throws \Looper\Models\database\entities\EntityNotFoundException
     */
    public function openCreateTake(int $exerciseId): void
    {
        $exercise = Exercise::get($exerciseId);
        $questions = $exercise->getQuestions();

        $this->render('take_exercise', [
            "exercise"  => $exercise,
            'questions' => $questions,
        ]);
    }

    public function createTake(array $takeForm, int $exerciseId, string $httpOrigin): void
    {
        $take = new Take();
        $take->create(EntityConverter::answersArrayToAnswers($takeForm['answers']));

        $this->redirect("$httpOrigin?action=edit-take&exercise-id=$exerciseId&take-id=$take->id");
    }

    /**
     * @param array $takeForm
     * @param int   $exerciseId
     * @param int   $takeId
     *
     * @throws EntityNotFoundException
     */
    public function editTake(array $takeForm, int $exerciseId, int $takeId): void
    {
        $take = Take::get($takeId);
        $take->save(EntityConverter::answersArrayToAnswers($takeForm['answers']));

        $this->openEditTake($exerciseId, $take->id);
    }

    /**
     * @throws EntityNotFoundException
     */
    public function openEditTake(int $exerciseId, int $takeId): void
    {
        $take = Take::get($takeId);
        $exercise = Exercise::get($exerciseId);
        $questions = $exercise->getQuestions();

        $this->render('edit_take', [
            'take'      => $take,
            'exercise'  => $exercise,
            'questions' => $questions,
        ]);
    }

    /**
     * @throws \Looper\Models\database\entities\EntityNotFoundException
     */
    public function openTakeResult(int $takeId, int $exerciseId): void
    {
        $exercise = Exercise::get($exerciseId);
        $take = Take::get($takeId);
        $questions = $take->getQuestions();

        $this->render('result_take', [
            'exercise'  => $exercise,
            'take'      => $take,
            'questions' => $questions,
        ]);
    }
}
