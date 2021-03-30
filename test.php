<?php
require_once 'Service/PaymentService.php';
require_once 'Model/PaymentModel.php';

ini_set('display_errors', -1);

$paymentService = new PaymentService();
$payment = new PaymentModel(15, 'paid', 'louellacreemers@gmail.com');

$id = $paymentService->createPayment($payment);

echo "ID:" . $id;