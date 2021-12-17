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
        self::renderPage(
            "edit_exercise",
            ["selectedExercise" => $selectedExercise, "selectedQuestions" => $selectedQuestions]
        );
    }

    public function validateExerciseCreation(array $exerciseForm): void
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

    public function completeExercise(int $exerciseId): void
    {
        $selectedExercise = Exercise::get($exerciseId);
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

    public function listExercises(): void
    {
        $exercises = array_filter(Exercise::getAll(), function ($exercise) {
            return $exercise->exercise_status_id == ExerciseStatus::ANSWERING;
        });
        self::renderPage('list_exercises', ["exercises" => $exercises]);
    }

    public function takeExercise(int $exerciseId): void
    {
        $exercise = Exercise::get($exerciseId);
        $questions = $exercise->getQuestions();
        self::renderPage('take_exercise', [
            "exercise"  => $exercise,
            'questions' => $questions,
            "mode"      => 'create',
        ]);
    }

    public function openManageExercise(): void
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

    public function removeExercise(int $id): void
    {
        $selectedExercise = Exercise::get($id);
        $selectedExercise->delete();
        $this->openManageExercise();
    }

    public function closeExercise(int $id): void
    {
        $selectedExercise = Exercise::get($id);
        $selectedExercise->exercise_status_id = ExerciseStatus::CLOSED;
        $selectedExercise->save();
        $this->openManageExercise();
    }

    public function openExerciseResults(int $id): void
    {
        $selectedExercises = Exercise::get($id);
        $questions = $selectedExercises->getQuestions();
        $takes = $selectedExercises->getTakes();
        $answers = [[]];
        foreach ($questions as $question) {
            foreach ($question->getAnswers() as $answer) {
                if (str_replace(' ', '', $answer->value) == "") {
                    $type = "fa-times empty";
                } elseif (strlen($answer->value) > 9) {
                    $type = "fa-check-double filled";
                } else {
                    $type = "fa-check short";
                }
                $answers[$answer->take_id][$answer->question_id] = $type;
            }
        }
        $this->render(
            'result_exercise',
            [
                "selectedExercises" => $selectedExercises,
                "questions"         => $questions,
                "takes"             => $takes,
                "answers"           => $answers,
            ]
        );
    }
}

