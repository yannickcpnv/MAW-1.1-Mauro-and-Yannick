<?php

namespace Looper\Controllers;

use Looper\Models\database\entities\Question;

class QuestionController extends ViewController
{

    public function editQuestion($id, $questionForm = [])
    {
        $selectedQuestion = Question::get($id);
        $selectedQuestion->loadExercise();
        self::renderPage("edit_question", [$selectedQuestion]);
    }
}
