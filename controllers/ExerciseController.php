<?php

namespace Looper\Controllers;

use Looper\Models\database\entities\Exercise;
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
            $selectedExercise = new Exercise(["title" => $exerciseForm["title"]]);
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

    public function completeExercise($id)
    {
        $selectedExercise = Exercise::get($id);
        $selectedQuestions = $selectedExercise->getQuestions();
        if (count($selectedQuestions) > 0) {
            $selectedExercise->exercise_status_id = 1;
            $selectedExercise->save();
            $this->render('manage_exercises');
        } else {
            self::renderPage(
                "edit_exercise",
                ["selectedExercise" => $selectedExercise, "selectedQuestions" => $selectedQuestions]
            );
        }
    }
}