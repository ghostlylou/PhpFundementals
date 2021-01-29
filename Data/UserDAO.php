<?php

require_once 'Database.php';
require_once 'AllExceptions.php';

class UserDAO
{
    private $dbConn;

    function __construct(){
        $this->dbConn = Database::getInstance();
    }

    public function CheckLoginDB($emailRaw,$passwordRaw){
        $email = $this->EscapeString($emailRaw);
        $password = $this->EscapeString($passwordRaw);

        try{
            $sql = "SELECT id FROM `users` WHERE email ='{$email}' AND password ='{$password}' LIMIT 1;"; //Select 1 account with matching password
            $result = mysqli_query($this->dbConn->connect(), $sql);

            if($result) { //if query is successful

                if ($result->num_rows == 0) { //if there are no rows in result
                    throw new LoginException("Login credentials are incorrect");
                }


                else { //if there is a matching record found
                    $row = mysqli_fetch_assoc($result);
                    $id = $row['id'];
                    return $id;
                }
            }
        }
        catch(LoginException $e){
            echo $e->getMessage();
        }
    }

    public function CheckRegistrationDB($user){

        $fname = $this->EscapeString($user->getFirstName());
        $lname = $this->EscapeString($user->getLastName());
        $email = $this->EscapeString($user->getEmail());
        $password = $this->EscapeString($user->getPassword());

       try {
           $sql = "INSERT INTO `users`(`firstname`, `lastname`, `email`, `password`) VALUES ('{$fname}',
        '{$lname}','{$email}','{$password}');";

           $result = mysqli_query($this->dbConn->connect(), $sql);

           if($result){ //if query is successful
               echo "<div class='alert alert-success'>SUCCESS: Account has been created. Go back to login page to login</div>";
           }

           else{
               throw new RegularException("Something went wrong while registering. Try again");
           }
       }

       catch (RegularException $e){
           echo $e->getMessage();
       }
    }

    public function CheckEmailDB($emailRaw){
        $email = $this->EscapeString($emailRaw);

        $sql = "SELECT * FROM `users` WHERE email = '{$email}' LIMIT 1;";
        $result = mysqli_query($this->dbConn->connect(), $sql);

        try{
            if($result){ //if result is not null
                if ($result->num_rows == 0) { //if amount of rows is 0
                    throw new AccountNotFoundException("No matching account found with this email. Try again");
                }

                else{ //return that a matching account has been found
                    $status = true;
                    return $status;
                }
            }
        }
        catch (AccountNotFoundException $e){
            echo $e->getMessage();
        }
    }

    public function CheckDuplicateEmailDB($emailRaw){
        $email = $this->EscapeString($emailRaw);

        $sql = "SELECT * FROM `users` WHERE email = '{$email}';"; //search user account with matching email
        $result = mysqli_query($this->dbConn->connect(), $sql);

        if($result){ //if query is successful

            if ($result->num_rows > 1) { //if there are multiple acccounts found with same email
                return true;
            }

            else{
                return false;
            }
        }
    }

    public function ChangePasswordDB($emailRaw, $passwordRaw){
        $email = $this->EscapeString($emailRaw);
        $password = $this->EscapeString($passwordRaw);

        try{
            $sql = "UPDATE `users` SET `password` = '{$password}' WHERE `email` = '{$email}';"; //update password for account with matching email
            $result = mysqli_query($this->dbConn->connect(), $sql);

            if($result){ // if result is successful
                echo "<div class='alert alert-success'>SUCCESS: Your password has been changed. Go back to login page</div>";
            }

            else{
                throw new RegularException("Something went wrong while changing your password. Try again");
            }
        }

        catch(RegularException $e){
            echo $e->getMessage();
        }
    }

    public function EscapeString($result){
        $checkedResult = mysqli_real_escape_string($this->dbConn->connect(), $result);
        return $checkedResult;
    }
}