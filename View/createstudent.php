<?php
require '../Controller/StudentController.php';
include_once "Helpers/nav.php";
include_once "Helpers/sessionCheck.php";

?>
<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Student Management System - Create Student</title>
    <meta name="description" content="Student management system website for PHP1">
    <meta name="author" content="Louella Creemers">

    <link rel="stylesheet" href="./../css/bootstrap.css">
</head>

<body style="background-color: gainsboro">

<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){ //als submit button wordt aangeklikt
    $a = new StudentController();

    //strip all data from form of special characters
    $firstname =htmlspecialchars(strip_tags($_POST['firstname']));
    $lastname =htmlspecialchars(strip_tags($_POST['lastname']));
    $dateofbirth =htmlspecialchars(strip_tags($_POST['birthday']));
    $study =htmlspecialchars(strip_tags($_POST['study']));
    $class =htmlspecialchars(strip_tags($_POST['class']));
    $email =htmlspecialchars(strip_tags($_POST['email']));
    $a->CreateStudentCon($firstname, $lastname, $dateofbirth, $study, $class, $email);
}
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"> //als submit knop wordt aangeklikt, post
    <table class="table table-hover table-responsive table-bordered">
        <tr>
            <td>First Name</td>
            <td><input type="text" name="firstname" class="form-control" placeholder="Jan" required></td>
        </tr>
        <tr>
            <td>Last Name</td>
            <td><input type="text" name="lastname" class="form-control" placeholder="Jansen" required></td>
        </tr>
        <tr>
            <td>Birthday</td>
            <td><input type="date" name="birthday" class="form-control" required></td>
        </tr>
        <tr>
            <td>Study</td>
            <td><input type="text" name="study" class="form-control" placeholder="Information Technology" required></td>
        </tr>
        <tr>
            <td>Class</td>
            <td><input type="text" name="class" class="form-control" placeholder="INF3A" required></td>
        </tr>
        <tr>
            <td>E-mail</td>
            <td><input type="text" name="email" class="form-control" placeholder="641347@student.inholland.nl" required></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="submit" value="Save Student" class="btn btn-primary">
                <a href="students.php" class="btn btn-danger"> Go back to Students </a>
            </td>
        </tr>
    </table>
</form>

