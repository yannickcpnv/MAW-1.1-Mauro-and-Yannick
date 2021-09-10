<?php

namespace Looper\Controllers;

require_once 'vendor/autoload.php';

$action = $_GET['action'] ?? null;
if ($action) {
    switch ($action) {
        case 'home':
            (new HomeController())->home();
            break;
        case 'list-exercices':
        case 'take-exercise':
        case 'create-exercise':
        case 'edit-exercise':
        case 'manage-exercise':
        case 'list-takes-exercises':
        case 'detail-take-exercises':
        case 'detail-question-exercises':
            break;
        default:
            require_once 'views/pages/404.php';
            break;
    }
} else {
    (new HomeController())->home();
}
