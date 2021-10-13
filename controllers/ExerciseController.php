<?php

namespace Looper\Controllers;

use Looper\Models\database\entities\Exercise;

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
}