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
        $readFile = fopen($file, 'r');

        $array = fgetcsv($readFile);

        $studModel = new StudentModel($array[0], $array[1], $array[2], $array[3], $array[4], $array[5]);
        $studService = new StudentService();

        $studService->CreateStudent($studModel);

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
        $new = Image::make($img)->flip('v')->save($img);
    }

}