<?php

//Runs every monday at 23:59 on my server
include_once "Service/StudentService.php";
include_once "Model/StudentModel.php";
include_once "Email/mailer.php";

$students = new StudentService();
$mailer = new mailer();

$today = date("Y/m/d");
$lastWeek = date("Y/m/d", strtotime("-1 week"));

$new = $students->GetAllStudentsPeriod($lastWeek, $today); //gets all student that were created in the last 7 days

$text = "";

foreach ($new as $student){
    $text .= "Name: {$student->getFirstName()} {$student->getLastName()}. Registration date: {$student->getDate()}\r\n"; //puts them all in text
}

//sends students in text to email
$mailer->sendMail("louellacreemers@gmail.com", "CRONJOB: New student registrations", "These are the new student registrations this week:
$text");