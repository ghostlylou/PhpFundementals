<?php
require_once 'Service/StudentService.php';

$students = new StudentService();

var_dump($students->GetAllStudents());