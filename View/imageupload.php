<?php
require_once '../Service/fileService.php';

if(isset($_POST['upload'])){
   $file = $_FILES['upload']['name'];

   $service = new fileService();

   $service->importImage($_FILES['upload']['name']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Student Management System - Donate</title>
    <meta name="description" content="Student management system website for PHP1">
    <meta name="author" content="Louella Creemers">

    <link rel="stylesheet" href="./../css/bootstrap.css">

</head>
    <body style="background-color: gainsboro">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" style="margin-bottom:1em " method="post" enctype="multipart/form-data">
            <input type="file" accept="image/*" name="upload">
            <button class="btn btn-primary" type="submit" name="upload">Upload Image</button>
        </form>
    </body>
</html>