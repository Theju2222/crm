<?php

class Department2 extends Database {  
    
    private $ticketTable = 'hd_tickets';
	private $ticketRepliesTable = 'hd_ticket_replies';
	private $departmentsTable = 'hd_departments';
	private $typesTable = 'hd_type';
	private $subtypesTable = 'hd_subtype';
	private $departmentsTable2 = 'hd_profile';
	
	private $dbConnect = false;
	public function __construct(){		
        $this->dbConnect = $this->dbConnect();
    } 
	public function listDepartment2(){
		$time = new time;  		 
		$sqlQuery = "SELECT p.id, p.name1, t.id as tid,t.uniqidd as sdss, p.acc_num1, p.nrc, p.phone_num1, DATE_FORMAT(CONVERT_TZ(p.date1, '+00:00', '+02:00'), '%d-%m-%Y %H:%i:%s') as created_date, p.email1, p.tickett, p.status, t.title as sdss1, t.title1 as sdss2, t.title2 as sdss3, t.date as sdss4, t.last_reply as sdss5, t.resolved as sdss6, t.resolvedtype as sdss7, u.name as creater, u.branch as createrbranch, u.report_manager as creatermanager, d.name as department,r.text as replyy, m.text1 as replyy1, b.text2 as replyy2, c.text3 as replyy3, a.name as type, s.name as subtype, u.user_type as sdss8, t.user as sdss9, t.user_read as sdss10, t.admin_read as sdss11
	 
		FROM ".$this->departmentsTable2." p
			LEFT JOIN hd_tickets t ON p.id = t.profile
			LEFT JOIN hd_users u ON t.user = u.id 
			LEFT JOIN hd_departments d ON t.department = d.id
			LEFT JOIN hd_type a ON t.type = a.id
			LEFT JOIN hd_ticket_replies r ON t.id = r.ticket_id
			LEFT JOIN hd_ticket_replies1 m ON t.id = m.ticket_id1
			LEFT JOIN hd_ticket_replies2 b ON t.id = b.ticket_id2
			LEFT JOIN hd_ticket_replies3 c ON t.id = c.ticket_id3
			LEFT JOIN hd_subtype s ON t.subtype = s.id";
			

		if (!empty($_POST["search"]["value"])) {
			$sqlQuery .= ' WHERE (p.id LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR p.name1 LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR p.acc_num1 LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR p.nrc LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR p.phone_num1 LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR p.email1 LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR p.status LIKE "%'.$_POST["search"]["value"].'%")';
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
		$departmentData2 = array();	
		while( $department2 = mysqli_fetch_assoc($result) ) {		
			$departmentRows2 = array();			
		
	
			
	
			$status = '';
			if($department2['status'] == 1)	{
				$status = '<span class="label label-success">Active</span>';
			} else if($department2['status'] == 0) {
				$status = '<span class="label label-danger">Inactive</span>';
			}	
			
			$departmentRows2[] = $department2['id'];
			$departmentRows2[] = $department2['acc_num1'];

			$departmentRows2[] = $department2['name1'];		
			$departmentRows2[] = $department2['nrc'];
			$departmentRows2[] = $department2['phone_num1'];			
			$departmentRows2[] = $department2['email1'];			
            $departmentRows2[] = $department2['created_date'];
			$departmentRows2[] = $status;
			$departmentRows2[] = '<a href="view_profile.php?id='.$department2["id"].'" class="btn btn-success btn-xs update">View Profile</a>';	
				
			$departmentRows2[] = '<button type="button" name="update" id="'.$department2["id"].'" class="btn btn-warning btn-xs update">Edit</button>';
			$departmentRows2[] = '<button type="button" name="delete" id="'.$department2["id"].'" class="btn btn-danger btn-xs delete">Delete</button>';
			$departmentData2[] = $departmentRows2;
		}
		$output = array(
			"draw"				=>	intval($_POST["draw"]),
			"recordsTotal"  	=>  $numRows,
			"recordsFiltered" 	=> 	$numRows,
			"data"    			=> 	$departmentData2
		);
		echo json_encode($output);
	}	
	public function getDepartment2Count() {
        // Prepare the SQL query
        $query = "SELECT COUNT(*) AS count FROM ".$this->departmentsTable2;
        
        // Execute the SQL query
        $result = mysqli_query($this->dbConnect, $query);
        
        // Fetch the count from the result
        $row = mysqli_fetch_assoc($result);
        $count = $row['count'];
        
        // Return the count
        return $count;
    }
	
	public function getDepartmentId() {
        return $this->departmentId2;
    }
    
    public function getDepartmentInfo($id) {
		$sqlQuery = "
		SELECT p.id, t.uniqidd as sdss, t.id as tid, p.name1, p.acc_num1, p.nrc, p.phone_num1, p.email1, p.status, t.title as sdss1, t.title1 as sdss2, t.title2 as sdss3, t.date as sdss4, t.last_reply as sdss5, t.resolved as sdss6, t.resolvedtype as sdss7, u.name as creater, u.branch as createrbranch, u.report_manager as creatermanager, d.name as department,r.text as replyy, m.text1 as replyy1, b.text2 as replyy2, c.text3 as replyy3, a.name as type, s.name as subtype, u.user_type as sdss8, t.user as sdss9, t.user_read as sdss10, t.admin_read as sdss11
		FROM " . $this->departmentsTable2 . " p
		LEFT JOIN hd_tickets t ON p.id = t.profile
		LEFT JOIN hd_users u ON t.user = u.id 
		LEFT JOIN hd_departments d ON t.department = d.id
		LEFT JOIN hd_type a ON t.type = a.id
		LEFT JOIN hd_ticket_replies r ON t.id = r.ticket_id
		LEFT JOIN hd_subtype s ON t.subtype = s.id
		LEFT JOIN hd_ticket_replies1 m ON t.id = m.ticket_id1
		LEFT JOIN hd_ticket_replies2 b ON t.id = b.ticket_id2
		LEFT JOIN hd_ticket_replies3 c ON t.id = c.ticket_id3


            WHERE p.id = '".$id."'";
        $result = mysqli_query($this->dbConnect, $sqlQuery);
        $department2 = mysqli_fetch_assoc($result);
        
        // Set the departmentId2 property with the fetched ID
        $this->departmentId2 = $department2['id'];
        
        return $department2;
    } 
	public function getDepartmentDetails2(){		
		if($this->departmentId2) {		
			$sqlQuery = "
			SELECT p.id, t.uniqidd as sdss, t.id as tid, p.name1, p.acc_num1, p.nrc, p.phone_num1, p.email1, p.status, t.title as sdss1, t.title1 as sdss2, t.title2 as sdss3, t.date as sdss4, t.last_reply as sdss5, t.resolved as sdss6, t.resolvedtype as sdss7, u.name as creater, u.branch as createrbranch, u.report_manager as creatermanager, d.name as department,r.text as replyy, m.text1 as replyy1, b.text2 as replyy2, c.text3 as replyy3, a.name as type, s.name as subtype, u.user_type as sdss8, t.user as sdss9, t.user_read as sdss10, t.admin_read as sdss11
			FROM " . $this->departmentsTable2 . " p
			LEFT JOIN hd_tickets t ON p.id = t.profile
			LEFT JOIN hd_users u ON t.user = u.id 
			LEFT JOIN hd_departments d ON t.department = d.id
			LEFT JOIN hd_type a ON t.type = a.id
			LEFT JOIN hd_ticket_replies r ON t.id = r.ticket_id
			LEFT JOIN hd_ticket_replies1 m ON t.id = m.ticket_id1
			LEFT JOIN hd_ticket_replies2 b ON t.id = b.ticket_id2
			LEFT JOIN hd_ticket_replies3 c ON t.id = c.ticket_id3

			LEFT JOIN hd_subtype s ON t.subtype = s.id
				WHERE p.id = '".$this->departmentId2."'";
			$result = mysqli_query($this->dbConnect, $sqlQuery);	
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			echo json_encode($row);
		}		
	}

	
	// public function insert() {      
	// 	if($this->department2) {		              
	// 		$this->department2 = strip_tags($this->department2);              
	// 		$queryInsert = "INSERT INTO ".$this->departmentsTable2." (name1, acc_num1, nrc, phone_num1, email1, status) 
	// 		VALUES('".$this->department2."', '".$this->acc_num1."',  '".$this->nrc."', '".$this->phone_num1."', '".$this->email1."', '".$this->status."')";			
	// 		mysqli_query($this->dbConnect, $queryInsert);			
	// 	}
	// }
	public function insert()
	{
			$queryInsert = "INSERT INTO " . $this->departmentsTable2 . " (name1, acc_num1, nrc, phone_num1, email1, status) 
				VALUES (?, ?, ?, ?, ?, ?)";
			$stmt = mysqli_prepare($this->dbConnect, $queryInsert);
			mysqli_stmt_bind_param($stmt, "ssssss", $this->name1, $this->acc_num1,  $this->nrc, $this->phone_num1, $this->email1, $this->status);
			mysqli_stmt_execute($stmt);
	}

	public function update() {      
			$queryUpdate = "
				UPDATE ".$this->departmentsTable2." 
				SET name1 = '".$this->name1."',  acc_num1 = '".$this->acc_num1."',  nrc = '".$this->nrc."', phone_num1 = '".$this->phone_num1."', email1 = '".$this->email1."', status = '".$this->status."'
				WHERE id = '".$this->departmentId2."'";				
			mysqli_query($this->dbConnect, $queryUpdate);			
	}	
	
	public function delete() {      
		if($this->departmentId2) {		          
			$queryUpdate = "
				DELETE FROM ".$this->departmentsTable2." 
				WHERE id = '".$this->departmentId2."'";				
			mysqli_query($this->dbConnect, $queryUpdate);			
		}
	}
	
}