<?php

namespace Looper\Controllers;

use Looper\Models\database\entities\Take;
use Looper\Models\database\entities\Answer;
use Looper\Models\database\entities\Exercise;

class TakeController extends ViewController
{

    public function saveTake(array $takeForm, int $id)
    {
        $take = new Take(['timestamp' => date("Y-m-d H:i:s")]);
        $answers = array_map(fn($answer) => new Answer(['value' => $answer['value']]), $takeForm['answers']);
        $take->create($answers);

        $exercise = Exercise::get($id);
        $exercise->loadQuestions();

        ViewController::renderPage('take_exercise', ['exercise' => $exercise]);
    }
}
