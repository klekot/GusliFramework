<?php

/**
 *
 */
namespace GF\Core;

abstract class AbstractController
{
    public $route;
    public $view;
    public $currentUser;

    public function __construct($route)
    {
        $this->route  = $route;
        $this->view = new View($this->route);
        session_start();
        $this->currentUser = (isset($_SESSION['current_user'])) ? $_SESSION['current_user'] : null;
    }

    public function indexAction()
    {
        $this->view->show();
    }

    public function createAction()
    {
        $this->view->show();
    }

    public function readAction()
    {
        $this->view->show();
    }

    public function updateAction()
    {
        $this->view->show();
    }

    public function deleteAction()
    {
        $this->view->show();
    }
}