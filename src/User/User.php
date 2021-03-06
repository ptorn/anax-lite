<?php
namespace Peto16\User;

/**
 * User class
 *
 */
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



    /**
     * Get the full name.
     * @method getFullName
     * @return string      Return first and lastname.
     */
    public function getFullName()
    {
        return $this->firstname . " " . $this->lastname;
    }



    /**
     * Get a data array with user data.
     * @method getDataArray
     * @return array       Array with users data
     */
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



    /**
     * Login user.
     * @method loginUser
     * @param  string    $password Password to validate
     * @return boolean             Return true if logged in else return false.
     */
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



    /**
     * Set user data to the object.
     * @method setUserData
     * @param  Obj      $dbUser data from the database about the user.
     */
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



    /**
     * Validate pasword
     * @method validate
     * @param  string   $password Password to be validated.
     * @return boolean            Return true if valid else false.
     */
    private function validate($password)
    {
        return password_verify($password, $this->password);
    }
}
