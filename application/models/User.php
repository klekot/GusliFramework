<?php

/**
 * Created by PhpStorm.
 * User: Igor Klekotnev
 * Date: 06.08.17
 * Time: 11:36
 */
class User extends \ActiveRecord\Model
{
    public function isAuthorized()
    {
        if (isset($_SESSION['current_user'])) {
            return ($this->id == $_SESSION['current_user']->id) ? true : false;
        }

        return false;
    }

    public function isAdmin()
    {
        return ($this->role_id == \Role::ROLE_ADMIN) ? true : false;
    }
}