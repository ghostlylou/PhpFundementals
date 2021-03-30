<?php
ini_set('display_errors', -1);
require_once "Helpers/nav.php";

use Mollie\Api\MollieApiClient;
require_once "../lib/mollie/vendor/autoload.php";

if(isset($_POST['donate'])){
    $mollie = new MollieApiClient();
    $mollie->setApiKey("test_BJqCEmBVqfHW8nWxDsAmk58SRcNWhP");

    $amount = $_POST['input'];
    $email = $_POST['email'];

    $payment = $mollie->payments->create([
        "amount" => [
            "currency" => "EUR",
            "value" => "{$_POST['input']}".".00"
        ],
        "method" => "creditcard",
        "description" => "Book Aid International",
        "redirectUrl" => "https://louellacreemers.nl/phpfundementals/View/donate.php",
        "webhookUrl"  => "https://louellacreemers.nl/phpfundementals/View/webhook.php?amount={$_POST['input']}&email={$_POST['email']}"
    ]);

    header("Location: " . $payment->getCheckoutUrl(), true, 303);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Student Management System - Donate</title>
    <meta name="description" content="Student management system website for PHP1">
    <meta name="author" content="Louella Creemers">

    <link rel="stylesheet" href="./../css/bootstrap.css">
</head>
    <body style="background-color: gainsboro">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-12 text-center">
                    <h2>Donate for books</h2>
                </div>
            </div>
            <div class="row justify-content-center align-items-center">
                <div class="col-12 text-center">
                    <h4>At Book Aid International, we know that books change lives. </h4>
                    <p>
                        Our vision is a world where everyone has access to books that will enrich, improve and change poor childrens lives.

                        Our mission is to provide books, resources and training to support an environment in which reading for pleasure, study and lifelong learning can flourish.
                    </p>
                    <br>
                    <p><bold>NOTE: You can only use your email address once</bold></p>
                </div>
            </div>

            <div class="row justify-content-center align-items-center">
                <div class="col-12 text-center">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                        <input type="text" name="email" placeholder="Email" required>
                        <input type="text" name="input" placeholder="Amount in EUR" required> <? //TODO: check if int?>
                        <button class="btn btn-primary" type="submit" name="donate">DONATE NOW</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
