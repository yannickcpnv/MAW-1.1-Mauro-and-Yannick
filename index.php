<?php

namespace Looper\Controllers;

require_once 'vendor/autoload.php';

$action = $_GET['action'] ?? null;
if ($action) {
    switch ($action) {
        case 'home':
            ViewController::renderPage('home');
            break;
        case 'list-exercises':
            (new ExerciseController())->listExercises();
            break;
        case 'take-exercise':
            (new ExerciseController())->takeExercise($_GET['exercise-id'] ?? 0);
            break;
        case 'create-take':
            (new TakeController())->createTake($_POST['take'], $_GET['exercise-id'], $_SERVER);
            break;
        case 'edit-take':
            if (isset($_POST['take'])) {
                (new TakeController())->editTake($_POST['take'], $_GET['exercise-id'], $_GET['take-id']);
            } else {
                (new TakeController())->showDetails($_GET['exercise-id'], $_GET['take-id']);
            }
            break;
        case 'create-exercise':
            if (!isset($_POST["title"])) {
                (new ExerciseController())->openCreateExercise();
            } else {
                (new ExerciseController())->validateExerciseCreation($_POST);
            }
            break;
        case 'create-question':
            if ($_POST["field_label"] == "") {
                (new ExerciseController())->openEditExercise($_GET["id"]);
            } else {
                (new QuestionController())->createQuestion($_GET["id"], $_POST);
            }
            break;
        case 'edit-exercise':
            (new ExerciseController())->openEditExercise($_GET["id"]);
            break;
        case 'complete-exercise':
            (new ExerciseController())->completeExercise($_GET["id"]);
            break;
        case 'delete-exercise':
            (new ExerciseController())->removeExercise($_GET["id"]);
            break;
        case 'close-exercise':
            (new ExerciseController())->closeExercise($_GET["id"]);
            break;
        case 'delete-question':
            (new QuestionController())->removeQuestion($_GET["id"]);
            break;
        case 'edit-question':
            if (!isset($_POST["field_label"])) {
                (new QuestionController())->openEditQuestion($_GET["id"]);
            } else {
                if ($_POST["field_label"] == "") {
                    (new QuestionController())->openEditQuestion($_GET["id"]);
                } else {
                    (new QuestionController())->editQuestion($_GET["id"], $_POST);
                }
            }
            break;
        case 'edit-question-view':
            if (!isset($_POST["field_label"])) {
                (new QuestionController())->openEditQuestion($_GET["id"]);
            } else {
                (new QuestionController())->editQuestion($_GET["id"], $_POST);
            }
            break;
        case 'manage-exercises':
            (new ExerciseController())->openManageExercise();
            break;
        case 'exercise-results':
            (new ExerciseController())->openExerciseResults($_GET["id"]);
            break;
        case 'take-results':
        case 'question-results':
            break;
        default:
            ViewController::renderPage('404');
            break;
    }
} else {
    ViewController::renderPage('home');
}
