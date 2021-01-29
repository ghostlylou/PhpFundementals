<?php

class UserModel{
    private $firstname;
    private $lastname;
    private $email;
    private $password;

    public function __construct($firstname, $lastname, $email, $password)
    {
        $this->email = $email;
        $this->password = $password;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
    }


    public function getEmail()
    {
        return $this->email;
    }


    public function getPassword()
    {
        return $this->password;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }
}