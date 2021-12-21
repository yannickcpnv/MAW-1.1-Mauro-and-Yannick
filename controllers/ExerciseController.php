<?php

namespace Looper\Controllers;

use Looper\Models\database\entities\Exercise;
use Looper\Models\database\entities\ExerciseStatus;

class ExerciseController extends ViewController
{

    public function openCreateExercise(): void
    {
        $this->render('create_exercise');
    }

    /**
     * @throws \Looper\Models\database\entities\EntityNotFoundException
     */
    public function openEditExercise(int $exerciseId): void
    {
        $selectedExercise = Exercise::get($exerciseId);
        $selectedQuestions = $selectedExercise->getQuestions();

        $this->render(
            "edit_exercise",
            ["selectedExercise" => $selectedExercise, "selectedQuestions" => $selectedQuestions]
        );
    }

    public function validateExerciseCreation(array $exerciseForm): void
    {
        if ($exerciseForm["title"] !== "") {
            $selectedExercise = new Exercise(["title" => $exerciseForm["title"]]);
            $selectedExercise->create();
            $selectedQuestions = $selectedExercise->getQuestions();

            $this->render(
                "edit_exercise",
                ["selectedExercise" => $selectedExercise, "selectedQuestions" => $selectedQuestions]
            );
        } else {
            $this->render('create_exercise');
        }
    }

    /**
     * @throws \Looper\Models\database\entities\EntityNotFoundException
     */
    public function completeExercise(int $exerciseId): void
    {
        $selectedExercise = Exercise::get($exerciseId);
        $selectedQuestions = $selectedExercise->getQuestions();

        if (count($selectedQuestions) > 0) {
            $selectedExercise->updateStatus();
            $selectedExercise->save();
            $this->openManageExercise();
        } else {
            $this->render("edit_exercise", [
                "selectedExercise"  => $selectedExercise,
                "selectedQuestions" => $selectedQuestions,
            ]);
        }
    }

    public function openManageExercise(): void
    {
        $exercisesBuilding = Exercise::getExercisesByStatus(ExerciseStatus::BUILDING);
        $exercisesAnswering = Exercise::getExercisesByStatus(ExerciseStatus::ANSWERING);
        $exercisesClosed = Exercise::getExercisesByStatus(ExerciseStatus::CLOSED);

        $this->render(
            'manage_exercises',
            [
                "exercisesBuilding" => $exercisesBuilding,
                "exercisesAnswering" => $exercisesAnswering,
                "exercisesClosed" => $exercisesClosed,
            ]
        );
    }

    public function listExercises(): void
    {
        $exercises = Exercise::getAllAnswering();

        $this->render('list_exercises', ["exercises" => $exercises]);
    }

    /**
     * @throws \Looper\Models\database\entities\EntityNotFoundException
     */
    public function removeExercise(int $id): void
    {
        $selectedExercise = Exercise::get($id);
        $selectedExercise->delete();

        $this->openManageExercise();
    }

    /**
     * @throws \Looper\Models\database\entities\EntityNotFoundException
     */
    public function closeExercise(int $id): void
    {
        $selectedExercise = Exercise::get($id);
        $selectedExercise->updateStatus();
        $selectedExercise->save();

        $this->openManageExercise();
    }

    /**
     * @throws \Looper\Models\database\entities\EntityNotFoundException
     */
    public function openExerciseResults(int $id): void
    {
        $selectedExercise = Exercise::get($id);
        $questions = $selectedExercise->getQuestions();
        $takes = $selectedExercise->getTakes();

        $this->render(
            'result_exercise',
            [
                "selectedExercise" => $selectedExercise,
                "questions"        => $questions,
                "takes"            => $takes,
            ]
        );
    }
}

