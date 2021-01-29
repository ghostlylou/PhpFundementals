<?php
include_once "Helpers/nav.php";
include_once "Helpers/sessionCheck.php";

?>
<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>University - Update Student</title>
    <meta name="description" content="Students page for University website">
    <meta name="author" content="Louella Creemers">

    <link rel="stylesheet" href="./../css/bootstrap.css">
</head>

<body style="background-color: gainsboro">

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        session_start();
        $_SESSION = array();
        session_unset();
        session_destroy();
        header("location: ../index.php");
        exit;
    }
?>

<form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" style="margin: 3em">
    <h1>Are you sure you want to log out?</h1>

    <input type="submit" value="Yes" class="btn btn-success">
    <a href="students.php" type="button" class="btn btn-danger">Go back to Students</a>
</form>
</body>