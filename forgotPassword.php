<?php
require_once './Controller/UserController.php';

?>

<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Student Management System - Password Reset</title>
    <meta name="description" content="Student management system website for PHP1">
    <meta name="author" content="Louella Creemers">

    <link rel="stylesheet" href="./css/bootstrap.css">
</head>

<?php
$controller = new UserController();

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        //strip data from form of special characters
        $email = htmlspecialchars(strip_tags($_POST['email']));
        $password = htmlspecialchars(strip_tags($_POST['password']));

        //checks if email is valid
        $status = $controller->CheckEmailCon($email);

        //if valid, change password
        if($status){
            $controller->ChangePasswordCon($email, $password);
        }
    }
?>


<body style="background-color: gainsboro">
<h1 style="text-align: center">Forgot Password - Student Management System</h1>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" style="margin: 0 3em 0 3em" method="post">
    <table class="table table-hover table-bordered">
        <tr>
            <p style="text-align: center">Type in your email-address and fill in a new password</p>
        </tr>
        <tr>
            <th>Email</th>
            <td><input type="text" name="email" class="form-control" required></td>
        </tr>

        <tr>
            <th>New password</th>
            <td><input type="password" name="password" class="form-control" required></td>
        </tr>

        <tr>
            <td>
                <input type="submit" value="Reset Password" class="btn btn-primary">
                <a href="index.php" class="btn btn-secondary">Go back to Login</a>
            </td>
        </tr>
    </table>
</form>

</body>

</html>
