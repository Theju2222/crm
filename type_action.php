<?php
include 'init.php';

if(!empty($_POST['action']) && $_POST['action'] == 'listType') {
	$type->listType();
}

if(!empty($_POST['action']) && $_POST['action'] == 'getTypeDetails') {
	$type->typeId = $_POST["typeId"];
	$type->getTypeDetails();
}

if(!empty($_POST['action']) && $_POST['action'] == 'addType') {
	$type->type = $_POST["type"];
    $type->status = $_POST["status"];    
	$type->insert();
}

if(!empty($_POST['action']) && $_POST['action'] == 'updateType') {
	$type->typeId = $_POST["typeId"]; 
	$type->type = $_POST["type"];
    $type->status = $_POST["status"]; 
	$type->update();
}

if(!empty($_POST['action']) && $_POST['action'] == 'deleteType') {
	$type->typeId = $_POST["typeId"];
	$type->delete();
}

?>