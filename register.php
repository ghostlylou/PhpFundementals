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
            <td><input type="text" name="firstname" class="form-control" id="firstname" oninput="checkString(this.value)" required></td>
        </tr>

        <tr>
            <th>Last name</th>
            <td><input type="text" name="lastname" class="form-control" oninput="checkAll()" required></td>
        </tr>

        <tr>
            <th>Email</th>
            <td><input type="text" name="username" class="form-control"  oninput="checkAll()" required></td>
        </tr>

        <tr>
            <th>Password</th>
            <td><input type="password" name="password" class="form-control" oninput="checkAll()" required></td>
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

<!--<script>-->
<!--     let error = document.getElementById("error");-->
<!--     let firstname = document.getElementsByName("firstname");-->
<!--     let lastname = document.getElementsByName("lastname");-->
<!--     let email = document.getElementsByName("username");-->
<!--     let password = document.getElementsByName("password");-->
<!--     let button = document.getElementById("register");-->
<!---->
<!--     var emailPattern = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;-->
<!--     var stringPattern = /^[a-zA-Z\s]*$/;-->
<!--     var passwordPattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/;-->
<!---->
<!--     function init(){-->
<!--         error.value = " ";-->
<!--         firstname.value = " ";-->
<!--         lastname.value = " ";-->
<!--         email.value = " ";-->
<!--         email.value.inner = "";-->
<!--         password.value = " ";-->
<!--     }-->
<!---->
<!--     function checkAll(){-->
<!--         let fnStat = checkString(firstname.value);-->
<!--         let lnStat = checkString(lastname.value);-->
<!--         let emailStat = checkEmail(email.value);-->
<!--         let passwordStat = checkPassword(password.value);-->
<!---->
<!--         if (fnStat != null){-->
<!--             error.innerHTML = fnStat;-->
<!--         }-->
<!---->
<!--         else if (lnStat != null){-->
<!--             error.innerHTML = lnStat;-->
<!--         }-->
<!---->
<!--         else if (emailStat != null){-->
<!--             error.innerHTML = emailStat;-->
<!--         }-->
<!---->
<!--         else if (passwordStat != null){-->
<!--             error.innerHTML = passwordStat;-->
<!--         }-->
<!--         else{-->
<!--             error.innerHTML = " ";-->
<!--         }-->
<!--     }-->
<!--     function checkString(str){-->
<!--         if(str === undefined){-->
<!--             alert("tes")-->
<!--             button.disabled = true;-->
<!--             return null;-->
<!--         }-->
<!---->
<!--         else if (!str.match(stringPattern)){-->
<!--             error.innerHTML = ;-->
<!--             button.disabled = true;-->
<!--             return "You can only use letters or spaces";-->
<!--         }-->
<!---->
<!--         else{-->
<!--             error.innerHTML = " ";-->
<!--             button.disabled = false;-->
<!--             return null;-->
<!--         }-->
<!--     }-->
<!---->
<!--     function checkEmail(str){-->
<!--         if(str === undefined){-->
<!--             button.disabled = true;-->
<!--             return null;-->
<!--         }-->
<!---->
<!--         else if(!str.match(emailPattern)){ //if the email is invalid-->
<!--             button.disabled = true;-->
<!--             return "Your email is invalid";-->
<!--         }-->
<!---->
<!--         else{-->
<!--             error.innerHTML = " "; //if input is correct after making a mistake, remove error and make button usable-->
<!--             button.disabled = false;-->
<!--             return null;-->
<!--         }-->
<!--     }-->
<!---->
<!--    function checkPassword(str){-->
<!--        if(str === undefined){-->
<!--            button.disabled = true;-->
<!--            return null;-->
<!--        }-->
<!---->
<!--         else if(!str.match(passwordPattern)){-->
<!--             button.disabled = true;-->
<!--             return "Your password is invalid. Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character.";-->
<!--         }-->
<!---->
<!--         else{-->
<!--             error.innerHTML = " ";-->
<!--             button.disabled = false;-->
<!--             return null;-->
<!--         }-->
<!--    }-->
<!--    window.onload = init();-->
<!-- </script>-->
</body>
</html>
