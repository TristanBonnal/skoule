<?php

namespace App\Controllers;

// Classe gérant les erreurs (404, 403)
class ErrorController extends CoreController
{
    public function __construct($router = null)
    {
        $this->router = $router;
    }

    public function err403()
    {
        header('HTTP/1.1 403 Forbidden');

        $this->show('error/err403');

        exit();
    }

    public function err404()
    {
        header('HTTP/1.0 404 Not Found');

        $this->show('error/err404');

        exit();
    }
}
