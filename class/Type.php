<?php

class Type extends Database {  
    
	private $typesTable = 'hd_type';
	
	private $dbConnect = false;
	public function __construct(){		
        $this->dbConnect = $this->dbConnect();
    } 
	public function listType(){
			 			 
		$sqlQuery = "SELECT id, name, status
			FROM ".$this->typesTable;
			
		if(!empty($_POST["search"]["value"])){
			$sqlQuery .= ' (id LIKE "%'.$_POST["search"]["value"].'%" ';					
			$sqlQuery .= ' OR name LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR status LIKE "%'.$_POST["search"]["value"].'%" ';					
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
		$typeData = array();	
		while( $type = mysqli_fetch_assoc($result) ) {		
			$typeRows = array();			
			$status = '';
			if($type['status'] == 1)	{
				$status = '<span class="label label-success">Enabled</span>';
			} else if($type['status'] == 0) {
				$status = '<span class="label label-danger">Disabled</span>';
			}	
			
			$typeRows[] = $type['id'];
			$typeRows[] = $type['name'];			
			$typeRows[] = $status;
				
			$typeRows[] = '<button type="button" name="update" id="'.$type["id"].'" class="btn btn-warning btn-xs update">Edit</button>';
			$typeRows[] = '<button type="button" name="delete" id="'.$type["id"].'" class="btn btn-danger btn-xs delete">Delete</button>';
			$typeData[] = $typeRows;
		}
		$output = array(
			"draw"				=>	intval($_POST["draw"]),
			"recordsTotal"  	=>  $numRows,
			"recordsFiltered" 	=> 	$numRows,
			"data"    			=> 	$typeData
		);
		echo json_encode($output);
	}	
	
		
	public function getTypeDetails(){		
		if($this->typeId) {		
			$sqlQuery = "
				SELECT id, name, status 
				FROM ".$this->typesTable." 
				WHERE id = '".$this->typeId."'";
			$result = mysqli_query($this->dbConnect, $sqlQuery);	
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			echo json_encode($row);
		}		
	}
	
	// public function insert() {      
	// 	if($this->type) {		              
	// 		$this->type = strip_tags($this->type);              
	// 		$queryInsert = "INSERT INTO ".$this->typesTable." (name, status) 
	// 		VALUES('".$this->type."', '".$this->status."')";			
	// 		mysqli_query($this->dbConnect, $queryInsert);			
	// 	}
	// }
	public function insert()
	{
		if ($this->type) {
			$queryInsert = "INSERT INTO " . $this->typesTable . " (name, status) VALUES (?, ?)";
			$stmt = mysqli_prepare($this->dbConnect, $queryInsert);
			mysqli_stmt_bind_param($stmt, "ss", $this->type, $this->status);
			mysqli_stmt_execute($stmt);
		}
	}

	public function update() {      
		if($this->typeId && $this->type) {		              
			$this->type = strip_tags($this->type);              
			$queryUpdate = "
				UPDATE ".$this->typesTable." 
				SET name = '".$this->type."', status = '".$this->status."' 
				WHERE id = '".$this->typeId."'";				
			mysqli_query($this->dbConnect, $queryUpdate);			
		}
	}	
	
	public function delete() {      
		if($this->typeId) {		          
			$queryUpdate = "
				DELETE FROM ".$this->typesTable." 
				WHERE id = '".$this->typeId."'";				
			mysqli_query($this->dbConnect, $queryUpdate);			
		}
	}
	
}