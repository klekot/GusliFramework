<?php

namespace Test\controllers;

use \GF\Core\AbstractController as AbstractController;
use GF\Utils\Utils;

class IndexController extends AbstractController
{
    public function indexAction()
    {
        Utils::debug($this->route);
    }
}