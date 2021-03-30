<?php

use Mollie\Api\MollieApiClient;
require_once "./lib/mollie/vendor/autoload.php";
require_once "./Controller/PaymentController.php";
require_once "./Email/mailer.php";
require_once "./pdf/emailOrderGen.php";

$mailer = new mailer();

$amount = $_GET['amount'];
$email = $_GET['email'];

$paymentId = $_POST['id'];

$mollie = new MollieApiClient();
$mollie->setApiKey("test_vqEjJvzKUW67F2gz3Mr3jzgpSs4drN");

$payment = $mollie->payments->get($paymentId);


if($payment->isPaid()){
    $paymentController = new PaymentController();
    $emailGen = new emailOrderGen();

    $paymentController->createPayment($amount, "paid", $email);

    $emailGen->sendEmail($amount, "paid", $email);
    $mailer->sendMail("louellacreemers@gmail.com", "Your donation has been created", "HI");
}

else{
    $mailer->sendMail("{$email}", "Your donation has failed", "I'm sorry but your donation has failed.
    Please try again later or try with another email address");
}