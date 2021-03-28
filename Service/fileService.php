<?php
session_start();
require_once "../Model/StudentModel.php";
require_once "StudentService.php";


class fileService
{

    public function __construct(){
    }

    public function import($file){
        $readFile = fopen($file, 'r');

        $array = fgetcsv($readFile);

        $studModel = new StudentModel($array[0], $array[1], $array[2], $array[3], $array[4], $array[5]);
        $studService = new StudentService();

        $studService->CreateStudent($studModel);

    }

    public function importImage($image){
        move_uploaded_file($_FILES["file"]["name"], "upload/" .$_FILES["file"]["name"]);
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
}