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
$router->mount('/exercises', function () use ($router) {
    $router->get('/answering', function () {
        (new ExerciseController())->listExercises();
    });
    $router->get('/manage', function () {
        (new ExerciseController())->openManageExercise();
    });
    $router->get('/createExercise', function () {
        (new ExerciseController())->openCreateExercise();
    });
    $router->post('/createExercise', function () {
        (new ExerciseController())->validateExerciseCreation($_POST);
    });
    $router->get('/(\d+)', function ($exerciseId) {
        (new ExerciseController())->openExerciseResults($exerciseId);
    });
    $router->get('/(\d+)/edit', function ($exerciseId) {
        (new ExerciseController())->openEditExercise($exerciseId);
    });
    $router->get('/(\d+)/complete', function ($exerciseId) {
        (new ExerciseController())->completeExercise($exerciseId);
    });
    $router->get('/(\d+)/close', function ($exerciseId) {
        (new ExerciseController())->closeExercise($exerciseId);
    });
    $router->get('/(\d+)/delete', function ($exerciseId) {
        (new ExerciseController())->removeExercise($exerciseId);
    });
    /**
     * Take Routes
     */
    $router->get('/(\d+)/createTake', function ($exerciseId) {
        (new ExerciseController())->takeExercise($exerciseId ?? 0);
    });
    $router->post('/(\d+)/createTake', function ($exerciseId) {
        (new TakeController())->createTake($_POST['take'], $exerciseId);
    });
    $router->get('/(\d+)/takes/(\d+)', function ($exerciseId, $takeId) {
        (new TakeController())->openTakeResult($takeId, $exerciseId);
    });
    $router->get('/(\d+)/takes/(\d+)/edit', function ($exerciseId, $takeId) {
        (new TakeController())->showDetails($exerciseId, $takeId);
    });
    $router->post('/(\d+)/takes/(\d+)/edit', function ($exerciseId, $takeId) {
        (new TakeController())->editTake($_POST['take'], $exerciseId, $takeId);
    });
    /**
     * Question Routes
     */
    $router->post('/(\d+)/questions/createQuestion', function ($exerciseId) {
        (new QuestionController())->createQuestion($exerciseId, $_POST);
    });
    $router->post('/(\d+)/questions/createQuestion', function ($exerciseId) {
        (new QuestionController())->createQuestion($exerciseId, $_POST);
    });
    $router->get('/(\d+)/questions/(\d+)', function ($exerciseId, $questionId) {
        (new QuestionController())->openQuestionResult($questionId);
    });
    $router->post('/(\d+)/questions/(\d+)/create', function ($exerciseId) {
        (new QuestionController())->createQuestion($exerciseId, $_POST);
    });
    $router->get('/(\d+)/questions/(\d+)/edit', function ($exerciseId, $questionId) {
        (new QuestionController())->openEditQuestion($questionId);
    });
    $router->post('/(\d+)/questions/(\d+)/edit', function ($exerciseId, $questionId) {
        (new QuestionController())->editQuestion($questionId, $_POST);
    });
    $router->get('/(\d+)/questions/(\d+)/delete', function ($exerciseId, $questionId) {
        (new QuestionController())->removeQuestion($questionId);
    });
});
$router->run();