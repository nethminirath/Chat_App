<?php

$UserInfoId = $_POST["UserInfoId"];

$connection = new mysqli("localhost","root","*vihanga123#Nethmini*@","react_chat");
$table = $connection->query("SELECT * FROM `user` INNER JOIN 
`country` ON `user`.`country_id`=`country`.`id` WHERE `user`.`id`='".$UserInfoId."'");

$phpResponseObj = new stdClass();

for($x=0;$x<$table->num_rows;$x++){

    $row = $table->fetch_assoc();
    
    $phpResponseObj->mobile = $row["mobile"];
    $phpResponseObj->country = $row["name"];
    $phpResponseObj->about = $row["about"];
    
}

$json = json_encode($phpResponseObj);

echo($json);

?>