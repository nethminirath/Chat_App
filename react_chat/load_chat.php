<?php

$user1 = $_POST["id1"];
$user2 = $_POST["id2"];

$connection = new mysqli("localhost","root","*vihanga123#Nethmini*@","react_chat");
$table = $connection->query("SELECT * FROM `chat` INNER JOIN `status` ON `chat`.`status_id`=`status`.`id` WHERE
(`user_from_id`='".$user1."' AND `user_to_id`='".$user2."')
OR (`user_from_id`='".$user2."' AND `user_to_id`='".$user1."')
ORDER BY `date_time` ASC");

$chatArray = array();

for($x=0;$x<$table->num_rows;$x++){

    $row = $table->fetch_assoc();

    $chatObject = new stdClass();
    $chatObject->msg = $row["message"];

    $phpDateTimeObject = strtotime($row["date_time"]);
    $timeStr = date('h:i a',$phpDateTimeObject);
    $chatObject->time = $timeStr;

    if($row["user_from_id"]==$user1){
        $chatObject->side = "right";
    }else{
        $chatObject->side = "left";
    }

    $chatObject->status = strtolower($row["name"]);

    $chatArray[$x]=$chatObject;
}

$responseJSON = json_encode($chatArray);
echo($responseJSON);
?>