<?php

include_once "Helpers/nav.php";
include_once "Helpers/sessionCheck.php";
include_once "../Service/fileService.php";

$fileService = new fileService();

if(isset($_POST['import'])){
    $fileService->import($_FILES['upload']['tmp_name']);
}

if(isset($_POST['export'])){
    $file = $fileService->export();
    header("location: {$file}");

}

?>
<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Student Management System - Import/Export</title>
    <meta name="description" content="Student management system website for PHP1">
    <meta name="author" content="Louella Creemers">

    <link rel="stylesheet" href="./../css/bootstrap.css">
</head>

<body style="background-color: gainsboro">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" style="margin-bottom:1em " method="post" enctype="multipart/form-data">
        <input type="file" name="upload">
        <input type="submit" name="import" value="import">

        <input type="submit" name="export" value="export">
    </form>
</body>
</html>