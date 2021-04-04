<?php
ini_set('display_errors', -1);
require_once "Helpers/nav.php";
require_once "../lib/mollie/vendor/autoload.php";
require_once "../Controller/PaymentController.php";

use Mollie\Api\MollieApiClient;

if(isset($_POST['donate'])){
    $mollie = new MollieApiClient();
    $mollie->setApiKey("test_BJqCEmBVqfHW8nWxDsAmk58SRcNWhP"); //sets key

    $amount = $_POST['input'];
    $email = $_POST['email'];

    $payment = $mollie->payments->create([ //creates payment
        "amount" => [
            "currency" => "EUR",
            "value" => "{$_POST['input']}".".00"
        ],
        "description" => "Book Aid International",
        "redirectUrl" => "https://louellacreemers.nl/phpfundementals/View/paymentsuccess.php",
        "webhookUrl"  => "https://louellacreemers.nl/phpfundementals/View/webhook.php?amount={$_POST['input']}&email={$_POST['email']}"
    ]);

    header("Location: " . $payment->getCheckoutUrl(), true, 303); //if payment is paid, send to this page

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
                </div>
            </div>

            <div class="row justify-content-center align-items-center">
                <div class="col-12 text-center">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" id="form">
                        <label for="emailField">Email:</label>
                        <input type="text" name="email" id="emailField" placeholder="Email" oninput="checkEmail(this.value)" required>

                        <label for="amountField" style="margin-left: 1%">Amount in EUR:</label>
                        <input type="text" name="input" id="amountField" placeholder="Amount in EUR" oninput="checkAmount(this.value)" required> <? //TODO: check if int?>
                        <p id="error"></p>
                        <button class="btn btn-primary" type="submit" name="donate" id="submit">DONATE NOW</button>
                    </form>
                </div>
            </div>
        </div>

        <script> //javascript input check
            //put elements in variable
            let error = document.getElementById("error");
            let sButton = document.getElementById("submit");
            let amountField = document.getElementById("amountField");
            let emailField = document.getElementById("emailField");

            //regex patterns
            var emailPattern = /(?!.*\.\.)(^[^\.][^@\s]+@[^@\s]+\.[^@\s\.]+$)/;
            var amountPattern = /^[0-9]*$/;

            //Empty fields with refresh or entering the page again so user cant put in wrong data
            function init(){
                amountField.value = "";
                emailField.value = "";
            }

            //checks email with regex
            function checkEmail(){
                console.log(emailField.value);

                if(!emailField.value.match(emailPattern)){ //if the email is invalid
                    error.innerHTML = "Your email is invalid"; //puts string in p tag
                    sButton.disabled = true;
                }

                else{
                    error.innerHTML = " "; //if input is correct after making a mistake, remove error and make button usable
                    sButton.disabled = false;
                }
            }

            //checks amount with regex
            function checkAmount(){
                if(!amountField.value.match(amountPattern)){ //if there is anything filled in tha isn't a number
                    error.innerHTML = "You can only put in numbers"; //puts string in p tag
                    sButton.disabled = true;
                }

                else if(!emailField.value.match(emailPattern) && amountField.value.match(amountPattern)){ //if amount is correct but email is not
                    sButton.disabled = true;
                }

                else{
                    error.innerHTML = " "; //if input is correct after making a mistake, remove error and make button usable
                    sButton.disabled= false;
                }
            }
            window.onload = init(); //if page loads, use init function
        </script>
    </body>
</html>
