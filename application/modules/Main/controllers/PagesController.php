<?php
/**
 * Created by PhpStorm.
 * User: Igor Klekotnev
 * Date: 10.07.17
 * Time: 0:14
 */

namespace Main\controllers;


use GF\Core\AbstractController;
use GF\Utils\Utils;

class PagesController extends AbstractController
{
    public function viewAction()
    {
        Utils::debug($this->route);
    }
}