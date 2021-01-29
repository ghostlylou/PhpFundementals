<?php

require_once './Model/UserModel.php';
require_once './Controller/UserController.php';

$controller = new UserController();

?>
<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>University - Register</title>
    <meta name="description" content="Students page for University website">
    <meta name="author" content="Louella Creemers">

    <link rel="stylesheet" href="./css/bootstrap.css">
</head>

<body style="background-color: gainsboro">

<body style="background-color: #dcdcdc">
<h1 style="text-align: center">Register - Student Management System</h1>

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $email = htmlspecialchars(strip_tags($_POST['username']));
        $password = htmlspecialchars(strip_tags($_POST['password']));
        $firstname = htmlspecialchars(strip_tags($_POST['firstname']));
        $lastname = htmlspecialchars(strip_tags($_POST['lastname']));

        $u = new UserModel($firstname, $lastname, $email, $password);

        $controller->CheckRegistrationCon($u);

    }
?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <table class="table table-hover table-bordered">
        <tr>
            <th>First name</th>
            <td><input type="text" name="firstname" class="form-control" required></td>
        </tr>

        <tr>
            <th>Last name</th>
            <td><input type="text" name="lastname" class="form-control" required></td>
        </tr>

        <tr>
            <th>Email</th>
            <td><input type="text" name="username" class="form-control" required></td>
        </tr>

        <tr>
            <th>Password</th>
            <td><input type="password" name="password" class="form-control" required></td>
        </tr>

        <tr>
            <td>
                <input type="submit" value="Register" class="btn btn-primary">
                <a href="index.php" class="btn btn-secondary">Go back to Login</a>
            </td>
        </tr>
    </table>
</form>
</body>
</html>
