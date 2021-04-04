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
        $tFile = fopen($file, "r") or die("File not found"); //get file or throw message
        $ar = array(); //empty array

        while(!feof($tFile)){
            while (($row = fgetcsv($tFile, 0)) !== FALSE) {
                array_push($ar, $row); //pushes every row as array element
            }
        }

        foreach ($ar as $student){ //add student for ever array element
            $studModel = new StudentModel($student[0], $student[1], $student[2], $student[3], $student[4], $student[5]);
            $studService = new StudentService();
            $studService->CreateStudent($studModel);
        }
    }


    public function export(){
        $studService = new StudentService();
        $allStudents = $studService->GetAllStudents();

        $fn = "upload/csv_" . uniqid() . ".csv"; //create file with unique id to write all students in
        $file = fopen($fn, "w");

        foreach ($allStudents as $student){
            $studentArray = (array)$student;
            fputcsv($file, $studentArray);
        }

        fclose($file);

        return $fn; //return location
    }

    public function uploadImageMirror($img){
        Image::make($_FILES['uploadImg']['tmp_name'])->flip('h')->save($img); //return image as mirrored
    }

    public function uploadImage($img){ //return image normally
        if (move_uploaded_file($_FILES['uploadImg']['tmp_name'], $img)){
            echo "file is valid and added";
            return true;
        }
    }

}