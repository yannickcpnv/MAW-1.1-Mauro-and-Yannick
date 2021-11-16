<?php

namespace Looper\Controllers;

use Looper\Models\database\entities\Exercise;
use Looper\Models\database\entities\Question;
use Looper\Models\database\entities\ExerciseStatus;

class ExerciseController extends ViewController
{

    public function openCreateExercise()
    {
        $this->render('create_exercise');
    }


    public function openEditExercise($id)
    {
        $selectedExercise = Exercise::get($id);
        $selectedQuestions = $selectedExercise->getQuestions();
        self::renderPage(
            "edit_exercise",
            ["selectedExercise" => $selectedExercise, "selectedQuestions" => $selectedQuestions]
        );
    }

    public function validateExerciseCreation($exerciseForm)
    {
        if ($exerciseForm["title"] != "") {
            $selectedExercise =
                new Exercise(["title" => $exerciseForm["title"], "exercise_status_id" => ExerciseStatus::BUILDING]);
            $selectedExercise->create();
            $selectedQuestions = $selectedExercise->getQuestions();
            self::renderPage(
                "edit_exercise",
                ["selectedExercise" => $selectedExercise, "selectedQuestions" => $selectedQuestions]
            );
        } else {
            $this->render('create_exercise');
        }
    }

    public function completeExercise(int $id)
    {
        $selectedExercise = Exercise::get($id);
        $selectedQuestions = $selectedExercise->getQuestions();
        if (count($selectedQuestions) > 0) {
            $selectedExercise->exercise_status_id = ExerciseStatus::ANSWERING;
            $selectedExercise->save();
            $this->openManageExercise();
        } else {
            self::renderPage("edit_exercise", [
                "selectedExercise"  => $selectedExercise,
                "selectedQuestions" => $selectedQuestions,
            ]);
        }
    }

    public function listExercises()
    {
        $exercises = array_filter(Exercise::getAll(), function ($exercise) {
            return $exercise->exercise_status_id == ExerciseStatus::ANSWERING;
        });
        self::renderPage('list_exercises', ["exercises" => $exercises]);
    }

    public function takeExercise(int $id)
    {
        $exercise = Exercise::get($id);
        $questions = $exercise->getQuestions();
        self::renderPage('take_exercise', [
            "exercise"  => $exercise,
            'questions' => $questions,
            "mode"      => 'create',
        ]);
    }

    public function openManageExercise()
    {
        $exercisesBuilding = Exercise::getExercisesByStatus(ExerciseStatus::BUILDING);
        $exercisesAnswering = Exercise::getExercisesByStatus(ExerciseStatus::ANSWERING);
        $exercisesClosed = Exercise::getExercisesByStatus(ExerciseStatus::CLOSED);
        $nbQuestions = [];
        foreach (array_merge($exercisesAnswering, $exercisesBuilding, $exercisesClosed) as $exercise) {
            $nbQuestions[$exercise->id] = Count($exercise->getQuestions());
        }
        $this->render(
            'manage_exercises',
            [
                "exercisesBuilding"  => $exercisesBuilding,
                "exercisesAnswering" => $exercisesAnswering,
                "exercisesClosed"    => $exercisesClosed,
                "nbQuestions"        => $nbQuestions,
            ]
        );
    }

    public function removeExercise(int $id)
    {
        $selectedExercise = Exercise::get($id);
        $selectedExercise->delete();
        $this->openManageExercise();
    }

    public function closeExercise(int $id)
    {
        $selectedExercise = Exercise::get($id);
        $selectedExercise->exercise_status_id = ExerciseStatus::CLOSED;
        $selectedExercise->save();
        $this->openManageExercise();
    }
}

