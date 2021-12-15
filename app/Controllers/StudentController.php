<?php

namespace App\Controllers;

use App\Models\{Student, Teacher};

class StudentController extends CoreController
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

        $this->show('students/list', [
            'token' => $token,
            'students' => Student::findAll()
        ]);
    }

    public function add()
    {
        $token = bin2hex(random_bytes(32));
        $_SESSION['token'] = $token;

        $this->show('students/add', [
            'token' => $token,
            'teachers' => Teacher::findAll()
        ]);
    }

    public function create()
    {
        $firstname = filter_input(INPUT_POST, 'firstname');
        $lastname = filter_input(INPUT_POST, 'lastname');
        $status = filter_input(INPUT_POST, 'status', FILTER_VALIDATE_INT);

        $student = new Student();
        $student->setFirstname($firstname);
        $student->setLastname($lastname);
        $student->setStatus($status);

        if ($student->save()) {
            $this->redirect('students-list');
        }
    }
}