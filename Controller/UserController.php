<?php
require_once './Service/UserService.php';

class UserController
{
    private $s;

    public function __construct(){
        $this->s = new UserService();
    }

    public function CheckLoginCon(string $email, string $password){ //checks login input
        $passwordHashed = $this->HashInput($password); //hash password to compare it with the hashed password in the DB

        return $this->s->CheckLogin($email, $passwordHashed);
    }

    public function CheckRegistrationCon(object $user){ //checks registration input
        $regNames = '/^[a-zA-Z\s]*$/'; //Regex for name - Only letters and spaces

        $firstname = $user->getFirstName();
        $lastname = $user->getLastName();
        $email = $user->getEmail();
        $password = $user ->getPassword();


        try{
            if(preg_match("{$regNames}", "{$firstname}") == 0){ //if firstname doesn't match Regex pattern
                throw new InputException("first name");
            }

            elseif(preg_match("{$regNames}","{$lastname}") == 0){
                throw new InputException("last name");
            }

            elseif($this->CheckPasswordValid($password) == false){ //if password isn't valid
                throw new InputException("password. Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character");
            }

            elseif($this->CheckEmailValid($email) == false){ //if email isn't valid
                throw new InputException("email");
            }

            elseif($this->CheckDuplicateEmailCon($email) == true){//if email has already been registered
                echo "<div class='alert alert-danger'>Error: Your email has already been registered</div>";
            }

            else{ //if everything registered is correct
                $passwordHashed = $this->HashInput($password); //hash password
                $user->setPassword($passwordHashed); //replace raw password input with hashed password

                $this->s->CheckRegistration($user);
            }
        }
        catch (InputException $e){
            echo $e->getMessage();
        }

    }

    public function CheckEmailCon(string $email){ //returns user with matching email
        return $this->s->CheckEmail($email);
    }

    public function ChangePasswordCon(string $email, string $password) //check input data for forget password page
    {
        try{
            if($this->CheckEmailValid($email) == false) { //if email format is false
                throw new InputException("email");
            }

            else if($this->CheckPasswordValid($password) == false){ //if password doesn't match
                throw new InputException("password. Minimum eight characters, at least one uppercase letter,
                    one lowercase letter, one number and one special character.");
            }

            else{ //if input is completely correct
                $hashedPassword = $this->HashInput($password); //hash new password
                return $this->s->ChangePassword($email, $hashedPassword);
            }
        }
        catch(InputException $e){
            $e->getMessage();
        }
    }

    public function HashInput(string $input){
        $hash = hash_init("md5");
        hash_update($hash, "{$input}");
        return hash_final($hash);
    }

    public function CheckPasswordValid(string $password){
        $regPassword = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/';

        if(preg_match("{$regPassword}", "{$password}") == 0) {
            return false;
        }

        else{
            return true;
        }
    }

    public function CheckEmailValid(string $email){
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return false;
        }

        else{
            return true;
        }
    }

    public function CheckDuplicateEmailCon(string $email){
       return $this->s->CheckDuplicateEmail($email);
    }
}