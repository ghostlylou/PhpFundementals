<?php
require_once 'Service/StudentService.php';
require_once 'Service/PaymentService.php';
require_once 'Model/PaymentModel.php';

$paymentService = new PaymentService();
$payment = new PaymentModel(15, 'paid', 'louellacreemers@gmail.com');

$id = $paymentService->createPayment($payment);

echo "ID:" . $id;