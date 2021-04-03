<?php
include_once "Helpers/nav.php";
include_once "Helpers/sessionCheck.php";

?>
<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Student Management SyEstem - Update Student</title>
    <meta name="description" content="Student management system website for PHP1">
    <meta name="author" content="Louella Creemers">

    <link rel="stylesheet" href="./../css/bootstrap.css">
</head>

<body style="background-color: gainsboro">

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        session_start(); //starts the session so SESSION can be called
        $_SESSION = array(); //puts session ID in array
        session_unset(); //unset data
        session_destroy(); //destroys session
        header("location: ../index.php"); //sends user back to login screen
        exit;
    }
?>

<form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" style="margin: 3em">
    <h1>Are you sure you want to log out?</h1>

    <input type="submit" value="Yes" class="btn btn-success">
    <a href="students.php" type="button" class="btn btn-danger">Go back to Students</a>
</form>
</body>