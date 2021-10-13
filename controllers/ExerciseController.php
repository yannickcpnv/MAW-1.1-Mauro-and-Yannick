<?php

namespace Looper\Controllers;

use Looper\Models\database\entities\Exercise;
use Looper\Models\database\entities\ExerciseStatus;

class ExerciseController extends ViewController
{


    public function openCreateExercise()
    {
        self::renderPage('create_exercise');
    }


    public function openEditExercise($id, $newQuestionForm = [])
    {
        $selectedExercise = Exercise::get($id);
        $selectedExercise->loadQuestions();
        self::renderPage('edit_exercise', ["selectedExercise" => $selectedExercise]);
    }

    public function validateExerciseCreation($exerciseForm)
    {
        if ($exerciseForm["title"] != "") {
            $selectedExercise = new Exercise(["title" => $exerciseForm["title"]]);
            $selectedExercise->create();
            self::renderPage('edit_exercise', ["selectedExercise" => $selectedExercise]);
        } else {
            self::renderPage('create_exercise');
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
        $exercise->loadQuestions();
        self::renderPage('take_exercise', ["exercise" => $exercise]);
    }
}

