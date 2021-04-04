<?php

require_once './Model/UserModel.php';
require_once './Controller/UserController.php';

$controller = new UserController();

?>
<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Student Management System - Register</title>
    <meta name="description" content="Students page for University website">
    <meta name="author" content="Louella Creemers">

    <link rel="stylesheet" href="./css/bootstrap.css">
</head>

<body style="background-color: gainsboro">

<body style="background-color: #dcdcdc">
<h1 style="text-align: center">Register - Student Management System</h1>

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        //strip form input from special characters
        $email = htmlspecialchars(strip_tags($_POST['username']));
        $password = htmlspecialchars(strip_tags($_POST['password']));
        $firstname = htmlspecialchars(strip_tags($_POST['firstname']));
        $lastname = htmlspecialchars(strip_tags($_POST['lastname']));

        $u = new UserModel($firstname, $lastname, $email, $password); //create new user

        $controller->CheckRegistrationCon($u); //checks registration

    }
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <table class="table table-hover table-bordered">
        <tr>
            <th>First name</th>
            <td><input type="text" name="firstname" id="fn" class="form-control" id="firstname" value="fn" oninput="checkString(this.value)" required></td>
        </tr>

        <tr>
            <th>Last name</th>
            <td><input type="text" name="lastname" id="ln" class="form-control" oninput="checkString(this.value)" required></td>
        </tr>

        <tr>
            <th>Email</th>
            <td><input type="text" id="email" name="username" class="form-control"  oninput="checkEmail(this.value)" required></td>
        </tr>

        <tr>
            <th>Password</th>
            <td><input type="password" id="password" name="password" class="form-control" oninput="checkPassword(this.value)" required></td>
        </tr>

        <p id="error"></p>

        <tr>
            <td>
                <input type="submit" value="Register" class="btn btn-primary" id="register">
                <a href="index.php" class="btn btn-secondary">Go back to Login</a>
            </td>
        </tr>
    </table>
</form>

<script>
     let error = document.getElementById("error");
     let firstname = document.getElementById("fn");
     let lastname = document.getElementById("ln");
     let email = document.getElementById("email");
     let password = document.getElementById("password");
     let button = document.getElementById("register");

     let emailPattern = /(?!.*\.\.)(^[^\.][^@\s]+@[^@\s]+\.[^@\s\.]+$)/;
     let stringPattern = /^[a-zA-Z\s]*$/;
     let passwordPattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/;

     function init(){
         error.value = "";
         firstname.value = " ";
         lastname.value = " ";
         email.value = " ";
         password.value = "";
     }
     function checkString(str){

         if (!str.match(stringPattern)){
             button.disabled = true;
             email.disabled = true;
             password.disabled = true;
             error.innerHTML = "name input should only contain letters or spaces";
         }

         else{
             email.disabled = false;
             password.disabled = false;
             error.innerHTML = "";
         }
     }

     function checkEmail(str){
         if(!str.match(emailPattern)){ //if the email is invalid
             button.disabled = true;
             lastname.disabled = true;
             firstname.disabled = true;
             password.disabled = true;
             error.innerHTML =  "your email is invalid";
         }

         else{
             console.log("valid");
             lastname.disabled = false;
             firstname.disabled = false;
             password.disabled = false;
             button.disabled = false;
             error.innerHTML =  "";

         }
     }

    function checkPassword(str){
         if(!str.match(passwordPattern)){
             button.disabled = true;
             lastname.disabled = true;
             firstname.disabled = true;
             email.disabled = true;
             error.innerHTML = "Your password is invalid. Minimum eight characters, at least one uppercase letter, one lowercase letter and one number.";
         }

         else{
             lastname.disabled = false;
             firstname.disabled = false;
             email.disabled = false;
             button.disabled = false;
             error.innerHTML = "";
         }
    }
    window.onload = init();
 </script>
</body>
</html>
