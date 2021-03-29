<?php
require '../Model/PaymentModel.php';
require_once "../Data/AllExceptions.php";
require_once '../Service/PaymentService.php';

class PaymentController
{
    private $s;

    public function __construct(){
        $this->s = new PaymentService();
    }

    public function createPayment(int $amount, string $status, string $email){
        $payment = new PaymentModel($amount, $status, $email);

        $this->s->createPayment($payment);
    }
}