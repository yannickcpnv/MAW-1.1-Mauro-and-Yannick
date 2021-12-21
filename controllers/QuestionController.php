<?php

namespace Looper\Controllers;

use Looper\Models\database\entities\Question;
use Looper\Models\database\entities\Exercise;

class QuestionController extends ViewController
{

    public function openEditQuestion($questionId): void
    {
        $selectedQuestion = Question::get($questionId);
        $selectedExercise = Exercise::get($selectedQuestion->exercise_id);

        $this->render("edit_question", compact('selectedQuestion', 'selectedExercise'));
    }

    public function editQuestion($id, $questionForm = []): void
    {
        $selectedQuestion = Question::get($id);
        $selectedQuestion->label = $questionForm["field_label"];
        $selectedQuestion->question_type_id = $questionForm["field_value_kind"];
        $selectedQuestion->save();

        $selectedExercise = Exercise::get($selectedQuestion->exercise_id);
        $selectedQuestions = $selectedExercise->getQuestions();

        $this->render("edit_exercise", compact('selectedExercise', 'selectedQuestions'));
    }

    public function createQuestion(int $exerciseId, $form): void
    {
        $selectedExercise = Exercise::get($exerciseId);
        $selectedQuestion = new Question(
            [
                "label"            => $form["field_label"],
                'question_type_id' => $form["field_value_kind"],
                'exercise_id'      => $exerciseId,
            ]
        );
        $selectedQuestion->create();
        $selectedQuestions = $selectedExercise->getQuestions();

        $this->render("edit_exercise", compact('selectedExercise', 'selectedQuestions'));
    }

    public function removeQuestion(int $id): void
    {
        $selectedQuestion = Question::get($id);
        $selectedExercise = Exercise::get($selectedQuestion->exercise_id);

        $selectedQuestion->delete();

        $selectedQuestions = $selectedExercise->getQuestions();

        $this->render("edit_exercise", compact('selectedExercise', 'selectedQuestions'));
    }

    public function openQuestionResult(int $id): void
    {
        $selectedQuestion = Question::get($id);
        $selectedExercise = Exercise::get($selectedQuestion->exercise_id);
        $takes = $selectedExercise->getTakes();

        $this->render('result_question', compact('selectedQuestion', 'selectedExercise', 'takes'));
    }
}
