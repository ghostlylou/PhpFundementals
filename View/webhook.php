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
$emailArray = $paymentController->getDistinctEmails() ;

if(!in_array($email, $emailArray)){
    $mailer = new mailer();

    //$paymentId = $_POST['id'];

    $mollie = new MollieApiClient();
    $mollie->setApiKey("test_BJqCEmBVqfHW8nWxDsAmk58SRcNWhP");

    //$payment = $mollie->payments->get($paymentId);

    $mailer->sendMail("louellacreemers@gmail.com", "Trying", "$amount, $email");

    $emailGen = new emailOrderGen();

    $paymentController->createPayment($amount, "paid", $email);

    $mailer->sendMail("louellacreemers@gmail.com", "Payment Created", "$amount, 'paid'");

    $emailGen->sendEmail($amount, "paid", "louellacreemers@gmail.com");
    $mailer->sendMail("louellacreemers@gmail.com", "Your donation has been created", "HI");
}

else{
    echo "Your email is already known";
}