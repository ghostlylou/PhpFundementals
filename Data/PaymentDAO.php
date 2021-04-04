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
                    VALUES ({$amount}, '{$status}', '{$email}')";

            $result = mysqli_query($this->dbConn->connect(), $sql);

            if($result){
                return $payment->getId();
            }
            else{
                echo"Can't create database insert";
            }
        }
        catch (DatabaseException $e){
            echo $e->getMessage();
        }
    }

    public function getPayment(int $id){
        $sql = "SELECT * FROM payments WHERE id= $id";

        $result = mysqli_query($this->dbConn->connect(), $sql);

        if($result){
            $row = mysqli_fetch_assoc($result);

            $id = $row['id'];
            $amount = $row['amount'];
            $status = $row['status'];
            $email = $row['email'];

            $payment = new PaymentModel($amount, $status, $email);
            $payment->setId($id);

            return $payment;
        }
        else{
            throw new DatabaseException("Can't create database insert");
        }
    }

    private function toArray($result){
        if($result->num_rows > 0){
            $payments = []; //new array for students
            while($row = $result->fetch_assoc()){
                //add student to students array
                $payments[] = $row['email'];
            }
            return $payments;
        }
    }

    private function EscapeString($result){ //against SQL injection
        $checkedResult = mysqli_real_escape_string($this->dbConn->connect(), $result);
        return $checkedResult;
    }
}