<?php
require_once './Service/PaymentService.php';

ini_set('display_errors', -1);

echo "empty";
$paymentService = new PaymentService();
//////$payment = new PaymentModel(15, 'paid', 'louellacreemers@gmail.com');
//////
//////$paymentService->createPayment($payment);
////
////$returnPayment = $paymentService->getPaymentByMail('louellacreemers@gmail.com');
////
////$id = $returnPayment->getId();
////
////echo "id=".$id;
//
//
////$email = new emailOrderGen();
////
////$email->sendEmail(4, 'paid', 'louellacreemers@gmail.com');
//
//echo "empty";
//
//$pArray = $paymentService->getDistinctEmails();
//
//var_dump($pArray);
//
//if(in_array("louellacreemers@gmail.com", $pArray)){
//    echo "Found it";
//}
//
//else{
//    echo "no";
//}
?>