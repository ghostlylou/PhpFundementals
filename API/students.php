<?php
include_once '../Service/StudentService.php';

$studentService = new StudentService();

$students = (array)$studentService->GetAllStudents();

foreach ($students as $item){
    $itemArray = (array)$item;
    $stringArray = array();

    foreach ($itemArray as $xitem){
        array_push($stringArray, $xitem);
    }

//    echo $itemArray[0];
    $array = array("id" => $stringArray[0], "firstName" => $stringArray[1], "lastName" => $stringArray[2]);

    http_response_code(200);
    //print_r($array);
    echo json_encode($array);

    //TODO: get GET to work once live
}
?>