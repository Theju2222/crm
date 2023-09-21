<?php

class Subtype extends Database {  
    
	private $subtypesTable = 'hd_subtype';
	
	private $dbConnect = false;
	public function __construct(){		
        $this->dbConnect = $this->dbConnect();
    } 
	public function listSubtype(){
			 			 
		$sqlQuery = "SELECT id, name, status
			FROM ".$this->subtypesTable;
			
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
		$subtypeData = array();	
		while( $subtype = mysqli_fetch_assoc($result) ) {		
			$subtypeRows = array();			
			$status = '';
			if($subtype['status'] == 1)	{
				$status = '<span class="label label-success">Enabled</span>';
			} else if($subtype['status'] == 0) {
				$status = '<span class="label label-danger">Disabled</span>';
			}	
			
			$subtypeRows[] = $subtype['id'];
			$subtypeRows[] = $subtype['name'];			
			$subtypeRows[] = $status;
				
			$subtypeRows[] = '<button type="button" name="update" id="'.$subtype["id"].'" class="btn btn-warning btn-xs update">Edit</button>';
			$subtypeRows[] = '<button type="button" name="delete" id="'.$subtype["id"].'" class="btn btn-danger btn-xs delete">Delete</button>';
			$subtypeData[] = $subtypeRows;
		}
		$output = array(
			"draw"				=>	intval($_POST["draw"]),
			"recordsTotal"  	=>  $numRows,
			"recordsFiltered" 	=> 	$numRows,
			"data"    			=> 	$subtypeData
		);
		echo json_encode($output);
	}	
	
		
	public function getSubtypeDetails(){		
		if($this->subtypeId) {		
			$sqlQuery = "
				SELECT id, name, status 
				FROM ".$this->subtypesTable." 
				WHERE id = '".$this->subtypeId."'";
			$result = mysqli_query($this->dbConnect, $sqlQuery);	
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			echo json_encode($row);
		}		
	}
	
	// public function insert() {      
	// 	if($this->subtype) {		              
	// 		$this->subtype = strip_tags($this->subtype);              
	// 		$queryInsert = "INSERT INTO ".$this->subtypesTable." (name, status) 
	// 		VALUES('".$this->subtype."', '".$this->status."')";			
	// 		mysqli_query($this->dbConnect, $queryInsert);			
	// 	}
	// }
	public function insert()
	{
		if ($this->subtype) {
			$queryInsert = "INSERT INTO ".$this->subtypesTable." (name, status) VALUES(?, ?)";
			$stmt = mysqli_prepare($this->dbConnect, $queryInsert);
			mysqli_stmt_bind_param($stmt, "si", $this->subtype, $this->status);
			mysqli_stmt_execute($stmt);
		}
	}
	public function update() {      
		if($this->subtypeId && $this->subtype) {		              
			$this->subtype = strip_tags($this->subtype);              
			$queryUpdate = "
				UPDATE ".$this->subtypesTable." 
				SET name = '".$this->subtype."', status = '".$this->status."' 
				WHERE id = '".$this->subtypeId."'";				
			mysqli_query($this->dbConnect, $queryUpdate);			
		}
	}	
	
	public function delete() {      
		if($this->subtypeId) {		          
			$queryUpdate = "
				DELETE FROM ".$this->subtypesTable." 
				WHERE id = '".$this->subtypeId."'";				
			mysqli_query($this->dbConnect, $queryUpdate);			
		}
	}
	
}