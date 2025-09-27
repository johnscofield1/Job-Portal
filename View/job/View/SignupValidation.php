<?php
require_once __DIR__ . '/../Model/db.php';

$fnameError="";
$lnameError="";
$idError="";
$phnError="";
$emailError="";
$passError="";
$genderError="";
$dobError = "";
$formValid = true;

if($_SERVER["REQUEST_METHOD"]=="POST"){ 
    // basic validation (kept simple)
    if(empty($_REQUEST["firstname"])){
      $fnameError="Invalid First Name";
      $formValid = false;
    }
    if(empty($_REQUEST["lastname"])) {
      $lnameError = "Invalid Last Name";
      $formValid = false;
    }
    if(empty($_REQUEST["email"])) {
      $emailError = "Invalid Email";
      $formValid = false;
    }
    if(empty($_REQUEST["password"])) {
      $passError = "Invalid Password";
      $formValid = false;
    }

    if ($formValid) {
        // For this project we will use email as username
        $username = $_REQUEST['email'];
        $email = $_REQUEST['email'];
        $password = $_REQUEST['password'];
        $role = 'jobseeker';

        $insert_id = insertData($username, $email, $password, $role);

        if ($insert_id !== false) {
            // registration successful - redirect to login
            header("Location: Login.php");
            exit();
        } else {
            $emailError = "Registration failed (maybe email/username already exists).";
        }
    }

}
?>