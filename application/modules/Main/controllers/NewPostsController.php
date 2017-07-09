<?php

/**
 *
 */

namespace Main\controllers;

use \GF\Core\AbstractController as AbstractController;

class NewPostsController extends AbstractController
{
    public function indexAction()
    {
        echo 'main/new-posts/index/';
    }

    public function allPostsAction()
    {
        echo 'main/new-posts/all-posts/';
    }
}