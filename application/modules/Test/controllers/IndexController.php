<?php

namespace Test\controllers;

use \GF\Core\AbstractController as AbstractController;

class IndexController extends AbstractController
{
    public function indexAction()
    {
        echo 'Test '.__CLASS__ . ' ' . __METHOD__;
    }
}