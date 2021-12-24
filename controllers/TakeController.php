<?php

namespace Looper\Controllers;

use Looper\Models\database\entities\Take;
use Looper\Models\database\EntityConverter;
use Looper\Models\database\entities\Exercise;

class TakeController extends ViewController
{

    /**
     * Render the page to create a take.
     *
     * @param int $exerciseId
     */
    public function openCreateTake(int $exerciseId): void
    {
        $exercise = Exercise::get($exerciseId);
        $questions = $exercise->getQuestions();

        $this->render('take_exercise', compact('exercise', 'questions'));
    }

    /**
     * Render the page to edit a take.
     *
     * @param int $exerciseId
     * @param int $takeId
     */
    public function openEditTake(int $exerciseId, int $takeId): void
    {
        $take = Take::get($takeId);
        $exercise = Exercise::get($exerciseId);
        $questions = $exercise->getQuestions();

        $this->render('edit_take', compact('take', 'exercise', 'questions'));
    }

    /**
     * Render the page of a take results.
     *
     * @param int $takeId
     * @param int $exerciseId
     */
    public function openTakeResult(int $takeId, int $exerciseId): void
    {
        $exercise = Exercise::get($exerciseId);
        $take = Take::get($takeId);
        $questions = $take->getQuestions();

        $this->render('result_take', compact('exercise', 'take', 'questions'));
    }

    /**
     * Create a new take from a web form and redirect to the page to edit a take.
     *
     * @param int   $exerciseId
     * @param array $takeForm Array of take values from a web form.
     */
    public function createTake(int $exerciseId, array $takeForm): void
    {
        $take = new Take();
        $take->create(EntityConverter::answersFormToAnswers($takeForm['answers']));

        $this->redirect("${$_ENV["HOST_NAME"]}/exercises/$exerciseId/takes/$take->id/edit");
    }

    /**
     * Update a take from a web form and render the page to edit a take.
     *
     * @param int   $exerciseId
     * @param int   $takeId
     * @param array $takeForm Array of take value from a web form.
     */
    public function editTake(int $exerciseId, int $takeId, array $takeForm): void
    {
        $take = Take::get($takeId);
        $take->save(EntityConverter::answersFormToAnswers($takeForm['answers']));

        $this->openEditTake($exerciseId, $take->id);
    }
}
