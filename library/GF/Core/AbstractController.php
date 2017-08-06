<?php

/**
 *
 */
namespace GF\Core;

abstract class AbstractController
{
    public $route;
    public $view;

    public function __construct($route)
    {
        $this->route  = $route;
        $this->view = new AbstractView($this->route);
        $this->view->show(true);
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