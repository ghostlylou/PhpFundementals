<?php

require_once "Database.php";
require_once "../Model/PaymentModel.php";


class PaymentDAO
{
    private $dbConn;

    function __construct(){
        $this->dbConn = Database::getInstance();
    }

    function createPayment(object $payment){
        $amount = $this->EscapeString($payment->getAmount());
        $status = $this->EscapeString($payment->getStatus());
        $email = $this->EscapeString($payment->getEmail());

        try{
            $sql = "INSERT INTO payments (amount, status, email)
                    VALUES ({$amount}, {$status}, {$email})";

            $result = mysqli_query($this->dbConn->connect(), $sql);

            if($result){
                echo "<div class='alert alert-success'>Thank you for donating, your invoice will be send by email</div>";
            }
            else{
                throw new DatabaseException("Can't create database insert");
            }
        }
        catch (DatabaseException $e){
            echo $e->getMessage();
        }
    }

    private function EscapeString($result){ //against SQL injection
        $checkedResult = mysqli_real_escape_string($this->dbConn->connect(), $result);
        return $checkedResult;
    }
}