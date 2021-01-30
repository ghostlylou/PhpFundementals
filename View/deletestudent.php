<?php
require_once ".././Controller/StudentController.php";
include_once "Helpers/nav.php";
include_once "Helpers/sessionCheck.php";

$controller = new StudentController();

if(isset($_GET['id']) && !empty($_GET['id']));{
    $newId = $_GET['id'];
    $foundStudent = $controller->ReadStudentCon($newId);
}

?>
<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Student Management System - Update Student</title>
    <meta name="description" content="Student management system website for PHP1">
    <meta name="author" content="Louella Creemers">

    <link rel="stylesheet" href="./../css/bootstrap.css">
</head>

<body style="background-color: gainsboro">

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $controller->DeleteStudentCon($newId);
        header("Location: students.php");
    }
?>

<form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]."?id={$newId}");?>" method="post" style="margin: 3em">
    <h1>Are you sure you want to delete <?php echo $foundStudent->getFirstName()." ".$foundStudent->getLastName()?>?</h1>

    <input type="submit" value="Delete" class="btn btn-success">
    <a href="students.php" type="button" class="btn btn-danger">Go back to Students</a>
</form>
</body>