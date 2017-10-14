<?php

# Table: users
# Primary key: id
# Foreign key: role_id

class User extends \GF\Core\AbstractModel
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