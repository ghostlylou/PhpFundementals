<?php

require_once("./Data/UserDAO.php");

class UserService{

    private $s;

    public function __construct(){
        $this->s = new UserDAO();
    }
    public function CheckLogin($email, $password){
        return $this->s->CheckLoginDB($email, $password);
    }

    public function CheckRegistration($user){
        return $this->s->CheckRegistrationDB($user);
    }

    public function CheckEmail($email){
        return $this->s->CheckEmailDB($email);
    }

    public function CheckDuplicateEmail($email){
        return $this->s->CheckDuplicateEmailDB($email);
    }

    public function ChangePassword($email, $password)
    {
        $this->s->ChangePasswordDB($email, $password);
    }
}

