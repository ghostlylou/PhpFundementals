<?php
include_once "Helpers/nav.php";

$calender_url = "";


if(isset($_POST['year'])){

    $calender_url .= "https://calendarific.com/api/v2/holidays?api_key=c1d351472d6c3250c256549651e8dc4323e8c93a&country=nl&year=.{$_POST['year']}";
}

else{
    $calender_url .= "https://calendarific.com/api/v2/holidays?api_key=c1d351472d6c3250c256549651e8dc4323e8c93a&country=nl&year=2021";
}
//c1d351472d6c3250c256549651e8dc4323e8c93a

$calender_json = file_get_contents($calender_url);
$calender_rawarray = json_decode($calender_json, true);
$calender_array = $calender_rawarray['response']['holidays'];

?>

<!doctype html>

<html lang="en">
    <head>
        <meta charset="utf-8">

        <title>Student Management System - Calender</title>
        <meta name="description" content="Student management system website for PHP1">
        <meta name="author" content="Louella Creemers">

        <link rel="stylesheet" href="./../css/bootstrap.css">
    </head>

    <body style="background-color: gainsboro">
        <section class="container-fluid">
            <div class="row">
                <div class="col-6">
                    <h2> Holidays</h2>
                </div>
                <div class="col-6">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" style="margin-bottom:1em " method="post">
                        <select class="dropdown" name="year">
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                        </select>
                        <input type="submit" class="btn btn-primary" value="Select year"/>
                    </form>
                </div>

            </div>

            <table class="table table-dark">
                <thead>
                    <th>Holiday</th>
                    <th>Date</th>
                </thead>
                <tbody>
                    <?php
                    $nameArray = array_column($calender_array, 'name');
                    $dateArray = array_column($calender_array, 'date');
                    $isoArray = array_column($dateArray, "iso");

                    for($i = 0; $i < count($calender_array); $i++){

                        $isoSub = substr($isoArray[$i], 0, 10);

                        echo "<tr>";
                        echo "<td>{$nameArray[$i]}</td>";
                        echo "<td>{$isoSub}</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </body>
</html>
