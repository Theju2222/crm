<?php
include 'init.php';

if(!empty($_POST['action']) && $_POST['action'] == 'listSubtype') {
	$subtype->listSubtype();
}

if(!empty($_POST['action']) && $_POST['action'] == 'getSubtypeDetails') {
	$subtype->subtypeId = $_POST["subtypeId"];
	$subtype->getSubtypeDetails();
}

if(!empty($_POST['action']) && $_POST['action'] == 'addSubtype') {
	$subtype->subtype = $_POST["subtype"];
    $subtype->status = $_POST["status"];    
	$subtype->insert();
}

if(!empty($_POST['action']) && $_POST['action'] == 'updateSubtype') {
	$subtype->subtypeId = $_POST["subtypeId"]; 
	$subtype->subtype = $_POST["subtype"];
    $subtype->status = $_POST["status"]; 
	$subtype->update();
}

if(!empty($_POST['action']) && $_POST['action'] == 'deleteSubtype') {
	$subtype->subtypeId = $_POST["subtypeId"];
	$subtype->delete();
}

?>