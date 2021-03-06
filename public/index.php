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

$router->map(
    'GET',
    '/teachers/edit/[i:id]',
    [
        'method' => 'edit',
        'controller' => '\App\Controllers\TeacherController' 
    ],
    'teachers-edit'
);

$router->map(
    'POST',
    '/teachers/edit/[i:id]',
    [
        'method' => 'update',
        'controller' => '\App\Controllers\TeacherController' 
    ],
    'teachers-edit-post'
);

$router->map(
    'GET',
    '/teachers/delete/[i:id]',
    [
        'method' => 'delete',
        'controller' => '\App\Controllers\TeacherController' 
    ],
    'teachers-delete'
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

$router->map(
    'GET',
    '/students/edit/[i:id]',
    [
        'method' => 'edit',
        'controller' => '\App\Controllers\StudentController' 
    ],
    'students-edit'
);

$router->map(
    'POST',
    '/students/edit/[i:id]',
    [
        'method' => 'update',
        'controller' => '\App\Controllers\StudentController' 
    ],
    'students-edit-post'
);

$router->map(
    'GET',
    '/students/delete/[i:id]',
    [
        'method' => 'delete',
        'controller' => '\App\Controllers\StudentController' 
    ],
    'students-delete'
);


//App users routes
$router->map(
    'GET',
    '/signin',
    [
        'method' => 'signin',
        'controller' => '\App\Controllers\AppUserController' 
    ],
    'sign-in'
);

$router->map(
    'GET',
    '/logout',
    [
        'method' => 'logout',
        'controller' => '\App\Controllers\AppUserController' 
    ],
    'logout'
);

$router->map(
    'POST',
    '/signin',
    [
        'method' => 'authentification',
        'controller' => '\App\Controllers\AppUserController' 
    ],
    'sign-in-post'
);

$router->map(
    'GET',
    '/users',
    [
        'method' => 'list',
        'controller' => '\App\Controllers\AppUserController' 
    ],
    'users-list'
);

$router->map(
    'GET',
    '/users/add',
    [
        'method' => 'add',
        'controller' => '\App\Controllers\AppUserController' 
    ],
    'users-add'
);

$router->map(
    'POST',
    '/users/add',
    [
        'method' => 'create',
        'controller' => '\App\Controllers\AppUserController' 
    ],
    'users-add-post'
);

$router->map(
    'GET',
    '/users/edit/[i:id]',
    [
        'method' => 'edit',
        'controller' => '\App\Controllers\AppUserController' 
    ],
    'users-edit'
);

$router->map(
    'POST',
    '/users/edit/[i:id]',
    [
        'method' => 'update',
        'controller' => '\App\Controllers\AppUserController' 
    ],
    'users-edit-post'
);

$router->map(
    'GET',
    '/users/delete/[i:id]',
    [
        'method' => 'delete',
        'controller' => '\App\Controllers\AppUserController' 
    ],
    'users-delete'
);


$match = $router->match();


$dispatcher = new Dispatcher($match, '\App\Controllers\ErrorController::err404');

if ($match) {
    $dispatcher->setControllersArguments($router);    
}

$dispatcher->dispatch();

