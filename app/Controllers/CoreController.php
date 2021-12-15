<?php

namespace App\Controllers;

abstract class CoreController
{

    public function __construct($routeId = '')
    {   

        $accessControlList = [
            'main-home' => ['admin', 'user'],
            'teachers-list' => ['admin', 'user'],
            'teachers-add' => ['admin'],
            'teachers-add' => ['admin'],
            'students-list' => ['admin', 'user'],
            'students-add' => ['admin', 'user'],
            'students-add-post' => ['admin', 'user'], 
        ];

        if (array_key_exists($routeId, $accessControlList)) {
            $authorizedRoles = $accessControlList[$routeId];
            $this->checkAuthorization($authorizedRoles);
            CoreController::checkCsrfToken($routeId);
        }
    }

    public static function checkCsrfToken($routeId)
    {
        $csrfTokenToCheckInPost = [
            //TODO 
        ];


        if (in_array($routeId, $csrfTokenToCheckInPost)) {

            $urlToken = filter_input(INPUT_GET, 'token');
            $formToken = filter_input(INPUT_POST, 'token');
            $sessionToken = $_SESSION['token'] ?? '';

            // dump($urlToken);
            // dump($formToken);
            // dd($sessionToken);
   
            if (empty($formToken) && empty($urlToken) || empty($sessionToken) || $formToken !== $sessionToken && $urlToken !== $sessionToken) {
                // dump($formToken);
                // dd($sessionToken);
                //TODO 
                // $errorController = new ErrorController();
                // $errorController->err403();
            } else {
                unset($_SESSION['token']);
            }
        }
    }



    /**
     * Méthode permettant d'afficher du code HTML en se basant sur les views
     *
     * @param string $viewName Nom du fichier de vue
     * @param array $viewData Tableau des données à transmettre aux vues
     * @return void
     */
    protected function show(string $viewName, $viewData = [])
    {

        global $router;

        $viewData['currentPage'] = $viewName;
        $viewData['assetsBaseUri'] = $_SERVER['BASE_URI'] . 'assets/';
        $viewData['baseUri'] = $_SERVER['BASE_URI'];


        $viewData['login'] = isset($_SESSION['userObject']) ? 
        '<div class="alert alert-success">Connecté en tant que ' . $_SESSION['userObject']->getName() . '</div>' 
        : '';

        extract($viewData);

        require_once __DIR__ . '/../views/layout/header.tpl.php';
        require_once __DIR__ . '/../views/' . $viewName . '.tpl.php';
        require_once __DIR__ . '/../views/layout/footer.tpl.php';
    }

    protected function redirect(string $routeId, array $routeParam = [])
    {
        global $router;
        header('Location: ' . $router->generate($routeId, $routeParam));
        exit;
    }

    /**
     * Méthode ayant pour but de vérifier que l'utilisateur
     * a le role suffisant pour effectuer une action
     * 
     * @param array $role La liste des roles qui sont autorisés
     *
     * @return void
     */
    protected function checkAuthorization($authorizedRoles)
    {
        // Si l'utilisateur est connecté ?
        if (isset($_SESSION['userId'])) {
            $user = $_SESSION['userObject'];
            $role = $user->getRole();

            if (in_array($role, $authorizedRoles)) {
                return true;
            } else {
                $errorController = new ErrorController();
                $errorController->err403();
            }
        } else {
            $this->redirect('sign-in');
        }
    }
}
