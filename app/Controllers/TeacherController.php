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

        $this->show('teachers/list', [
            'teachers' => Teacher::findAll()
        ]);
    }

    public function add()
    {
        $token = bin2hex(random_bytes(32));
        $_SESSION['token'] = $token;

        $this->show('teachers/add', [
            'token' => $token
        ]);
    }

    public function create()
    {
        $firstname = filter_input(INPUT_POST, 'firstname');
        $lastname = filter_input(INPUT_POST, 'lastname');
        $job = filter_input(INPUT_POST, 'job');
        $status = filter_input(INPUT_POST, 'status', FILTER_VALIDATE_INT);

        $teacher = new Teacher();
        $teacher->setFirstname($firstname);
        $teacher->setLastname($lastname);
        $teacher->setJob($job);
        $teacher->setStatus($status);

        if ($teacher->save()) {
            $this->redirect('teachers-list');
        }
    }
}