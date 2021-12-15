<?php

require_once '../vendor/autoload.php';

session_start();

$router = new AltoRouter();

$_SERVER['BASE_URI'] = '/';


$router->map(
    'GET',
    '/',
    [
        'method' => 'home',
        'controller' => '\App\Controllers\MainController' 
    ],
    'main-home'
);

// Teachers routes
$router->map(
    'GET',
    '/teachers',
    [
        'method' => 'list',
        'controller' => '\App\Controllers\TeacherController' 
    ],
    'teachers-list'
);

$router->map(
    'GET',
    '/teachers/add',
    [
        'method' => 'add',
        'controller' => '\App\Controllers\TeacherController' 
    ],
    'teachers-add'
);

$router->map(
    'POST',
    '/teachers/add',
    [
        'method' => 'create',
        'controller' => '\App\Controllers\TeacherController' 
    ],
    'teachers-add-post'
);

//Students routes
$router->map(
    'GET',
    '/students',
    [
        'method' => 'list',
        'controller' => '\App\Controllers\StudentController' 
    ],
    'students-list'
);

$router->map(
    'GET',
    '/students/add',
    [
        'method' => 'add',
        'controller' => '\App\Controllers\StudentController' 
    ],
    'students-add'
);

$router->map(
    'POST',
    '/students/add',
    [
        'method' => 'create',
        'controller' => '\App\Controllers\StudentController' 
    ],
    'students-add-post'
);

$match = $router->match();

// dd($match);

$dispatcher = new Dispatcher($match, '\App\Controllers\ErrorController::err404');

if ($match) {
    $dispatcher->setControllersArguments($match['name']);    
}

$dispatcher->dispatch();
