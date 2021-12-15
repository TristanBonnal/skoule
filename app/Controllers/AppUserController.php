<?php

namespace App\Controllers;

use App\Models\AppUser;

class AppUserController extends CoreController
{
    /**
     * Méthode s'occupant de la page d'accueil
     *
     * @return void
     */
    public function signin()
    {
        $this->show('appusers/signin');
    }

    public function authentification()
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

        $user = AppUser::findByEmail($email);

        $errors = [];

        if($user) {
            if (password_verify($password, $user->getPassword())) {
                $_SESSION['userId'] = $user->getId();
                $_SESSION['userObject'] = $user;
                $this->redirect('main-home');
            } else {
                $errors[] = 'Mot de passe erroné';
            }
        } else {
            $errors[] = 'Email inexistant';
        }
        $viewData['errors'] = $errors;

        $this->show('appusers/signin', $viewData);
    }

    public function logout()
    {
        unset($_SESSION['userId']);
        unset($_SESSION['userObject']);
        $this->redirect('main-home');
    }

    public function list() 
    {
        $this->show('appusers/list', [
            'users' => AppUser::findAll()
        ]);
    }

    public function add()
    {
        $token = bin2hex(random_bytes(32));
        $_SESSION['token'] = $token;

        $this->show('appusers/add', [
            'token' => $token
        ]);
    }

    public function create()
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
        $role = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_SPECIAL_CHARS);
        $status = filter_input(INPUT_POST, 'status', FILTER_VALIDATE_INT);

        $errors = [];
        if (empty($email)) {
            $errors['email_empty'] = 'Veuillez renseignez un mail valide';
        }
        if (empty($name)) {
            $errors['name_empty'] = 'Veuillez renseignez votre nom et prénom';
        }
        if (empty($password)) {
            $errors['password_empty'] = 'Veuillez renseignez un mot de passe valide';
        }
        if ($role != 'admin' && $role != 'user') {
            $errors['role_empty'] = 'Veuillez choisir un rôle, "admin" ou "utilisateur"';
        }
        if ($status != 1 && $status != 2) {
            $errors['status_empty'] = 'Veuillez choisir un statut, "actif" ou "inactif"';
        }

        if (!empty($errors)) {
            $this->show('appusers/add', [
                //TODO 'token' => $token,
                'errors' => $errors
            ]);
        } else {
            $user = new AppUser();
            $user->setEmail($email);
            $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
            $user->setName($name);
            $user->setRole($role);
            $user->setStatus($status);


            if ($user->save()) {
                $this->redirect('users-list');
            }
        }
    }

    public function edit(int $id)
    {
        $token = bin2hex(random_bytes(32));
        $_SESSION['token'] = $token;

        $this->show('appusers/edit', [
            'token' => $token,
            'user' => AppUser::find($id)
        ]);
    }

    public function update(int $id)
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
        $role = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_SPECIAL_CHARS);
        $status = filter_input(INPUT_POST, 'status', FILTER_VALIDATE_INT);

        $errors = [];
        if (empty($email)) {
            $errors['email_empty'] = 'Veuillez renseignez un mail valide';
        }
        if (empty($name)) {
            $errors['name_empty'] = 'Veuillez renseignez votre nom et prénom';
        }
        if (empty($password)) {
            $errors['password_empty'] = 'Veuillez renseignez un mot de passe valide';
        }
        if ($role != 'admin' && $role != 'user') {
            $errors['role_empty'] = 'Veuillez choisir un rôle, "admin" ou "utilisateur"';
        }
        if ($status != 1 && $status != 2) {
            $errors['status_empty'] = 'Veuillez choisir un statut, "actif" ou "inactif"';
        }

        if (!empty($errors)) {
            $this->show('appusers/add', [
                //TODO 'token' => $token,
                'errors' => $errors
            ]);
        } else {
            $user = new AppUser();
            $user->setId($id);
            $user->setEmail($email);
            $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
            $user->setName($name);
            $user->setRole($role);
            $user->setStatus($status);
            if ($user->save()) {
                $this->redirect('users-list');
            }
        }
    }

    public function delete($id)
    {
        $user = new AppUser;
        $user->setId($id);
        
        if ($user->delete()) {
            $this->redirect('users-list');
        }
    }
}