<?php
include 'init.php';

if(!empty($_POST['action']) && $_POST['action'] == 'listDepartment1') {
	$department1->listDepartment1();
}

if(!empty($_POST['action']) && $_POST['action'] == 'getDepartmentDetails1') {
	$department1->departmentId1 = $_POST["departmentId1"];
	$department1->getDepartmentDetails1();
}

if(!empty($_POST['action']) && $_POST['action'] == 'addDepartment1') {
	$department1->name = $_POST["name"];
	$department1->acc_num = $_POST["acc_num"];
	$department1->phone_num = $_POST["phone_num"];
	$department1->email = $_POST["email"];
	$department1->source_type = $_POST["source_type"];
	$department1->comments_lead = $_POST["comments_lead"];
	$department1->comments_lead1 = $_POST["comments_lead1"];

	$department1->cust_type = $_POST["cust_type"];
    $department1->status = $_POST["status"];    
	$department1->insert();
}

if(!empty($_POST['action']) && $_POST['action'] == 'updateDepartment1') {
	$department1->departmentId1 = $_POST["departmentId1"]; 
	$department1->name = $_POST["name"];
	$department1->acc_num = $_POST["acc_num"];
	$department1->phone_num = $_POST["phone_num"];
	$department1->email = $_POST["email"];
	$department1->source_type = $_POST["source_type"];
	$department1->comments_lead = $_POST["comments_lead"];
	$department1->comments_lead1 = $_POST["comments_lead1"];

	$department1->cust_type = $_POST["cust_type"];
    $department1->status = $_POST["status"]; 
	$department1->update();
}

if(!empty($_POST['action']) && $_POST['action'] == 'deleteDepartment1') {
	$department1->departmentId1 = $_POST["departmentId1"];
	$department1->delete();
}

?>