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
        $teacher_id = filter_input(INPUT_POST, 'teacher');
        $status = filter_input(INPUT_POST, 'status', FILTER_VALIDATE_INT);

        $errors = [];
        if (empty($firstname)) {
            $errors['firstname_empty'] = 'Veuillez renseignez votre prénom';
        }
        if (empty($lastname)) {
            $errors['lastname_empty'] = 'Veuillez renseignez votre nom';
        }
        if (empty($teacher_id)) {
            $errors['teacher_empty'] = 'Veuillez choisir un professeur votre nom';
        }
        if ($status != 1 && $status != 2) {
            $errors['status_empty'] = 'Veuillez choisir un statut, "actif" ou "inactif"';
        }

        if (!empty($errors)) {
            $this->show('students/add', [
                //TODO 'token' => $token,
                'teachers' => Teacher::findAll(),
                'errors' => $errors
            ]);
        } else {
            $student = new Student();
            $student->setFirstname($firstname);
            $student->setLastname($lastname);
            $student->setTeacher_id($teacher_id);
            $student->setStatus($status);
    
            if ($student->save()) {
                $this->redirect('students-list');
            }
        }

    }
}