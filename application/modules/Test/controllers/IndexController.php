<?php

namespace Test\controllers;

use \GF\Core\AbstractController as AbstractController;
use \UserModel as User;

class IndexController extends AbstractController
{
    public function indexAction()
    {
        $user = User::find(1);
        $this->view->user = $user->firstname;
        $this->view->show();
    }
}