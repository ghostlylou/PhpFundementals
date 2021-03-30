<?php
session_start();

include_once "pdf.php";
include_once"../Email/mailer.php";

class mailOrderGen
{
    function sendEmail($id, $email){
        $_SESSION['paymentId'] = $id;

        $pdf = new pdf();
        $mailer = new mailer();

        $invoicePdf = $pdf->loadInvoicePDF();

        file_put_contents( "../View/upload/invoice_".$id.".pdf", $invoicePdf);

        $mailer->sendEmailWithAttachment($email, 'Thank you for donating to Book Aid International',
        'Here is your invoice. Thank you for supporting students in need!', ['../View/upload/invoice_'.$id.'.pdf',]);
    }
}