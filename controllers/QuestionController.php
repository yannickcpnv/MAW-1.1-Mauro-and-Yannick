<?php

namespace Looper\Controllers;

use Looper\Models\database\entities\Question;
use Looper\Models\database\entities\Exercise;

class QuestionController extends ViewController
{

    public function openEditQuestion($id)
    {
        $selectedQuestion = Question::get($id);
        $selectedExercise = Exercise::get($selectedQuestion->exercise_id);
        self::renderPage(
            "edit_question",
            ["selectedQuestion" => $selectedQuestion, "selectedExercise" => $selectedExercise]
        );
    }

    public function editQuestion($id, $questionForm = [])
    {
        $selectedQuestion = Question::get($id);
        $selectedQuestion->label = $questionForm["field_label"];
        $selectedQuestion->question_type_id = $questionForm["field_value_kind"];
        $selectedQuestion->save();
        $selectedExercise = Exercise::get($selectedQuestion->exercise_id);
        $selectedQuestions = $selectedExercise->getQuestions();
        self::renderPage(
            "edit_exercise",
            ["selectedExercise" => $selectedExercise, "selectedQuestions" => $selectedQuestions]
        );
    }

    public function createQuestion(int $exerciseid, $form)
    {
        $selectedExercise = Exercise::get($exerciseid);
        $selectedQuestion = new Question(["label" => $form["field_label"]]);
        $selectedQuestion->question_type_id = $form["field_value_kind"];
        $selectedQuestion->exercise_id = $exerciseid;
        $selectedQuestion->create();
        $selectedQuestions = $selectedExercise->getQuestions();
        self::renderPage(
            "edit_exercise",
            ["selectedExercise" => $selectedExercise, "selectedQuestions" => $selectedQuestions]
        );
    }

    public function removeQuestion(int $id)
    {
        $selectedQuestion = Question::get($id);
        $selectedExercise = Exercise::get($selectedQuestion->exercise_id);
        $selectedQuestion->delete();
        $selectedQuestions = $selectedExercise->getQuestions();
        self::renderPage(
            "edit_exercise",
            ["selectedExercise" => $selectedExercise, "selectedQuestions" => $selectedQuestions]
        );
    }
}
