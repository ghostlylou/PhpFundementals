<?php
 require_once 'Controller/UserController.php';
 $controller = new UserController();
?>

<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Student Management System - Login</title>
    <meta name="description" content="Student management system website for PHP1">
    <meta name="author" content="Louella Creemers">

    <link rel="stylesheet" href="./css/bootstrap.css">
</head>

<?php
    if($_SERVER["REQUEST_METHOD"] = "POST"){
        if(!empty($_POST['username']) && !empty($_POST['password'])){
            $email = htmlspecialchars(strip_tags($_POST['username']));
            $password = htmlspecialchars(strip_tags($_POST['password']));

            $id = $controller->CheckLoginCon($email, $password);

            if(!empty($id)){
                $_SESSION['id'] = $controller->HashInput($id); //hash id and set it as session data
                header("Location: ./View/students.php"); //Go to students overview page
            }
        }
    }
?>


<body style="background-color: gainsboro">
    <h1 style="text-align: center">Login - Student Management System</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <table class="table table-hover table-bordered">
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
                    <input type="submit" value="Login" class="btn btn-primary">
                    <a href="register.php" value="register" class="btn btn-secondary">Register</a>
                    <a href="forgotPassword.php" value="password" class="btn btn-success">Forgot Password</a>
                </td>
            </tr>
        </table>
    </form>

</body>

</html>