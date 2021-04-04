<?php

include_once("../Data/StudentDAO.php");

$s = new StudentDAO();
class StudentService
{
    private $s;

    public function __construct(){
        $this->s = new StudentDAO();
    }

    public function GetAllStudents()
    {
        $studentArray = $this->s->GetAllStudentsDB();
        return $studentArray; //returns all students from the database
    }

    public function GetAllStudentsPeriod($startdate, $enddate)
    {
        $studentArray = $this->s->GetAllStudentsPeriod($startdate, $enddate);
        return $studentArray; //returns all students from the database
    }

    public function GetSearchedStudents(string $search){
        return $this->s->GetAllSearchedStudentsDB($search); //returns all students matching search term from the database
    }

    public function CreateStudent(object $new){
        $this->s->CreateStudentDB($new); //create student from student object
    }

    public function DeleteStudent(int $id){
        $this->s->DeleteStudentDB($id); //delete student with matching id from DB
    }

    public function ReadStudent(int $id){
        $foundStudent = $this->s->ReadSingleStudentDB($id);
        return $foundStudent; //return student matching the given id from DB
    }

    public function UpdateStudent(int $id, object $new){
        $this->s->UpdateStudentDB($id, $new); //update student with matching id from DB
    }

}