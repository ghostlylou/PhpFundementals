<?php

include_once "../Service/PaymentService.php";
include_once "../Model/PaymentModel.php";
require_once "../lib/barcodegen/vendor/autoload.php";

$email = $_SESSION['email'];
$amount = $_SESSION['amount'];
$status = $_SESSION['status'];

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../css/bootstrap.css">
</head>
<body>
    <section class="container-fluid">
        <section class="row justify-content-center align-items-center">
            <section class="col-12 text-center">
                <h2> Thank you for donating to Book AID International</h2>
                <p> We're very happy you too want to make life better for all students worldwide</p>
                <br>
                <p> Here are your  payment details!</p>
            </section>
        </section>

        <section class="row justify-content-center align-items-center">
            <section class="col-8 text-center" style="border-style: solid; border-color: black">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Made By</th>
                            <th scope="col">Amount EUR</th>
                            <th scope="col">Status</th>
                            <th scope="col">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $email?></td>
                            <td><?php echo $amount?></td>
                            <td><?php echo $status?></td>
                            <td><?php echo date("d/m/y")?></td>
                            <td><?php $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
                                echo $generator->getBarcode($email, $generator::TYPE_CODE_128)?></td>
                        </tr>
                    </tbody>
                </table>
            </section>
        </section>
    </section>
</body>
</html>
