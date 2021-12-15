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
}