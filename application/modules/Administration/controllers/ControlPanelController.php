<?php
/**
 * Created by PhpStorm.
 * User: Igor Klekotnev
 * Date: 02.09.2017
 * Time: 23:58
 */

namespace Administration\controllers;

use GF\Core\AbstractController;

class ControlPanelController extends AbstractController
{
    public function indexAction()
    {
        if (isset($this->currentUser) && $this->currentUser->isAuthorized()) {
            if($this->currentUser->isAdmin()) {
                $this->view->show('admin');
            } else {
                header( 'Location: /administration/control-panel/login', true, 303 );
            }
        } else {
            header( 'Location: /administration/control-panel/login', true, 303 );
        }
    }

    public function loginAction()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = \User::find(array(
                    'email'    => $_POST['email'],
                    'password' => $_POST['password'],
                    'role_id'  => \Role::ROLE_ADMIN
                )
            );

            if($user) {
                session_start();
                $_SESSION['current_user'] = $user;
                if ($_POST['remember-me'] == 1 && !isset($_COOKIE['remember-me'])) setcookie('remember-me', $user->id, time()+60*60*24*365);
                header( 'Location: /administration/control-panel', true, 303 );
            } else {
                echo 'wrong data';
            }
        } else {
            if (isset($_COOKIE['remember-me'])) {
                $user = $user = \User::find(array($_COOKIE['remember-me']));
                $this->view->user = $user;
                $this->view->rememberMe = $_COOKIE['remember-me'];
            }
            $this->view->show('login');
        }
    }

    public function logoutAction()
    {
        session_start();
        $_SESSION['current_user'] = null;
        header( 'Location: /', true, 307 );
    }
}