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
$emailArray = $paymentController->getDistinctEmails();
$mailer = new mailer();

//$paymentId = $_POST['id'];

$mollie = new MollieApiClient();
$mollie->setApiKey("test_BJqCEmBVqfHW8nWxDsAmk58SRcNWhP");

//$payment = $mollie->payments->get($paymentId);
//
//if ($payment->isPaid()){
    $emailGen = new emailOrderGen();

    $paymentController->createPayment($amount, "paid", $email);


    $emailGen->sendEmail($amount, "paid", $email);
    $mailer->sendMail("louellacreemers@gmail.com", "A donation has been created", "Someone posted a donation of $amount");
//}

//else{
    $mailer->sendMail($email, "Donation error: Your payment failed", "Thank you for trying to donate! Please try another email address or try again later");

//


