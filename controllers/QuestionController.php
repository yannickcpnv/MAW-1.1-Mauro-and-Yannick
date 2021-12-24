<?php

namespace Looper\Controllers;

use Looper\Models\database\entities\Question;
use Looper\Models\database\entities\Exercise;

class QuestionController extends ViewController
{

    /**
     * Render the page to edit a question.
     *
     * @param int $questionId
     */
    public function openEditQuestion(int $questionId): void
    {
        $selectedQuestion = Question::get($questionId);
        $selectedExercise = Exercise::get($selectedQuestion->exercise_id);

        $this->render("edit_question", compact('selectedQuestion', 'selectedExercise'));
    }

    /**
     * Render the page of a question results.
     *
     * @param int $exerciseId
     */
    public function openQuestionResult(int $exerciseId): void
    {
        $selectedQuestion = Question::get($exerciseId);
        $selectedExercise = Exercise::get($selectedQuestion->exercise_id);
        $takes = $selectedExercise->getTakes();

        $this->render('result_question', compact('selectedQuestion', 'selectedExercise', 'takes'));
    }

    /**
     * Create a new question from a web form and render the page to edit an exercise.
     *
     * @param int   $exerciseId
     * @param array $questionForm Array of question values from a web form.
     */
    public function createQuestion(int $exerciseId, array $questionForm): void
    {
        $selectedExercise = Exercise::get($exerciseId);
        $selectedQuestion = new Question(
            [
                "label"            => $questionForm["field_label"],
                'question_type_id' => $questionForm["field_value_kind"],
                'exercise_id'      => $exerciseId,
            ]
        );
        $selectedQuestion->create();
        $selectedQuestions = $selectedExercise->getQuestions();

        $this->render("edit_exercise", compact('selectedExercise', 'selectedQuestions'));
    }

    /**
     * Update a question from a web form and render the page to edit an exercise.
     *
     * @param int   $exerciseId
     * @param array $questionForm Array of question values from a web form.
     */
    public function editQuestion(int $exerciseId, array $questionForm = []): void
    {
        $selectedQuestion = Question::get($exerciseId);
        $selectedQuestion->label = $questionForm["field_label"];
        $selectedQuestion->question_type_id = $questionForm["field_value_kind"];
        $selectedQuestion->save();

        $selectedExercise = Exercise::get($selectedQuestion->exercise_id);
        $selectedQuestions = $selectedExercise->getQuestions();

        $this->render("edit_exercise", compact('selectedExercise', 'selectedQuestions'));
    }

    /**
     * Delete a question and render the page to edit an exercise.
     *
     * @param int $exerciseId
     */
    public function removeQuestion(int $exerciseId): void
    {
        $selectedQuestion = Question::get($exerciseId);
        $selectedExercise = Exercise::get($selectedQuestion->exercise_id);

        $selectedQuestion->delete();

        $selectedQuestions = $selectedExercise->getQuestions();

        $this->render("edit_exercise", compact('selectedExercise', 'selectedQuestions'));
    }
}
