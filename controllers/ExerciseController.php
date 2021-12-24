<?php

namespace Looper\Controllers;

use Looper\Models\database\entities\Exercise;
use Looper\Models\database\entities\ExerciseStatus;

class ExerciseController extends ViewController
{

    /**
     * Render the page to create an exercise.
     */
    public function openCreateExercise(): void
    {
        $this->render('create_exercise');
    }

    /**
     * Render the page to edit an exercise
     *
     * @param int $exerciseId
     */
    public function openEditExercise(int $exerciseId): void
    {
        $selectedExercise = Exercise::get($exerciseId);
        $selectedQuestions = $selectedExercise->getQuestions();

        $this->render("edit_exercise", compact('selectedExercise', 'selectedQuestions'));
    }


    /**
     * Render the page to list exercises.
     */
    public function openListExercises(): void
    {
        $exercises = Exercise::getAllAnswering();

        $this->render('list_exercises', compact('exercises'));
    }

    /**
     * Render the page to manage exercises.
     */
    public function openManageExercises(): void
    {
        $exercisesBuilding = Exercise::getExercisesByStatus(ExerciseStatus::BUILDING);
        $exercisesAnswering = Exercise::getExercisesByStatus(ExerciseStatus::ANSWERING);
        $exercisesClosed = Exercise::getExercisesByStatus(ExerciseStatus::CLOSED);

        $this->render('manage_exercises', compact('exercisesBuilding', 'exercisesAnswering', 'exercisesClosed'));
    }

    /**
     * Render the page of an exercise results.
     *
     * @param int $exerciseId
     */
    public function openExerciseResults(int $exerciseId): void
    {
        $selectedExercise = Exercise::get($exerciseId);
        $questions = $selectedExercise->getQuestions();
        $takes = $selectedExercise->getTakes();

        $this->render('result_exercise', compact('selectedExercise', 'questions', 'takes'));
    }

    /**
     * Create a new exercise from a web form after validation and render the page to edit an exercise on success or the
     * one to create on failure.
     *
     * @param array $exerciseForm - Array of exercise values from a web form.
     */
    public function validateExerciseCreation(array $exerciseForm): void
    {
        if ($exerciseForm["title"] !== "") {
            $selectedExercise = new Exercise(["title" => $exerciseForm["title"]]);
            $selectedExercise->create();
            $selectedQuestions = $selectedExercise->getQuestions();

            $this->render("edit_exercise", compact('selectedExercise', 'selectedQuestions'));
        } else {
            $this->render('create_exercise');
        }
    }

    /**
     * Delete an exercise from the database and render the page to manage exercises.
     *
     * @param int $exerciseId
     */
    public function removeExercise(int $exerciseId): void
    {
        $selectedExercise = Exercise::get($exerciseId);
        $selectedExercise->delete();

        $this->openManageExercises();
    }

    /**
     * Complete an exercise to be ready for answers and render the manage exercises page if there are questions selected
     * or the edit exercise page if there are not.
     *
     * @param int $exerciseId
     */
    public function completeExercise(int $exerciseId): void
    {
        $selectedExercise = Exercise::get($exerciseId);
        $selectedQuestions = $selectedExercise->getQuestions();

        if (count($selectedQuestions) > 0) {
            $selectedExercise->updateStatus();
            $selectedExercise->save();
            $this->openManageExercises();
        } else {
            $this->render("edit_exercise", compact('selectedExercise', 'selectedQuestions'));
        }
    }

    /**
     * Close and exercise and render the page to manage exercises.
     *
     * @param int $exerciseId
     */
    public function closeExercise(int $exerciseId): void
    {
        $selectedExercise = Exercise::get($exerciseId);
        $selectedExercise->updateStatus();
        $selectedExercise->save();

        $this->openManageExercises();
    }
}
