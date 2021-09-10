<?php

namespace Looper;

use HomeController;

require_once 'vendor/autoload.php';

$action = $_GET['action'] ?? null;
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
}
