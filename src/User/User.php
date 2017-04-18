<?php
namespace Peto16\User;

class User
{
    public $id;
    public $username;
    public $firstname;
    public $lastname;
    public $email;
    public $level;
    public $administrator = false;
    public $enabled = true;
    private $password;

    public function getFullName()
    {
        return $this->firstname . " " . $this->lastname;
    }

    public function getDataArray()
    {
        return [
            $this->username,
            $this->firstname,
            $this->lastname,
            $this->email,
            $this->level,
            $this->administrator,
            $this->enabled
        ];
    }

    public function loginUser($password)
    {
        if ($this->validate($password)) {
            if ($this->enabled) {
                $_SESSION['user'] = $this;
                $cookie = new \Peto16\Cookie\Cookie();
                $cookie->set("loggedIn", time());
                return true;
            }
        }
        return false;
    }

    public function setUserData($dbUser)
    {
        $this->id = $dbUser->id;
        $this->username = $dbUser->username;
        $this->firstname = $dbUser->firstname;
        $this->lastname = $dbUser->lastname;
        $this->email = $dbUser->email;
        $this->level = $dbUser->level;
        $this->administrator = $dbUser->administrator;
        $this->enabled = $dbUser->enabled;
        $this->password = $dbUser->password;
    }


    private function validate($password)
    {
        return password_verify($password, $this->password);
    }
}
