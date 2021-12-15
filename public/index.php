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


$match = $router->match();

// dd($match);

$dispatcher = new Dispatcher($match, '\App\Controllers\ErrorController::err404');

if ($match) {
    $dispatcher->setControllersArguments($match['name']);    
}

$dispatcher->dispatch();
