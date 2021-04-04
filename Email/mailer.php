<?php

require_once "../lib/swiftmailer/vendor/autoload.php";

class mailer
{
    public function sendMail(string $recieverMail, string $subject, string $message){

        $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl')) //logs in
            ->setUsername('haarlemfestival2021@gmail.com')
            ->setPassword('79AUkc75ANVt4Aa')
        ;

        $mailer = new Swift_Mailer($transport);

        $message = (new Swift_Message($subject))
            ->setFrom(['haarlemfestival2021@gmail.com' => 'PHP2 Mail']) //sends message
            ->setTo([$recieverMail => 'visitor'])
            ->setBody($message)
        ;

        $mailer->send($message);

    }

    public function sendEmailWithAttachment(string $recieverMail, string $subject, string $message, array $attachments){
        $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl')) //logs in
            ->setUsername('haarlemfestival2021@gmail.com')
            ->setPassword('79AUkc75ANVt4Aa')
        ;
        $mailer = new Swift_Mailer($transport);

        $message = (new Swift_Message($subject)) //sends message
            ->setFrom(['haarlemfestival2021@gmail.com' => 'Haarlem Festival'])
            ->setTo([$recieverMail => 'visitor'])
            ->setBody($message)
        ;

        foreach ($attachments as $item){ //add file as string to message
            $message->attach(Swift_Attachment::fromPath("{$item}"));
        }

        $mailer->send($message);
    }
}