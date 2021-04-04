<?php
require_once ".././Controller/StudentController.php";
include_once "Helpers/nav.php";
include_once "Helpers/sessionCheck.php";

$controller = new StudentController();

if(isset($_GET['id']) && !empty($_GET['id'])){ //If there is an id in the link and he's not empty
    $id = $_GET['id'];
    $controller->DeleteStudentCon($id);

    header("Location: students.php");
}
?>