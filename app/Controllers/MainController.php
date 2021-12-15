<?php

namespace App\Controllers;

use App\Models\{Teacher};

class MainController extends CoreController
{
    /**
     * Méthode s'occupant de la page d'accueil
     *
     * @return void
     */
    public function home()
    {
        $token = bin2hex(random_bytes(32));
        $_SESSION['token'] = $token;

        $this->show('main/home', [
            'token' => $token,
            'teachers' => Teacher::findAll()
        ]);
    }
}