<?php

class Department1 extends Database {  
    
	private $departmentsTable1 = 'hd_leads';
	
	private $dbConnect = false;
	public function __construct(){		
        $this->dbConnect = $this->dbConnect();
    } 
	public function listDepartment1(){
			 			 
		$sqlQuery = "SELECT id, name,acc_num, phone_num, email,source_type,comments_lead, comments_lead1,  DATE_FORMAT(CONVERT_TZ(date2, '+00:00', '+02:00'), '%d-%m-%Y %H:%i:%s') as created_date, cust_type, status 
			FROM ".$this->departmentsTable1;
			
			if (!empty($_POST["search"]["value"])) {
				$sqlQuery .= ' WHERE (id LIKE "%'.$_POST["search"]["value"].'%" ';
				$sqlQuery .= ' OR name LIKE "%'.$_POST["search"]["value"].'%" ';
				$sqlQuery .= ' OR acc_num LIKE "%'.$_POST["search"]["value"].'%" ';
				$sqlQuery .= ' OR phone_num LIKE "%'.$_POST["search"]["value"].'%" ';
				$sqlQuery .= ' OR email LIKE "%'.$_POST["search"]["value"].'%" ';
				$sqlQuery .= ' OR source_type LIKE "%'.$_POST["search"]["value"].'%" ';
				$sqlQuery .= ' OR comments_lead LIKE "%'.$_POST["search"]["value"].'%" ';
				$sqlQuery .= ' OR comments_lead1 LIKE "%'.$_POST["search"]["value"].'%" ';

				$sqlQuery .= ' OR cust_type LIKE "%'.$_POST["search"]["value"].'%" ';
				$sqlQuery .= ' OR status LIKE "%'.$_POST["search"]["value"].'%")';
			}
			
		if(!empty($_POST["order"])){
			$sqlQuery .= ' ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
		} else {
			$sqlQuery .= ' ORDER BY id DESC ';
		}
		if($_POST["length"] != -1){
			$sqlQuery .= ' LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}	
		
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$numRows = mysqli_num_rows($result);
		$departmentData1 = array();	
		while( $department1 = mysqli_fetch_assoc($result) ) {		
			$departmentRows1 = array();			
			$status = '';
			if($department1['status'] == 1)	{
				$status = '<span class="label label-success">Enabled</span>';
			} else if($department1['status'] == 0) {
				$status = '<span class="label label-danger">Disabled</span>';
			}	
			$custRole = '';
			if($department1['cust_type'] == 'new')	{
				$custRole = '<span class="label label-warning">New</span>';
			} else if($department1['cust_type'] == 'existing') {
				$custRole = '<span class="label label-success">Existing</span>';
			}	
			$sourceRole = '';
			if ($department1['source_type'] == 'whatsapp') {
				$sourceRole = '<span class="label label-info">Whatsapp</span>';
			  } else if ($department1['source_type'] == 'facebook') {
				$sourceRole = '<span class="label label-info">Facebook</span>';
			  } else if ($department1['source_type'] == 'website') {
				$sourceRole = '<span class="label label-info">Website</span>';
			  } else if ($department1['source_type'] == 'call') {
				$sourceRole = '<span class="label label-info">Call</span>';
			  } else if ($department1['source_type'] == 'branch-walk-in') {
				$sourceRole = '<span class="label label-info">Branch Walk-In</span>';
			  } else if ($department1['source_type'] == 'email') {
				// Default option if neither "new" nor "existing" is matched
				$sourceRole = '<span class="label label-info">Email</span>';
			  }
			$departmentRows1[] = $department1['id'];
			$departmentRows1[] = $department1['acc_num'];
			$departmentRows1[] = $department1['name'];			
			$departmentRows1[] = $department1['phone_num'];			
			$departmentRows1[] = $department1['email'];			
			$departmentRows1[] = $sourceRole;			
			$departmentRows1[] = $department1['comments_lead'];			
			$departmentRows1[] = $department1['comments_lead1'];			

			$departmentRows1[] = $custRole;		
			$departmentRows1[] = $department1['created_date'];
			$departmentRows1[] = $status;
			$departmentRows1[] = '<button type="button" name="update" id="'.$department1["id"].'" class="btn btn-warning btn-xs update">Edit</button>';
			$departmentRows1[] = '<button type="button" name="delete" id="'.$department1["id"].'" class="btn btn-danger btn-xs delete">Delete</button>';
			$departmentData1[] = $departmentRows1;
		}
		$output = array(
			"draw"				=>	intval($_POST["draw"]),
			"recordsTotal"  	=>  $numRows,
			"recordsFiltered" 	=> 	$numRows,
			"data"    			=> 	$departmentData1
		);
		echo json_encode($output);
	}	
	
	public function getDepartment1Count() {
        // Prepare the SQL query
        $query = "SELECT COUNT(*) AS count FROM ".$this->departmentsTable1;
        
        // Execute the SQL query
        $result = mysqli_query($this->dbConnect, $query);
        
        // Fetch the count from the result
        $row = mysqli_fetch_assoc($result);
        $count = $row['count'];
        
        // Return the count
        return $count;
    }	
	public function getDepartmentDetails1(){		
		if($this->departmentId1) {		
			$sqlQuery = "
				SELECT id, name, acc_num, phone_num, email, source_type, comments_lead, comments_lead1, cust_type, status 
				FROM ".$this->departmentsTable1." 
				WHERE id = '".$this->departmentId1."'";
			$result = mysqli_query($this->dbConnect, $sqlQuery);	
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			echo json_encode($row);
		}		
	}
	
	// public function insert() {      
	// 	if($this->department1) {		              
	// 		$this->department1 = strip_tags($this->department1);              
	// 		$queryInsert = "INSERT INTO ".$this->departmentsTable1." (name, acc_num, phone_num, email,cust_type, status) 
	// 		VALUES('".$this->department1."', '".$this->acc_num."', '".$this->phone_num."', '".$this->email."', '".$this->cust_type."', '".$this->status."')";			
	// 		mysqli_query($this->dbConnect, $queryInsert);			
	// 	}
	// }
	public function insert()
	{
			$queryInsert = "INSERT INTO " . $this->departmentsTable1 . " (name, acc_num, phone_num, email, source_type, comments_lead,  comments_lead1, cust_type, status) 
				VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
			$stmt = mysqli_prepare($this->dbConnect, $queryInsert);
			mysqli_stmt_bind_param($stmt, "sssssssss", $this->name, $this->acc_num, $this->phone_num, $this->email, $this->source_type, $this->comments_lead, $this->comments_lead1, $this->cust_type, $this->status);
			mysqli_stmt_execute($stmt);
	}

	public function update() {      
			$queryUpdate = "
				UPDATE ".$this->departmentsTable1." 
				SET name = '".$this->name."',  acc_num = '".$this->acc_num."', phone_num = '".$this->phone_num."', email = '".$this->email."', source_type = '".$this->source_type."', comments_lead = '".$this->comments_lead."', comments_lead1 = '".$this->comments_lead1."', cust_type = '".$this->cust_type."', status = '".$this->status."'
				WHERE id = '".$this->departmentId1."'";				
			mysqli_query($this->dbConnect, $queryUpdate);			
	}	
	
	public function delete() {      
		if($this->departmentId1) {		          
			$queryUpdate = "
				DELETE FROM ".$this->departmentsTable1." 
				WHERE id = '".$this->departmentId1."'";				
			mysqli_query($this->dbConnect, $queryUpdate);			
		}
	}
	
}