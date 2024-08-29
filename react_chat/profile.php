<?php

$user = $_POST["usJSONText"];
$userObject = json_decode($user);
$countryId = $userObject->country_id;

$connection = new mysqli("localhost","root","*vihanga123#Nethmini*@","react_chat");
$table = $connection->query("SELECT `name` FROM `country` WHERE `id`='".$countryId."'");

$Profile_array = array();

for($x=0;$x<$table->num_rows;$x++){

    $row = $table->fetch_assoc();
    array_push($Profile_array,$row["name"]);
}

$json = json_encode($Profile_array);

echo($json);


?>