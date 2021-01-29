<?php
require '../Model/StudentModel.php';
require_once "../Data/AllExceptions.php";
require_once '../Service/StudentService.php';


class StudentController
{
    private $s;

    public function __construct(){
        $this->s = new StudentService();
    }

    public function ShowStudentsCon(string $search){ //Returns array of all students or a couple of students for the index page

        if($search == "") { //If there is no search term put in, show all students
            $studentArray = (array)$this->s->GetAllStudents(); //Return in array
        }

        else{ //If there is a search term, put in, show all students that match that term
            $studentArray = (array)$this->s->GetSearchedStudents($search);
        }

        return $studentArray; //Return array to view
    }

    public function CreateStudentCon(string $firstname, string $lastname, string $date, string $study, string $class, string $email){
        try{
            if($this->CheckEmailValid($email)){ //Check if email of created student is valid
                $newStud = new StudentModel($firstname, $lastname, $date, $study, $class, $email); //if email valid, create a student object

                $this->s->CreateStudent($newStud);
            }

            else{
                //Give error if email is not valid
                throw new InputException("email");
            }
        }
        catch(InputException $e){
            echo $e->getMessage();
        }

    }

    public function ReadStudentCon(int $id){
        return $foundStudent = $this->s->ReadStudent($id); //Search student by id for editing and deleting a student
    }

    public function DeleteStudentCon(int $id){

        $this->s->DeleteStudent($id);
    }

    public function UpdateStudentCon(int $id,string $firstname, string $lastname, string $date, string $study, string $class, string $email){
        try{
            if($this->CheckEmailValid($email)){ //If email of created student is valid
                $newStud = new StudentModel($firstname, $lastname, $date, $study, $class, $email); //Create student object with changed info

                $this->s->UpdateStudent($id, $newStud);
            }

            else{
                //If email of created student isn't valid
                throw new InputException("email");
            }
        }
        catch(InputException $e){
            echo $e->getMessage();
        }
    }

    public function CheckEmailValid(string $email){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){ //Checks if email is valid using PHPs Email Filter
            return true;
        }

        else{
            return false;
        }
    }
}