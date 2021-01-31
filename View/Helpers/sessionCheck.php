<?php
session_start();

if(!isset($_SESSION['id'])){ //xhecks if session has been filled, if not send back to login screen
    header("location: index.php");
    exit;
}
?>