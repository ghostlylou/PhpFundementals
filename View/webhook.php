<?php
ini_set('display_errors', -1);

use Mollie\Api\MollieApiClient;
require_once "../lib/mollie/vendor/autoload.php";
require_once "../Controller/PaymentController.php";
require_once "../Email/mailer.php";
require_once "../pdf/emailOrderGen.php";

$mailer = new mailer();

$amount = $_GET['amount'];
$email = $_GET['email'];

$paymentId = $_POST['id'];

$mollie = new MollieApiClient();
$mollie->setApiKey("test_BJqCEmBVqfHW8nWxDsAmk58SRcNWhP");

$payment = $mollie->payments->get($paymentId);

$mailer->sendMail("louellacreemers@gmail.com", "Trying", "$amount, $email, $paymentId");

$paymentController = new PaymentController();
$emailGen = new emailOrderGen();

$paymentController->createPayment($amount, "paid", $email);

$mailer->sendMail("louellacreemers@gmail.com", "Payment Created", "$amount, 'paid', $paymentId");

$emailGen->sendEmail($amount, "paid", $email);
$mailer->sendMail("louellacreemers@gmail.com", "Your donation has been created", "HI");

