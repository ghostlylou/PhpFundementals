<?php

include_once "Service/StudentService.php";
include_once "Model/StudentModel.php";
include_once "Email/mailer.php";

$students = new StudentService();
$mailer = new mailer();

$today = date("Y/m/d");
$lastWeek = date("Y/m/d", strtotime("-1 week"));

$new = $students->GetAllStudentsPeriod($lastWeek, $today);

$text = "";

foreach ($new as $student){
    $text .= "Name: {$student->getFirstName()} {$student->getLastName()}. Registration date: {$student->getDate()}\r\n";
}

$mailer->sendMail("louellacreemers@gmail.com", "CRONJOB: New student registrations", "These are the new student registrations this week:
$text");