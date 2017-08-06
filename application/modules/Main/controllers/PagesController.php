<?php
/**
 * Created by PhpStorm.
 * User: Igor Klekotnev
 * Date: 10.07.17
 * Time: 0:14
 */

namespace Main\controllers;


use GF\Core\AbstractController;

class PagesController extends AbstractController
{
    public function viewAction()
    {
        $this->view->name = 'qq';
        $this->view->show();
    }
}