<?php

namespace Looper\Controllers;

use Looper\Models\database\entities\Take;
use Looper\Models\database\entities\Exercise;

class TakeController extends ViewController
{

    public function saveTake(array $take, int $id)
    {
        new Take(['timestamp' => date("Y-m-d H:i:s")]);

        $exercise = Exercise::get($id);
        $exercise->loadQuestions();

        ViewController::renderPage('take_exercise', ['exercise' => $exercise]);
    }
}
