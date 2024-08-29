<?php

$jsonRequestText = $_POST["jsonRequestText"];
$phpRequestObject = json_decode($jsonRequestText);

$mobile = $phpRequestObject->mobile;
$password = $phpRequestObject->password;

$connection = new mysqli("localhost","root","*vihanga123#Nethmini*@","react_chat");
$table = $connection->query("SELECT * FROM `user` WHERE `mobile`='".$mobile."' AND `password`='".$password."'");

$phpResponseObject = new stdClass();

if($table->num_rows==0){
    $phpResponseObject->msg = "Error";
}else{
    $phpResponseObject->msg = "Success";

    $row = $table->fetch_assoc();
    $phpResponseObject->user = $row;
}

$jsonResponseObjectText = json_encode($phpResponseObject);
echo($jsonResponseObjectText);
?>