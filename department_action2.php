<?php
include 'init.php';

if(!empty($_POST['action']) && $_POST['action'] == 'listDepartment2') {
	$department2->listDepartment2();
}

if(!empty($_POST['action']) && $_POST['action'] == 'getDepartmentDetails2') {
	$department2->departmentId2 = $_POST["departmentId2"];
	$department2->getDepartmentDetails2();
}

if(!empty($_POST['action']) && $_POST['action'] == 'addDepartment2') {
	$department2->name1 = $_POST["name1"];
	$department2->acc_num1 = $_POST["acc_num1"];
	$department2->nrc = $_POST["nrc"];
	$department2->phone_num1 = $_POST["phone_num1"];
	$department2->email1 = $_POST["email1"];
    $department2->status = $_POST["status"];    
	$department2->insert();
}

if(!empty($_POST['action']) && $_POST['action'] == 'updateDepartment2') {
	$department2->departmentId2 = $_POST["departmentId2"]; 
	$department2->name1 = $_POST["name1"];
	$department2->acc_num1 = $_POST["acc_num1"];
	$department2->nrc = $_POST["nrc"];
	$department2->phone_num1 = $_POST["phone_num1"];
	$department2->email1 = $_POST["email1"];
    $department2->status = $_POST["status"]; 
	$department2->update();
}

if(!empty($_POST['action']) && $_POST['action'] == 'deleteDepartment2') {
	$department2->departmentId2 = $_POST["departmentId2"];
	$department2->delete();
}

?>