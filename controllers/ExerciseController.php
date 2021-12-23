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

    public function openEditExercise(int $exerciseId): void
    {
        $selectedExercise = Exercise::get($exerciseId);
        $selectedQuestions = $selectedExercise->getQuestions();

        $this->render("edit_exercise", compact('selectedExercise', 'selectedQuestions'));
    }

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

    public function completeExercise(int $exerciseId): void
    {
        $selectedExercise = Exercise::get($exerciseId);
        $selectedQuestions = $selectedExercise->getQuestions();

        if (count($selectedQuestions) > 0) {
            $selectedExercise->updateStatus();
            $selectedExercise->save();
            $this->openManageExercise();
        } else {
            $this->render("edit_exercise", compact('selectedExercise', 'selectedQuestions'));
        }
    }

    public function openManageExercise(): void
    {
        $exercisesBuilding = Exercise::getExercisesByStatus(ExerciseStatus::BUILDING);
        $exercisesAnswering = Exercise::getExercisesByStatus(ExerciseStatus::ANSWERING);
        $exercisesClosed = Exercise::getExercisesByStatus(ExerciseStatus::CLOSED);

        $this->render('manage_exercises', compact('exercisesBuilding', 'exercisesAnswering', 'exercisesClosed'));
    }

    public function listExercises(): void
    {
        $exercises = Exercise::getAllAnswering();

        $this->render('list_exercises', compact('exercises'));
    }

    public function removeExercise(int $id): void
    {
        $selectedExercise = Exercise::get($id);
        $selectedExercise->delete();

        $this->openManageExercise();
    }

    public function closeExercise(int $id): void
    {
        $selectedExercise = Exercise::get($id);
        $selectedExercise->updateStatus();
        $selectedExercise->save();

        $this->openManageExercise();
    }

    public function openExerciseResults(int $id): void
    {
        $selectedExercise = Exercise::get($id);
        $questions = $selectedExercise->getQuestions();
        $takes = $selectedExercise->getTakes();

        $this->render('result_exercise', compact('selectedExercise', 'questions', 'takes'));
    }
}

