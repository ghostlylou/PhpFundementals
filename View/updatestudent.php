<?php
require_once ".././Controller/StudentController.php";
include_once "Helpers/nav.php";
include_once "Helpers/sessionCheck.php";

$controller = new StudentController();

if(isset($_GET['id']) && !empty($_GET['id']));{ //If id is in link and id is not empty
    $id = $_GET['id'];
    $foundStudent = $controller->ReadStudentCon($id); //find student with matching id
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

    //strip all filled in info from from special html characters
    $firstname =htmlspecialchars(strip_tags($_POST['firstname']));
    $lastname =htmlspecialchars(strip_tags($_POST['lastname']));
    $dateofbirth =htmlspecialchars(strip_tags($_POST['birthday']));
    $study =htmlspecialchars(strip_tags($_POST['study']));
    $class =htmlspecialchars(strip_tags($_POST['class']));
    $email =htmlspecialchars(strip_tags($_POST['email']));

    $controller->UpdateStudentCon($id, $firstname, $lastname, $dateofbirth, $study, $class, $email); //update student
}
?>

<form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]."?id={$id}");?>" method="post">
    <table class="table table-hover table-responsive table-bordered">
        <tr>
            <td>First Name</td>
            <td><input type="text" name="firstname" value="<?php echo $foundStudent->getFirstName()?>" class="form-control" required></td>
        </tr>
        <tr>
            <td>Last Name</td>
            <td><input type="text" name="lastname" value="<?php echo $foundStudent->getLastName()?>" class="form-control" required></td>
        </tr>
        <tr>
            <td>Birthday</td>
            <td><input type="date" name="birthday" value="<?php echo $foundStudent->getDateOfBirth()?>" class="form-control"></td>
        </tr>
        <tr>
            <td>Study</td>
            <td><input type="text" name="study" value="<?php echo $foundStudent->getStudy()?>" class="form-control" required></td>
        </tr>
        <tr>
            <td>Class</td>
            <td><input type="text" name="class" value="<?php echo $foundStudent->getClass()?>" class="form-control" required></td>
        </tr>

        <tr>
            <td>Email</td>
            <td><input type="text" name="email" value="<?php echo $foundStudent->getEmail()?>" class="form-control" required></td>
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

</body>
</html>