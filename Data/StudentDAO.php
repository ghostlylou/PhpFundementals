<?php
require_once "Database.php";
require_once "../Model/StudentModel.php";

class StudentDAO
{
    private $dbConn;

    function __construct(){
        $this->dbConn = Database::getInstance();
    }

    public function GetAllStudentsDB(){
        $sql = "SELECT * FROM `students`;"; //Get everything from all students
        $result = mysqli_query($this->dbConn->connect(), $sql); //Open DB connection and use the SQL query
        return $this->ObjectToModel($result);
    }

    public function GetAllStudentsPeriod($startdate, $enddate){
        $sql = "SELECT * FROM `students` WHERE date > '{$startdate}' AND date < '{$enddate}'";

        $result = mysqli_query($this->dbConn->connect(), $sql); //Open DB connection and use the SQL query
        return $this->ObjectToModel($result);
    }

    public function GetAllSearchedStudentsDB($searchRaw){

        $search = $this->EscapeString($searchRaw);
        $sql = "SELECT * FROM `students` WHERE `firstname` LIKE '%{$search}%' OR `lastname` LIKE '%{$search}%' OR 
                `email` LIKE '%{$search}%' OR `date` LIKE '%{$search}%';"; //SELECT from students where searchterm is somehere in
        //first name, last name, email or registration date

        $result = mysqli_query($this->dbConn->connect(), $sql); //Open DB connection and use the SQL query
        return $this->ObjectToModel($result);
    }

    public function CreateStudentDB(object $object){

        $fname = $this->EscapeString($object->getFirstName());
        $lname = $this->EscapeString($object->getLastName());
        $dateOB = $this->EscapeString($object->getDateOfBirth());
        $study = $this->EscapeString($object->getStudy());
        $class = $this->EscapeString($object->getClass());
        $email= $this->EscapeString($object->getEmail());
        $dateOR = $this->EscapeString($object->getDate());

        try{
            $sql = "INSERT INTO students (firstname, lastname, dateOfBirth, study, class, email, `date`)
                VALUES ('".$fname."','".$lname."','".$dateOB."
                ','".$study."','".$class."','".$email."','".$dateOR."');";

            $result = mysqli_query($this->dbConn->connect(), $sql);

            if($result){ //if creating a student went successfully
                echo "<div class='alert alert-success'>New Student has been created successfully</div>";
            }
            else{ //if creating a student failed
                throw new DatabaseException("Can't create database insert");
            }
        }
        catch (DatabaseException $e){
            echo $e->getMessage();
        }
    }

    public function ObjectToModel($result){

        if($result->num_rows > 0){
            $students = []; //new array for students
            while($row = $result->fetch_assoc()){
                $s =new StudentModel($row['id'], $row['firstname'], $row['lastname'], $row['dateOfBirth'], $row['study'],
                    $row['class'], $row['email'], $row['date']); //create new student from the result you got from the query


                //set the data
                $s->setClass($row['class']);
                $s->setDateOfBirth($row['dateOfBirth']);
                $s->setFirstName($row['firstname']);
                $s->setLastName($row['lastname']);
                $s->setStudy($row['study']);
                $s->setId($row['id']);
                $s->setEmail($row['email']);
                $s->setDate($row['date']);

                //add student to students array
                $students[] = $s;

            }
            return $students;
        }
    }

    public function UpdateStudentDB($id, $object){

        $idFilter = $this->EscapeString($id);
        $fname = $this->EscapeString($object->getFirstName());
        $lname = $this->EscapeString($object->getLastName());
        $dateOB = $this->EscapeString($object->getDateOfBirth());
        $study = $this->EscapeString($object->getStudy());
        $class = $this->EscapeString($object->getClass());
        $email= $this->EscapeString($object->getEmail());
        $dateOR = $this->EscapeString($object->getDate());

        try{
            $sql = "UPDATE `students` SET `id`={$idFilter},`firstname`='{$fname}',`lastname`='{$lname}',`dateOfBirth`='{$dateOB}',
            `study`='{$study}',`class`='{$class}',`email`='{$email}', `date`='{$dateOR}' WHERE id = {$idFilter}";

            $result = mysqli_query($this->dbConn->connect(), $sql); //Update student with new data and get back result

            if($result){ //if updating the student went well
                echo "<div class='alert alert-success'>Student has been updated successfully</div>";
            }
            else{ //if updating the student failed
                throw new UpdateException("Can't update student");
            }
        }
        catch(UpdateException $e){
            echo $e->getMessage();
        }

    }

    public function DeleteStudentDB($id){
        $idFilter = $this->EscapeString($id);

        try{
            $sql = "DELETE FROM `students` WHERE id = '{$idFilter}';"; //delete student with matching id

            $result = mysqli_query($this->dbConn->connect(), $sql);
            if($result){ //if result is successful
                echo "<div class='alert alert-success'>Student has been deleted successfully</div>";
            }
            else{ //if result is unsuccessful
                throw new DatabaseException("Can't delete student");
            }
        }
        catch(DatabaseException $e){
          echo $e->getMessage();
        }
    }

    public function ReadSingleStudentDB($id){

        $idFilter = $this->EscapeString($id);

        $sql = "SELECT * FROM `students` WHERE id = '$idFilter' LIMIT 1;"; //Select a single student with matching id
        $result = mysqli_query($this->dbConn->connect(), $sql);

        if($result) {  //If result isn't null
            $row = mysqli_fetch_assoc($result); //Split all rows from result

            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
            $date = $row['dateOfBirth'];
            $study = $row['study'];
            $class = $row['class'];
            $email = $row['email'];

            $s = new StudentModel($firstname, $lastname,$date,$study, $class, $email); //Put all the data in a student object

            return $s;
        }
    }

    public function EscapeString($result){ //against SQL injection
        $checkedResult = mysqli_real_escape_string($this->dbConn->connect(), $result);
        return $checkedResult;
    }
}