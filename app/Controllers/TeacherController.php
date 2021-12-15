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

        $errors = [];
        if (empty($firstname)) {
            $errors['firstname_empty'] = 'Veuillez renseignez votre prénom';
        }
        if (empty($lastname)) {
            $errors['lastname_empty'] = 'Veuillez renseignez votre nom';
        }
        if ($status != 1 && $status != 2) {
            $errors['firstname_empty'] = 'Veuillez choisir un statut, "actif" ou "inactif"';
        }

        if (!empty($errors)) {
            $this->show('teachers/add', [
                //TODO 'token' => $token,
                'teachers' => Teacher::findAll(),
                'errors' => $errors
            ]);
        } else {
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

    public function edit(int $id)
    {
        $token = bin2hex(random_bytes(32));
        $_SESSION['token'] = $token;

        $this->show('teachers/edit', [
            'token' => $token,
            'teacher' => Teacher::find($id)
        ]);
    }

    public function update(int $id)
    {
        $firstname = filter_input(INPUT_POST, 'firstname');
        $lastname = filter_input(INPUT_POST, 'lastname');
        $job = filter_input(INPUT_POST, 'job');
        $status = filter_input(INPUT_POST, 'status', FILTER_VALIDATE_INT);

        $errors = [];
        if (empty($firstname)) {
            $errors['firstname_empty'] = 'Veuillez renseignez votre prénom';
        }
        if (empty($lastname)) {
            $errors['lastname_empty'] = 'Veuillez renseignez votre nom';
        }
        if ($status != 1 && $status != 2) {
            $errors['status'] = 'Veuillez choisir un statut, "actif" ou "inactif"';
        }

        if (!empty($errors)) {
            $this->show('teachers/edit', [
                //TODO 'token' => $token,
                'teachers' => Teacher::findAll(),
                'errors' => $errors
            ]);
        } else {
            $teacher = new Teacher();
            $teacher->setId($id);
            $teacher->setFirstname($firstname);
            $teacher->setLastname($lastname);
            $teacher->setJob($job);
            $teacher->setStatus($status);

            if ($teacher->save()) {
                $this->redirect('teachers-list');
            }
        }
    }
    
}