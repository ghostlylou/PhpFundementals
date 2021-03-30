<?php

include_once("./Data/PaymentDAO.php");

class PaymentService
{
    private $dao;

    public function __construct(){
        $this->dao = new PaymentDAO();
    }

    public function createPayment($payment){
        return $this->dao->createPayment($payment);
    }

    public function getPayment($id){
        return $this->dao->getPayment($id);
    }
}