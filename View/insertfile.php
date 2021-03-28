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
        <div class="row justify-content-center align-items-center" style="padding: 2%;">
            <div class="col-12 text-center">
                <input type="file" name="upload">
                <button type="submit" name="import" value="import" class="btn btn-primary">IMPORT CSV</button>
            </div>
        </div>

        <div class="row justify-content-center align-items-center" style="padding: 2%;">
            <div class="col-12 text-center">
                <button type="submit" name="export" value="export" class="btn btn-primary">EXPORT CSV</button>
            </div>
        </div>
    </form>
</body>
</html>