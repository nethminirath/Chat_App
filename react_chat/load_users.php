<?php

$userJSONText = $_POST["userJSONText"];
$userPHPObject = json_decode($userJSONText);

$connection = new mysqli("localhost", "root", "*vihanga123#Nethmini*@", "react_chat");
//$table = $connection->query("SELECT * FROM `user` WHERE `id`!='" . $userPHPObject->id . "'");
$table = $connection->query("SELECT * FROM `user` WHERE `id`!='" . $userPHPObject->id . "' AND `name` LIKE'".$_POST["text"]."%'");

$phpResponseArray = array();

for ($x = 0; $x < $table->num_rows; $x++) {

    $phpArrayItemObject = new stdClass();

    $user = $table->fetch_assoc();
    $phpArrayItemObject->pic = $user["profile_url"];
    $phpArrayItemObject->name = $user["name"];
    $phpArrayItemObject->id = $user["id"];

    $table2 = $connection->query("SELECT * FROM `chat` WHERE 
    `user_from_id` = '" . $userPHPObject->id . "' AND `user_to_id`='" . $user["id"] . "' OR
     `user_from_id` = '" . $user["id"] . "' AND `user_to_id`='" . $userPHPObject->id . "' 
     ORDER BY `date_time` DESC");

    if ($table2->num_rows == 0) {
        $phpArrayItemObject->msg = "";
        $phpArrayItemObject->time = "";
        $phpArrayItemObject->count = "0";
    } else{

        //unseen chat count
        $unseenChatCount = 0;

        //first row
        $lastChatRow = $table2->fetch_assoc();

        if($lastChatRow["status_id"]==1){
            $unseenChatCount++;
        }

        $phpArrayItemObject->msg = $lastChatRow["message"];

        $phpTimeObject = strtotime($lastChatRow["date_time"]);
        $timeStr = date("h:i a",$phpTimeObject);

        $phpArrayItemObject->time = $timeStr;

        for($i=0;$i<$table2->num_rows;$i++){

            //other rows
            $newChatRow = $table2->fetch_assoc();

            if($lastChatRow["status_id"]==1){
                $unseenChatCount++;
            }
        }

        $phpArrayItemObject->count = $unseenChatCount;
    }

    array_push($phpResponseArray,$phpArrayItemObject);
}

$jsonRequestText = json_encode($phpResponseArray);
echo($jsonRequestText);

?>