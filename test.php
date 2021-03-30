<?php
require_once 'Service/PaymentService.php';
require_once 'pdf/emailOrderGen.php';
require_once 'Model/PaymentModel.php';

ini_set('display_errors', -1);

//$paymentService = new PaymentService();
////$payment = new PaymentModel(15, 'paid', 'louellacreemers@gmail.com');
////
////$paymentService->createPayment($payment);
//
//$returnPayment = $paymentService->getPaymentByMail('louellacreemers@gmail.com');
//
//$id = $returnPayment->getId();
//
//echo "id=".$id;


$email = new emailOrderGen();

$email->sendEmail(4, 'pid', 'louellacreemers@gmail.com');