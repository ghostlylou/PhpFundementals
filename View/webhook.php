<?php
ini_set('display_errors', -1);

use Mollie\Api\MollieApiClient;
require_once "../lib/mollie/vendor/autoload.php";
require_once "../Controller/PaymentController.php";
require_once "../Email/mailer.php";
require_once "../pdf/emailOrderGen.php";
$amount = $_GET['amount'];
$email = $_GET['email'];

$paymentController = new PaymentController();
$mailer = new mailer();

$paymentId = $_POST['id'];

$mollie = new MollieApiClient();
$mollie->setApiKey("test_BJqCEmBVqfHW8nWxDsAmk58SRcNWhP");

$payment = $mollie->payments->get($paymentId); //looks up payment that just got made

if ($payment->isPaid()){
    $emailGen = new emailOrderGen();

    $paymentController->createPayment($amount, "paid", $email); //creates payment


    $emailGen->sendEmail($amount, "paid", $email); //send email to donator
    //send email to me
    $mailer->sendMail("louellacreemers@gmail.com", "A donation has been created", "Someone posted a donation of $amount");
}

else { //if payment isn't recieved
    $mailer->sendMail($email, "Donation error: Your payment failed", "Thank you for trying to donate! Unfortunately something went wrong.Please try another email address or try again later");
}



