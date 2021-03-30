<?php
session_start();

include_once "../pdf/pdf.php";
include_once"../Email/mailer.php";

class emailOrderGen
{
    function sendEmail($amount, $status, $email){
        echo "Email: $email";

        $_SESSION['email'] = $email;
        $_SESSION['status'] = $status;
        $_SESSION['amount'] = $amount;

        $id = uniqid();

        $pdf = new pdf();
        $mailer = new mailer();

        $invoicePdf = $pdf->loadInvoicePDF();

        file_put_contents( "./View/upload/invoice_".$id.".pdf", $invoicePdf);

        $mailer->sendEmailWithAttachment($email, 'Thank you for donating to Book Aid International',
        'Here is your invoice. Thank you for supporting students in need!', ['./View/upload/invoice_'.$id.'.pdf']);
    }
}