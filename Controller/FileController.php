<?php
require_once "../Model/StudentModel.php";
require_once "../Service/StudentService.php";
require_once "../lib/intervention_image/vendor/autoload.php";

use Intervention\Image\ImageManagerStatic as Image;

class FileController
{
    private $imgEditor;

    public function __construct(){
        $this->imgEditor = new Intervention\Image\Image();
    }

    public function import($file){
        $tFile = fopen($file, "r");

        $ar = array();

        while(!feof($tFile)){
            array_push($ar, $tFile->fgetcsv());
        }

        var_dump($ar);

//        
//
//        while (!$tFile->eof()){
//            array_push($ar, $tFile->fgetcsv());
//        }
//
//        foreach ($ar as $student){
//            $studModel = new StudentModel($student[0], $student[1], $student[2], $student[3], $student[4], $student[5]);
//            $studService = new StudentService();
//            $studService->CreateStudent($studModel);
//        }
//        return true;
    }


    public function export(){
        $studService = new StudentService();
        $allStudents = $studService->GetAllStudents();

        $fn = "upload/csv_" . uniqid() . ".csv";
        $file = fopen($fn, "w");

        foreach ($allStudents as $student){
            $studentArray = (array)$student;
            fputcsv($file, $studentArray);
        }

        fclose($file);

        return $fn;
    }

    public function uploadImageMirror($img){
        $new = Image::make($_FILES['uploadImg']['tmp_name'])->flip('h')->save($img);
    }

    public function uploadImage($img){
        if (move_uploaded_file($_FILES['uploadImg']['tmp_name'], $img)){
            echo "file is valid and added";
            return true;
        }
    }

}