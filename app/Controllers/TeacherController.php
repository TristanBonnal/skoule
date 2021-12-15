<?php

namespace App\Controllers;

use App\Models\{Teacher};

class TeacherController extends CoreController
{
    /**
     * Méthode s'occupant de la page d'accueil
     *
     * @return void
     */
    public function list()
    {
        $token = bin2hex(random_bytes(32));
        $_SESSION['token'] = $token;

        $this->show('teachers/list', [
            'token' => $token,
            'teachers' => Teacher::findAll()
        ]);
    }
}