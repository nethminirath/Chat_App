<?php

$array = array();

$object1 = new stdClass();
$object1->id = "1";
$object1->name = "C#";
array_push($array,$object1);

$object2 = new stdClass();
$object2->id = "2";
$object2->name = "Objective-C";
array_push($array,$object2);

echo(json_encode($array));

?>