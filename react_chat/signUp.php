<?php

$mobile = $_POST["mobile"];
$name = $_POST["name"];
$password = $_POST["password"];
$verifyPassword = $_POST["verifyPassword"];
$about = $_POST["about"];
$country = $_POST["country"];
$profile_picture_location = $_FILES["profile_picture"]["tmp_name"];

$connection = new mysqli("localhost","root","*vihanga123#Nethmini*@","react_chat");

$table = $connection->query("SELECT `id` FROM `country` WHERE `name`='".$country."'");
$row = $table->fetch_assoc();
$country_id = $row["id"];


$connection->query("INSERT INTO `user`(`mobile`,`name`,`password`,`about`,`profile_url`,`country_id`) 
VALUES('".$mobile."','".$name."','".$password."','".$about."','"."uploads/".$mobile.".png"."','".$country_id."')");

move_uploaded_file($profile_picture_location,"uploads/".$mobile.".png");

echo("Successfully Uploaded");

?>