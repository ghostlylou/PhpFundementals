<?php
 class StudentModel{
     private $id;
     private $firstName;
     private $lastName;
     private $dateOfBirth;
     private $study;
     private $class;
     private $email;
     private $dateOfReg;

     public function __construct($firstName, $lastName, $dateOfBirth, $study, $class, $email)
     {
         $this -> firstName = $firstName;
         $this -> lastName = $lastName;
         $this -> dateOfBirth = $dateOfBirth;
         $this -> study = $study;
         $this->class = $class;
         $this->email = $email;
         $this->dateOfReg = date("Y/m/d");
     }

     public function getId(){
         return $this->id;
     }

     public function getClass(){
         return $this->class;
     }

     public function getDateOfBirth(){
         return $this->dateOfBirth;
     }

     public function getFirstName(){
         return $this->firstName;
     }

     public function getLastName(){
         return $this->lastName;
     }

     public function getStudy(){
         return $this->study;
     }

     public function getEmail(){
         return $this->email;
     }

     public function getDate(){
         return $this->dateOfReg;
     }


     public function setClass($class){
         $this->class = $class;
     }

     public function setDateOfBirth($dateOfBirth){
         $this->dateOfBirth = $dateOfBirth;
     }

     public function setFirstName($firstName){
         $this->firstName = $firstName;
     }

     public function setId($id){
         $this->id = $id;
     }

     public function setLastName($lastName){
         $this->lastName = $lastName;
     }

     public function setStudy($study){
         $this->study = $study;
     }

     public function setEmail($email){
         $this->email = $email;
     }

     public function setDate($dateOfReg){
         $this->dateOfReg = $dateOfReg;
     }

 }