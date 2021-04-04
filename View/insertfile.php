<?php
ini_set('display_errors', -1);

include_once "Helpers/nav.php";
include_once "Helpers/sessionCheck.php";
include_once "../Controller/FileController.php";

$fileController = new FileController();

if(isset($_POST['import'])){
    $fileController->import($_FILES['upload']['tmp_name']);
}

if(isset($_POST['export'])){
    $file = $fileController->export();
    header("location: {$file}");
}

if(isset($_FILES['uploadImg']) && !isset($_POST['export']) && !isset($_POST['import'])){
    $location = "upload/";
    $img = $location . uniqid() . basename($_FILES['uploadImg']['name']);


    if($_FILES['uploadImg']['size'] < 2000000){
        if(!isset($_POST['uploadImgR'])){
            if ($fileController->uploadImage($img)){;
                $_POST['imgLoc'] = $img;
            }
            else{
                echo "error. Can't upload your pic";
            }
        }

        else{
            $fileController->uploadImageMirror($img);
            $_POST['imgLoc'] = $img;
        }
    }
    else{
        echo "error: Your image is too big. It can't be bigger than 2 MB";
    }
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
        <div class="row justify-content-center align-items-center">
            <div class="col-12 text-center">
                <input type="file" name="upload" accept="text/csv">
                <button type="submit" name="import" value="import" class="btn btn-primary">IMPORT CSV</button>
            </div>
        </div>

        <div class="row justify-content-center align-items-center" style="padding-top: 1%;">
            <div class="col-12 text-center">
                <button type="submit" name="export" value="export" class="btn btn-primary">EXPORT CSV</button>
            </div>
        </div>

        <div class="row justify-content-center align-items-center" style="padding-top: 1%;">
            <div class="col-12 text-center">
                <input type="file" accept="image/*" name="uploadImg">
                <button class="btn btn-primary" type="submit" name="uploadImg">UPLOAD IMAGE</button>
                <button class="btn btn-primary" type="submit" name="uploadImgR">UPLOAD MIRRORED IMAGE</button>
            </div>
        </div>

        <?php
            if(isset($_POST['imgLoc'])){
            echo "<div class='row justify-content-center align-items-center'>
                <div class='col-12 text-center'>
                <h4> Result: </h4>
                        <img src='{$_POST['imgLoc']}' height='300'>
                </div>
            </div>";
            }
        ?>
    </form>
</body>

<script>
    function studentCreated(){
        alert("Students have been created");
    }
</script>
</html>