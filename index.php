<?php
namespace Looper\Controllers;

require_once 'vendor/autoload.php';

$action = $_GET['action'] ?? null;
if ($action) {
    switch ($action) {
        case 'home':
            ViewController::renderPage('home');
            break;
        case 'list-exercices':
        case 'take-exercise':
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
        case 'manage-exercise':
        case 'list-takes-exercises':
        case 'detail-take-exercises':
        case 'detail-question-exercises':
            break;
        default:
            ViewController::renderPage('404');
            break;
    }
} else {
    ViewController::renderPage('home');
}
