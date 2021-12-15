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
    '/students',
    [
        'method' => 'list',
        'controller' => '\App\Controllers\StudentController' 
    ],
    'students-list'
);


$match = $router->match();

// dd($match);

$dispatcher = new Dispatcher($match, '\App\Controllers\ErrorController::err404');

if ($match) {
    $dispatcher->setControllersArguments($match['name']);    
}

$dispatcher->dispatch();
