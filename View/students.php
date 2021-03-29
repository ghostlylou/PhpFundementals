<?php
    require_once ".././Controller/StudentController.php";
    include_once "Helpers/nav.php";
    include_once "Helpers/sessionCheck.php";
    $controller = new StudentController();

    $searchTerm = "";
?>

<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Student Management System - Students</title>
    <meta name="description" content="Student management system website for PHP1">
    <meta name="author" content="Louella Creemers">

    <link rel="stylesheet" href="./../css/bootstrap.css">
</head>

<?php
if($_SERVER["REQUEST_METHOD"] = "GET"){

    if(isset($_GET['searchTxt'])){
        $searchTerm = htmlspecialchars(strip_tags($_GET['searchTxt']));
    }
}
?>


<body style="background-color: gainsboro">

    <div style="padding-left: 3em; padding-right: 3em; padding-bottom">

        <h2 style="margin-top: 0.5em">Students</h2>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" style="margin-bottom:1em " method="get">
            <a class="btn btn-outline-primary" href="createstudent.php" role="button" style="margin: 0 0 1em 0;">Create Student</a>

            <table>
                <tr class="container">
                    <td class="row">
                        <input type="text"  name="searchTxt" class="form-control col" style="margin: 0 1em 0 0.5em" placeholder="Name/Email/Reg date" required>
                        <input type="submit" value="Search" class="btn btn-primary col">
                    </td>
                </tr>
            </table>
        </form>

        <table class="table table-dark my-auto">
            <thead>
                <tr>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Birthday</th>
                    <th>Study</th>
                    <th>Class</th>
                    <th>Email</th>
                    <th>Date of registration</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $studentArray = (array)$controller->ShowStudentsCon($searchTerm); //gets array filled with students from controller

                if($studentArray){ //als studentarray niet null is
                    foreach($studentArray as $item){ //elk item in array
                        //haalt data op uit student item
                        $id = $item->getId();
                        $firstname = $item->getFirstName();
                        $lastname = $item->getLastName();
                        $dateOB = $item->getDateOfBirth();
                        $study = $item->getStudy();
                        $class = $item->getClass();
                        $email = $item->getEmail();
                        $date = $item->getDate();

                        //zet alles neer in een tabel
                        echo "<tr>";
                        echo "<td>$firstname</td>";
                        echo "<td>$lastname</td>";
                        echo "<td>$dateOB</td>";
                        echo "<td>$study</td>";
                        echo "<td>$class</td>";
                        echo "<td>$email</td>";
                        echo "<td>$date</td>";
                        echo "<td>
                        <a href='updatestudent.php?id={$id}' class='btn btn-primary m-r-1em'>Edit</a>
                        <a href='deletestudent.php?id={$id}' class='btn btn-danger m-r-1em'>Delete</a>
                        </td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
        <div class="row justify-content-center align-items-center" style="margin-top: 1%">
            <div class="col-6 text-center">
                <form action="insertfile.php" style="margin-bottom:1em " method="post">
                    <button class="btn btn-primary" onclick="insertfile.php">Import / Export</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

    
