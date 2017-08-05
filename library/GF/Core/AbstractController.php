<?php

/**
 *
 */
namespace GF\Core;

abstract class AbstractController
{
    public $route;

    public function __construct($route)
    {
        $this->route = $route;
        include ROOT .
            DIRECTORY_SEPARATOR . APP .
            DIRECTORY_SEPARATOR . MODULES .
            DIRECTORY_SEPARATOR . ucfirst($route['module']) .
            DIRECTORY_SEPARATOR . 'views' .
            DIRECTORY_SEPARATOR . strtolower($route['controller']) .
            DIRECTORY_SEPARATOR . $route['action'] . '.php';
    }

    public function indexAction()
    {
    }

    public function createAction()
    {
    }

    public function readAction()
    {
    }

    public function updateAction()
    {
    }

    public function deleteAction()
    {
    }
}