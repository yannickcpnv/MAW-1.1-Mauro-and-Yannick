<?php

namespace Looper\Controllers;

require_once 'vendor/autoload.php';

require_once __DIR__ . '\vendor\bramus\router\src\Bramus\Router\Router.php';
// Create a Router
$router = new \Bramus\Router\Router();

// Custom 404 Handler
$router->set404(function () {
    ViewController::renderPage('404');
});
$router->get('/', function () {
    ViewController::renderPage('home');
});
$router->get('/list-exercises', function () {
    (new ExerciseController())->listExercises();
});
$router->get('/take-exercise/(\d+)', function ($exerciseId) {
    (new ExerciseController())->takeExercise($exerciseId ?? 0);
});
$router->post('/create-take/(\d+)', function ($exerciseId) {
    (new TakeController())->createTake($_POST['take'], $exerciseId);
});
$router->get('/edit-take/(\d+)/(\d+)', function ($exerciseId, $takeId) {
    (new TakeController())->showDetails($exerciseId, $takeId);
});
$router->post('/edit-take/(\d+)/(\d+)', function ($exerciseId, $takeId) {
    (new TakeController())->editTake($_POST['take'], $exerciseId, $takeId);
});
$router->get('/edit-take/(\d+)/(\d+)', function ($exerciseId, $takeId) {
    (new TakeController())->editTake($_POST['take'], $exerciseId, $takeId);
});
$router->post('/edit-take/(\d+)/(\d+)', function ($exerciseId, $takeId) {
    (new TakeController())->showDetails($exerciseId, $takeId);
});
$router->get('/create-exercise', function () {
    (new ExerciseController())->openCreateExercise();
});
$router->post('/create-exercise', function () {
    (new ExerciseController())->validateExerciseCreation($_POST);
});
//ça peux arriver??? TODO
$router->get('/create-question/(\d+)', function ($id) {
    (new ExerciseController())->openEditExercise($id);
});
$router->post('/create-question/(\d+)', function ($id) {
    (new QuestionController())->createQuestion($id, $_POST);
});
$router->get('/edit-exercise/(\d+)', function ($exerciseId) {
    (new ExerciseController())->openEditExercise($exerciseId);
});
$router->get('/complete-exercise/(\d+)', function ($exerciseId) {
    (new ExerciseController())->completeExercise($exerciseId);
});
$router->get('/delete-exercise/(\d+)', function ($exerciseId) {
    (new ExerciseController())->removeExercise($exerciseId);
});
$router->get('/close-exercise/(\d+)', function ($exerciseId) {
    (new ExerciseController())->closeExercise($exerciseId);
});
$router->get('/delete-question/(\d+)', function ($questionId) {
    (new QuestionController())->removeQuestion($questionId);
});
//ça peux arriver??? TODO
$router->get('/edit-question/(\d+)', function ($questionId) {
    (new QuestionController())->openEditQuestion($questionId);
});
$router->post('/edit-question/(\d+)', function ($questionId) {
    if ($_POST["field_label"] == "") {
        (new QuestionController())->openEditQuestion($questionId);
    } else {
        (new QuestionController())->editQuestion($questionId, $_POST);
    }
});
$router->get('/edit-question-view/(\d+)', function ($questionId) {
    (new QuestionController())->openEditQuestion($questionId);
});
$router->post('/edit-question-view/(\d+)', function ($questionId) {
    (new QuestionController())->editQuestion($questionId, $_POST);
});
$router->get('/manage-exercises/', function () {
    (new ExerciseController())->openManageExercise();
});
$router->get('/exercise-results/(\d+)', function ($exerciseId) {
    (new ExerciseController())->openExerciseResults($exerciseId);
});
$router->get('/take-results/(\d+)/(\d+)', function ($exerciseId, $takeId) {
    (new TakeController())->openTakeResult($takeId, $exerciseId);
});
$router->get('/question-results/(\d+)', function ($questionId) {
    (new QuestionController())->openQuestionResult($questionId);
});
$router->run();