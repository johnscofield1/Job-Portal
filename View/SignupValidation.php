<?php

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
    if(empty($_REQUEST["firstname"])){
      $fnameError="Invalid First Name";
      $formValid = false;
    }

if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(empty($_REQUEST["lastname"])){
      $lnameError="Invalid Last Name";
      $formValid = false;
    }
}
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(empty($_REQUEST["id"])){
      $idError="ID Required";
      $formValid = false;
    }
}
     if (empty($_REQUEST["email"])) {
        $emailError = "Email is required";
        $formValid = false;
     
    } else if (!filter_var($_REQUEST["email"], FILTER_VALIDATE_EMAIL)) {
        $emailError = "Invalid Email Format";
        $formValid = false;
       
    }

if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(empty($_REQUEST["phone"])){
      $phnError="Invalid Phone Number";
      $formValid = false;
    }
}
    if (empty($_REQUEST["password"])) {
    $passError = "Password is required";
    $formValid = false;
   
      } else if (strlen($_REQUEST["password"]) < 6) {
       $passError = "Password must be at least 6 characters long";
       $formValid = false;
      
      }
      if (!isset($_REQUEST["gender"])) {
          $genderError = "Gender is required";
          $formValid = false;
          
      } else {
          $gender = $_REQUEST["gender"];
      }
          if (empty($_REQUEST["dob"])) {
        $dobError = "Date of Birth is required";
        $formValid = false;
    } else {
        $dob = $_REQUEST["dob"];
        $today = date("Y-m-d");
        if ($dob >= $today) {
            $dobError = "DOB cannot be today or in the future";
            $formValid = false;
        }
    }
        if ($formValid) {
        header("Location: login.php");
        exit();
    }

}


?>