<?php

class Tickets extends Database {  
    private $ticketTable = 'hd_tickets';
	private $ticketRepliesTable = 'hd_ticket_replies';
	private $ticketRepliesTable1 = 'hd_ticket_replies1';
	private $ticketRepliesTable2 = 'hd_ticket_replies2';
	private $ticketRepliesTable3 = 'hd_ticket_replies3';



	private $departmentsTable = 'hd_departments';
	private $typesTable = 'hd_type';
	private $subtypesTable = 'hd_subtype';
	private $departmentsTable2 = 'hd_profile';


	private $dbConnect = false;
	public function __construct(){		
        $this->dbConnect = $this->dbConnect();
    } 
	public function showTickets(){
		$sqlWhere = '';
			if ( !empty($_POST["search"]["value"])) {
				$sqlWhere .= " WHERE ";
			}
				
			$time = new time;  			 
			$sqlQuery = "SELECT t.id, t.uniqidd, t.title, t.title1, t.title2, t.date, t.last_reply, t.resolved, t.resolvedtype, u.name as creater, u.branch as createrbranch, u.report_manager as creatermanager, d.name as department,r.text as replyy, m.text1 as replyy1,  b.text2 as replyy2, c.text3 as replyy3, a.name as type, s.name as subtype, p.name1 as profilename,p.acc_num1 as profilename1,p.phone_num1 as profilename2,p.email1 as profilename3,p.nrc as profilename4, u.user_type, t.user, t.user_read, t.admin_read
			FROM hd_tickets t 
			LEFT JOIN hd_users u ON t.user = u.id 
			LEFT JOIN hd_departments d ON t.department = d.id
			LEFT JOIN hd_type a ON t.type = a.id
			LEFT JOIN hd_profile p ON t.profile = p.id
			LEFT JOIN hd_ticket_replies r ON t.id = r.ticket_id
			LEFT JOIN hd_ticket_replies1 m ON t.id = m.ticket_id1
			LEFT JOIN hd_ticket_replies2 b ON t.id = b.ticket_id2
			LEFT JOIN hd_ticket_replies3 c ON t.id = c.ticket_id3
			LEFT JOIN hd_subtype s ON t.subtype = s.id $sqlWhere ";

		if (!empty($_POST["search"]["value"])) {
			$sqlQuery .= ' (t.uniqidd LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR t.title LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR t.title1 LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR t.title2 LIKE "%'.$_POST["search"]["value"].'%" ';

			$sqlQuery .= ' OR p.acc_num1 LIKE "%'.$_POST["search"]["value"].'%" ';		
            $sqlQuery .= ' OR p.name1 LIKE "%'.$_POST["search"]["value"].'%" ';	
			$sqlQuery .= ' OR p.phone_num1 LIKE "%'.$_POST["search"]["value"].'%" ';	
			$sqlQuery .= ' OR p.nrc LIKE "%'.$_POST["search"]["value"].'%" ';	
			$sqlQuery .= ' OR d.name LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR a.name LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR s.name LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR t.resolved LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR t.resolvedtype LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR t.last_reply LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR u.name LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR u.branch LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR u.report_manager LIKE "%'.$_POST["search"]["value"].'%") ';
			
		
			
		}
			
		if(!empty($_POST["order"])){
			$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
		} else {
			$sqlQuery .= 'ORDER BY t.id DESC ';
		}
		if($_POST["length"] != -1){
			$sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}	
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$numRows = mysqli_num_rows($result);
		$ticketData = array();	
		while( $ticket = mysqli_fetch_assoc($result) ) {		

			$ticketRows = array();			
			$status1 = '';
			if($ticket['resolvedtype'] == 0)	{
				$status1 = '<span class="label label-info">Query</span>';
			} else if($ticket['resolvedtype'] == 1) {
				$status1 = '<span class="label label-info">Complaint</span>';			
			} else if($ticket['resolvedtype'] == 2) {
				$status1 = '<span class="label label-info">Request</span>';
			}	
			$status = '';
			if($ticket['resolved'] == 0)	{
				$status = '<span class="label label-success">Open</span>';
			} else if($ticket['resolved'] == 3) {
				$status = '<span class="label label-primary">In Progress</span>';
			} else if($ticket['resolved'] == 2) {
				$status = '<span class="label label-warning">Escaltion</span>';
			
			} else if($ticket['resolved'] == 1) {
				$status = '<span class="label label-danger">Closed</span>';
			}	
			$title = $ticket['title'];
			if((isset($_SESSION["admin"]) && !$ticket['admin_read'] && $ticket['last_reply'] != $_SESSION["userid"]) || (!isset($_SESSION["admin"]) && !$ticket['user_read'] && $ticket['last_reply'] != $ticket['user'])) {
				$title = $this->getRepliedTitle($ticket['title']);			
			}

			$title1 = $ticket['title1'];
			$title2 = $ticket['title2'];


			$disbaled = '';
			if (!isset($_SESSION["admin"]) && !isset($_SESSION["superadmin"])) {
				$disbaled = 'disabled';
			}			

			$ticketRows[] = $ticket['uniqidd'];
			$ticketRows[] = $ticket['profilename1'];
			$ticketRows[] = $ticket['profilename'];
			$ticketRows[] = $ticket['profilename2'];
			$ticketRows[] = $ticket['profilename4'];
		
			$ticketRows[] = $ticket['department'];
			$ticketRows[] = $ticket['type'];
			$ticketRows[] = $ticket['subtype'];
		    $ticketRows[] = $title . $ticket['replyy2'] . '<br><a href="view_comments.php?id='.$ticket["uniqidd"].'" class="btn btn-primary active btn-xs update">View All Remarks</a> ';
			$ticketRows[] = $title1 . $ticket['replyy'];
			$ticketRows[] = $title2 . $ticket['replyy1'];
			$ticketRows[] = $ticket['replyy3'];

			$ticketRows[] = $ticket['creater']; 
			$ticketRows[] = $ticket['createrbranch']; 			
			$ticketRows[] = $ticket['creatermanager']; 			
			$ticketRows[] = $time->ago($ticket['date']);
			$ticketRows[] = $status1;
			$ticketRows[] = $status;

			$ticketRows[] = '<a href="view_ticket.php?id='.$ticket["uniqidd"].'" class="btn btn-success btn-xs update">View Ticket</a>';	
			$ticketRows[] = '<button type="button" name="update" id="'.$ticket["id"].'" class="btn btn-warning btn-xs update" '.$disbaled.'>Edit</button>';
			$ticketRows[] = '<button type="button" name="open" id="'.$ticket["id"].'" class="btn btn-success btn-xs open" '.$disbaled.'>Re-Open</button>';
			$ticketRows[] = '<button type="button" name="delete" id="'.$ticket["id"].'" class="btn btn-danger btn-xs delete"  '.$disbaled.'>Close</button>';
			$ticketData[] = $ticketRows;
		}
		$output = array(
			"draw"				=>	intval($_POST["draw"]),
			"recordsTotal"  	=>  $numRows,
			"recordsFiltered" 	=> 	$numRows,
			"data"    			=> 	$ticketData
		);
		echo json_encode($output);
	}	
	public function showTickets2(){
		$sqlWhere = '';
			if ( !empty($_POST["search"]["value"])) {
				$sqlWhere .= " WHERE ";
			}
				
			$time = new time;  			 
			$sqlQuery = "SELECT t.id, t.uniqidd, t.title, t.title1, t.title2, t.date, t.last_reply, t.resolved, t.resolvedtype, u.name as creater, u.branch as createrbranch, u.report_manager as creatermanager, d.name as department,r.text as replyy, m.text1 as replyy1,  b.text2 as replyy2, c.text3 as replyy3, a.name as type, s.name as subtype, p.name1 as profilename,p.acc_num1 as profilename1,p.phone_num1 as profilename2,p.email1 as profilename3,p.nrc as profilename4, u.user_type, t.user, t.user_read, t.admin_read
			FROM hd_tickets t 
			LEFT JOIN hd_users u ON t.user = u.id 
			LEFT JOIN hd_departments d ON t.department = d.id
			LEFT JOIN hd_type a ON t.type = a.id
			LEFT JOIN hd_profile p ON t.profile = p.id
			LEFT JOIN hd_ticket_replies r ON t.id = r.ticket_id
			LEFT JOIN hd_ticket_replies1 m ON t.id = m.ticket_id1
			LEFT JOIN hd_ticket_replies2 b ON t.id = b.ticket_id2
			LEFT JOIN hd_ticket_replies3 c ON t.id = c.ticket_id3

			LEFT JOIN hd_subtype s ON t.subtype = s.id $sqlWhere ";

		if (!empty($_POST["search"]["value"])) {
			$sqlQuery .= ' (t.uniqidd LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR t.title LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR t.title1 LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR t.title2 LIKE "%'.$_POST["search"]["value"].'%" ';

			$sqlQuery .= ' OR p.acc_num1 LIKE "%'.$_POST["search"]["value"].'%" ';		
            $sqlQuery .= ' OR p.name1 LIKE "%'.$_POST["search"]["value"].'%" ';	
			$sqlQuery .= ' OR p.phone_num1 LIKE "%'.$_POST["search"]["value"].'%" ';	
			$sqlQuery .= ' OR p.nrc LIKE "%'.$_POST["search"]["value"].'%" ';	
			$sqlQuery .= ' OR d.name LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR a.name LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR s.name LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR t.resolved LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR t.resolvedtype LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR t.last_reply LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR u.name LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR u.branch LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR u.report_manager LIKE "%'.$_POST["search"]["value"].'%") ';
			
		
			
		}
			
		if(!empty($_POST["order"])){
			$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
		} else {
			$sqlQuery .= 'ORDER BY t.id DESC ';
		}
		if($_POST["length"] != -1){
			$sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}	
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$numRows = mysqli_num_rows($result);
		$ticketData = array();	
		while( $ticket = mysqli_fetch_assoc($result) ) {		
			if ($ticket['resolved'] != 2) {
				continue;
			}	
			$ticketRows = array();			
			$status1 = '';
			if($ticket['resolvedtype'] == 0)	{
				$status1 = '<span class="label label-info">Query</span>';
			} else if($ticket['resolvedtype'] == 1) {
				$status1 = '<span class="label label-info">Complaint</span>';			
			} else if($ticket['resolvedtype'] == 2) {
				$status1 = '<span class="label label-info">Request</span>';
			}	
			$status = '';
			if($ticket['resolved'] == 0)	{
				$status = '<span class="label label-success">Open</span>';
			} else if($ticket['resolved'] == 3) {
				$status = '<span class="label label-primary">In Progress</span>';
			} else if($ticket['resolved'] == 2) {
				$status = '<span class="label label-warning">Escaltion</span>';
			
			} else if($ticket['resolved'] == 1) {
				$status = '<span class="label label-danger">Closed</span>';
			}	
			$title = $ticket['title'];
			if((isset($_SESSION["admin"]) && !$ticket['admin_read'] && $ticket['last_reply'] != $_SESSION["userid"]) || (!isset($_SESSION["admin"]) && !$ticket['user_read'] && $ticket['last_reply'] != $ticket['user'])) {
				$title = $this->getRepliedTitle($ticket['title']);			
			}

			$title1 = $ticket['title1'];
			$title2 = $ticket['title2'];


			$disbaled = '';
			if (!isset($_SESSION["superadmin"])) {
				$disbaled = 'disabled';
			}			

			$ticketRows[] = $ticket['uniqidd'];
			$ticketRows[] = $ticket['profilename1'];
			$ticketRows[] = $ticket['profilename'];
			$ticketRows[] = $ticket['profilename2'];
			$ticketRows[] = $ticket['profilename4'];
		
			$ticketRows[] = $ticket['department'];
			$ticketRows[] = $ticket['type'];
			$ticketRows[] = $ticket['subtype'];
		    $ticketRows[] = $title . $ticket['replyy2'] . '<br><a href="view_comments.php?id='.$ticket["uniqidd"].'" class="btn btn-primary active btn-xs update">View All Remarks</a> ';
			$ticketRows[] = $title1 . $ticket['replyy'];
			$ticketRows[] = $title2 . $ticket['replyy1'];
			$ticketRows[] = $ticket['replyy3'];
			$ticketRows[] = $ticket['creater']; 
			$ticketRows[] = $ticket['createrbranch']; 			
			$ticketRows[] = $ticket['creatermanager']; 			
			$ticketRows[] = $time->ago($ticket['date']);
			$ticketRows[] = $status1;
			$ticketRows[] = $status;

			$ticketRows[] = '<a href="view_ticket.php?id='.$ticket["uniqidd"].'" class="btn btn-success btn-xs update">View Ticket</a>';	
			$ticketRows[] = '<button type="button" name="update" id="'.$ticket["id"].'" class="btn btn-warning btn-xs update" '.$disbaled.'>Edit</button>';
			$ticketRows[] = '<button type="button" name="open" id="'.$ticket["id"].'" class="btn btn-success btn-xs open" >Re-Open</button>';
			$ticketRows[] = '<button type="button" name="delete" id="'.$ticket["id"].'" class="btn btn-danger btn-xs delete" >Close</button>';
			$ticketData[] = $ticketRows;
		}
		$output = array(
			"draw"				=>	intval($_POST["draw"]),
			"recordsTotal"  	=>  $numRows,
			"recordsFiltered" 	=> 	$numRows,
			"data"    			=> 	$ticketData
		);
		echo json_encode($output);
	}	
	public function showTickets3(){
		$sqlWhere = '';
			if ( !empty($_POST["search"]["value"])) {
				$sqlWhere .= " WHERE ";
			}
				
			$time = new time;  			 
			$sqlQuery = "SELECT t.id, t.uniqidd, t.title, t.title1, t.title2, t.date, t.last_reply, t.resolved, t.resolvedtype, u.name as creater, u.branch as createrbranch, u.report_manager as creatermanager, d.name as department,r.text as replyy, m.text1 as replyy1,  b.text2 as replyy2, c.text3 as replyy3, a.name as type, s.name as subtype, p.name1 as profilename,p.acc_num1 as profilename1,p.phone_num1 as profilename2,p.email1 as profilename3,p.nrc as profilename4, u.user_type, t.user, t.user_read, t.admin_read
			FROM hd_tickets t 
			LEFT JOIN hd_users u ON t.user = u.id 
			LEFT JOIN hd_departments d ON t.department = d.id
			LEFT JOIN hd_type a ON t.type = a.id
			LEFT JOIN hd_profile p ON t.profile = p.id
			LEFT JOIN hd_ticket_replies r ON t.id = r.ticket_id
			LEFT JOIN hd_ticket_replies1 m ON t.id = m.ticket_id1
			LEFT JOIN hd_ticket_replies2 b ON t.id = b.ticket_id2
			LEFT JOIN hd_ticket_replies3 c ON t.id = c.ticket_id3

			LEFT JOIN hd_subtype s ON t.subtype = s.id $sqlWhere ";

		if (!empty($_POST["search"]["value"])) {
			$sqlQuery .= ' (t.uniqidd LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR t.title LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR t.title1 LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR t.title2 LIKE "%'.$_POST["search"]["value"].'%" ';

			$sqlQuery .= ' OR p.acc_num1 LIKE "%'.$_POST["search"]["value"].'%" ';		
            $sqlQuery .= ' OR p.name1 LIKE "%'.$_POST["search"]["value"].'%" ';	
			$sqlQuery .= ' OR p.phone_num1 LIKE "%'.$_POST["search"]["value"].'%" ';	
			$sqlQuery .= ' OR p.nrc LIKE "%'.$_POST["search"]["value"].'%" ';	
			$sqlQuery .= ' OR d.name LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR a.name LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR s.name LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR t.resolved LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR t.resolvedtype LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR t.last_reply LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR u.name LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR u.branch LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR u.report_manager LIKE "%'.$_POST["search"]["value"].'%") ';
			
		
			
		}
			
		if(!empty($_POST["order"])){
			$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
		} else {
			$sqlQuery .= 'ORDER BY t.id DESC ';
		}
		if($_POST["length"] != -1){
			$sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}	
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$numRows = mysqli_num_rows($result);
		$ticketData = array();	
		while( $ticket = mysqli_fetch_assoc($result) ) {		
			if ($ticket['resolved'] != 3) {
				continue;
			}	
			$ticketRows = array();			
			$status1 = '';
			if($ticket['resolvedtype'] == 0)	{
				$status1 = '<span class="label label-info">Query</span>';
			} else if($ticket['resolvedtype'] == 1) {
				$status1 = '<span class="label label-info">Complaint</span>';			
			} else if($ticket['resolvedtype'] == 2) {
				$status1 = '<span class="label label-info">Request</span>';
			}	
			$status = '';
			if($ticket['resolved'] == 0)	{
				$status = '<span class="label label-success">Open</span>';
			} else if($ticket['resolved'] == 3) {
				$status = '<span class="label label-primary">In Progress</span>';
			} else if($ticket['resolved'] == 2) {
				$status = '<span class="label label-warning">Escaltion</span>';
			
			} else if($ticket['resolved'] == 1) {
				$status = '<span class="label label-danger">Closed</span>';
			}	
			$title = $ticket['title'];
			if((isset($_SESSION["admin"]) && !$ticket['admin_read'] && $ticket['last_reply'] != $_SESSION["userid"]) || (!isset($_SESSION["admin"]) && !$ticket['user_read'] && $ticket['last_reply'] != $ticket['user'])) {
				$title = $this->getRepliedTitle($ticket['title']);			
			}

			$title1 = $ticket['title1'];
			$title2 = $ticket['title2'];


			$disbaled = '';
			if (!isset($_SESSION["superadmin"])) {
				$disbaled = 'disabled';
			}			

			$ticketRows[] = $ticket['uniqidd'];
			$ticketRows[] = $ticket['profilename1'];
			$ticketRows[] = $ticket['profilename'];
			$ticketRows[] = $ticket['profilename2'];
			$ticketRows[] = $ticket['profilename4'];
		
			$ticketRows[] = $ticket['department'];
			$ticketRows[] = $ticket['type'];
			$ticketRows[] = $ticket['subtype'];
		    $ticketRows[] = $title . $ticket['replyy2'] . '<br><a href="view_comments.php?id='.$ticket["uniqidd"].'" class="btn btn-primary active btn-xs update">View All Remarks</a> ';
			$ticketRows[] = $title1 . $ticket['replyy'];
			$ticketRows[] = $title2 . $ticket['replyy1'];
			$ticketRows[] = $ticket['replyy3'];
			$ticketRows[] = $ticket['creater']; 
			$ticketRows[] = $ticket['createrbranch']; 			
			$ticketRows[] = $ticket['creatermanager']; 			
			$ticketRows[] = $time->ago($ticket['date']);
			$ticketRows[] = $status1;
			$ticketRows[] = $status;

			$ticketRows[] = '<a href="view_ticket.php?id='.$ticket["uniqidd"].'" class="btn btn-success btn-xs update">View Ticket</a>';	
			$ticketRows[] = '<button type="button" name="update" id="'.$ticket["id"].'" class="btn btn-warning btn-xs update" '.$disbaled.'>Edit</button>';
			$ticketRows[] = '<button type="button" name="open" id="'.$ticket["id"].'" class="btn btn-success btn-xs open" >Re-Open</button>';
			$ticketRows[] = '<button type="button" name="delete" id="'.$ticket["id"].'" class="btn btn-danger btn-xs delete"  >Close</button>';
			$ticketData[] = $ticketRows;
		}
		$output = array(
			"draw"				=>	intval($_POST["draw"]),
			"recordsTotal"  	=>  $numRows,
			"recordsFiltered" 	=> 	$numRows,
			"data"    			=> 	$ticketData
		);
		echo json_encode($output);
	}

	public function showTickets4(){
		$sqlWhere = '';
			if ( !empty($_POST["search"]["value"])) {
				$sqlWhere .= " WHERE ";
			}
				
			$time = new time;  			 
			$sqlQuery = "SELECT t.id, t.uniqidd, t.title, t.title1, t.title2, t.date, t.last_reply, t.resolved, t.resolvedtype, u.name as creater, u.branch as createrbranch, u.report_manager as creatermanager, d.name as department,r.text as replyy, m.text1 as replyy1,  b.text2 as replyy2, c.text3 as replyy3, a.name as type, s.name as subtype, p.name1 as profilename,p.acc_num1 as profilename1,p.phone_num1 as profilename2,p.email1 as profilename3,p.nrc as profilename4, u.user_type, t.user, t.user_read, t.admin_read
			FROM hd_tickets t 
			LEFT JOIN hd_users u ON t.user = u.id 
			LEFT JOIN hd_departments d ON t.department = d.id
			LEFT JOIN hd_type a ON t.type = a.id
			LEFT JOIN hd_profile p ON t.profile = p.id
			LEFT JOIN hd_ticket_replies r ON t.id = r.ticket_id
			LEFT JOIN hd_ticket_replies1 m ON t.id = m.ticket_id1
			LEFT JOIN hd_ticket_replies2 b ON t.id = b.ticket_id2
			LEFT JOIN hd_ticket_replies3 c ON t.id = c.ticket_id3

			LEFT JOIN hd_subtype s ON t.subtype = s.id $sqlWhere ";

		if (!empty($_POST["search"]["value"])) {
			$sqlQuery .= ' (t.uniqidd LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR t.title LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR t.title1 LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR t.title2 LIKE "%'.$_POST["search"]["value"].'%" ';

			$sqlQuery .= ' OR p.acc_num1 LIKE "%'.$_POST["search"]["value"].'%" ';		
            $sqlQuery .= ' OR p.name1 LIKE "%'.$_POST["search"]["value"].'%" ';	
			$sqlQuery .= ' OR p.phone_num1 LIKE "%'.$_POST["search"]["value"].'%" ';	
			$sqlQuery .= ' OR p.nrc LIKE "%'.$_POST["search"]["value"].'%" ';	
			$sqlQuery .= ' OR d.name LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR a.name LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR s.name LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR t.resolved LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR t.resolvedtype LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR t.last_reply LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR u.name LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR u.branch LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR u.report_manager LIKE "%'.$_POST["search"]["value"].'%") ';
			
		
			
		}
			
		if(!empty($_POST["order"])){
			$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
		} else {
			$sqlQuery .= 'ORDER BY t.id DESC ';
		}
		if($_POST["length"] != -1){
			$sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}	
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$numRows = mysqli_num_rows($result);
		$ticketData = array();	
		while( $ticket = mysqli_fetch_assoc($result) ) {		
			if ($ticket['resolved'] != 0) {
				continue;
			}	
			$ticketRows = array();			
			$status1 = '';
			if($ticket['resolvedtype'] == 0)	{
				$status1 = '<span class="label label-info">Query</span>';
			} else if($ticket['resolvedtype'] == 1) {
				$status1 = '<span class="label label-info">Complaint</span>';			
			} else if($ticket['resolvedtype'] == 2) {
				$status1 = '<span class="label label-info">Request</span>';
			}	
			$status = '';
			if($ticket['resolved'] == 0)	{
				$status = '<span class="label label-success">Open</span>';
			} else if($ticket['resolved'] == 3) {
				$status = '<span class="label label-primary">In Progress</span>';
			} else if($ticket['resolved'] == 2) {
				$status = '<span class="label label-warning">Escaltion</span>';
			
			} else if($ticket['resolved'] == 1) {
				$status = '<span class="label label-danger">Closed</span>';
			}	
			$title = $ticket['title'];
			if((isset($_SESSION["admin"]) && !$ticket['admin_read'] && $ticket['last_reply'] != $_SESSION["userid"]) || (!isset($_SESSION["admin"]) && !$ticket['user_read'] && $ticket['last_reply'] != $ticket['user'])) {
				$title = $this->getRepliedTitle($ticket['title']);			
			}

			$title1 = $ticket['title1'];
			$title2 = $ticket['title2'];


			$disbaled = '';
			if (!isset($_SESSION["superadmin"])) {
				$disbaled = 'disabled';
			}			

			$ticketRows[] = $ticket['uniqidd'];
			$ticketRows[] = $ticket['profilename1'];
			$ticketRows[] = $ticket['profilename'];
			$ticketRows[] = $ticket['profilename2'];
			$ticketRows[] = $ticket['profilename4'];
		
			$ticketRows[] = $ticket['department'];
			$ticketRows[] = $ticket['type'];
			$ticketRows[] = $ticket['subtype'];
		    $ticketRows[] = $title . $ticket['replyy2'] . '<br><a href="view_comments.php?id='.$ticket["uniqidd"].'" class="btn btn-primary active btn-xs update">View All Remarks</a> ';
			$ticketRows[] = $title1 . $ticket['replyy'];
			$ticketRows[] = $title2 . $ticket['replyy1'];
			$ticketRows[] = $ticket['replyy3'];
			$ticketRows[] = $ticket['creater']; 
			$ticketRows[] = $ticket['createrbranch']; 			
			$ticketRows[] = $ticket['creatermanager']; 			
			$ticketRows[] = $time->ago($ticket['date']);
			$ticketRows[] = $status1;
			$ticketRows[] = $status;

			$ticketRows[] = '<a href="view_ticket.php?id='.$ticket["uniqidd"].'" class="btn btn-success btn-xs update">View Ticket</a>';	
			$ticketRows[] = '<button type="button" name="update" id="'.$ticket["id"].'" class="btn btn-warning btn-xs update" '.$disbaled.'>Edit</button>';
			$ticketRows[] = '<button type="button" name="open" id="'.$ticket["id"].'" class="btn btn-success btn-xs open" >Re-Open</button>';
			$ticketRows[] = '<button type="button" name="delete" id="'.$ticket["id"].'" class="btn btn-danger btn-xs delete"  >Close</button>';
			$ticketData[] = $ticketRows;
		}
		$output = array(
			"draw"				=>	intval($_POST["draw"]),
			"recordsTotal"  	=>  $numRows,
			"recordsFiltered" 	=> 	$numRows,
			"data"    			=> 	$ticketData
		);
		echo json_encode($output);
	}


	public function showTickets5(){
		$sqlWhere = '';
			if ( !empty($_POST["search"]["value"])) {
				$sqlWhere .= " WHERE ";
			}
				
			$time = new time;  			 
			$sqlQuery = "SELECT t.id, t.uniqidd, t.title, t.title1, t.title2, t.date, t.last_reply, t.resolved, t.resolvedtype, u.name as creater, u.branch as createrbranch, u.report_manager as creatermanager, d.name as department,r.text as replyy, m.text1 as replyy1,  b.text2 as replyy2, c.text3 as replyy3, a.name as type, s.name as subtype, p.name1 as profilename,p.acc_num1 as profilename1,p.phone_num1 as profilename2,p.email1 as profilename3,p.nrc as profilename4, u.user_type, t.user, t.user_read, t.admin_read
			FROM hd_tickets t 
			LEFT JOIN hd_users u ON t.user = u.id 
			LEFT JOIN hd_departments d ON t.department = d.id
			LEFT JOIN hd_type a ON t.type = a.id
			LEFT JOIN hd_profile p ON t.profile = p.id
			LEFT JOIN hd_ticket_replies r ON t.id = r.ticket_id
			LEFT JOIN hd_ticket_replies1 m ON t.id = m.ticket_id1
			LEFT JOIN hd_ticket_replies2 b ON t.id = b.ticket_id2
			LEFT JOIN hd_ticket_replies3 c ON t.id = c.ticket_id3

			LEFT JOIN hd_subtype s ON t.subtype = s.id $sqlWhere ";

		if (!empty($_POST["search"]["value"])) {
			$sqlQuery .= ' (t.uniqidd LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR t.title LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR t.title1 LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR t.title2 LIKE "%'.$_POST["search"]["value"].'%" ';

			$sqlQuery .= ' OR p.acc_num1 LIKE "%'.$_POST["search"]["value"].'%" ';		
            $sqlQuery .= ' OR p.name1 LIKE "%'.$_POST["search"]["value"].'%" ';	
			$sqlQuery .= ' OR p.phone_num1 LIKE "%'.$_POST["search"]["value"].'%" ';	
			$sqlQuery .= ' OR p.nrc LIKE "%'.$_POST["search"]["value"].'%" ';	
			$sqlQuery .= ' OR d.name LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR a.name LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR s.name LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR t.resolved LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR t.resolvedtype LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR t.last_reply LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR u.name LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR u.branch LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR u.report_manager LIKE "%'.$_POST["search"]["value"].'%") ';
			
		
			
		}
			
		if(!empty($_POST["order"])){
			$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
		} else {
			$sqlQuery .= 'ORDER BY t.id DESC ';
		}
		if($_POST["length"] != -1){
			$sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}	
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$numRows = mysqli_num_rows($result);
		$ticketData = array();	
		while( $ticket = mysqli_fetch_assoc($result) ) {		
			if ($ticket['resolved'] != 1) {
				continue;
			}	
			$ticketRows = array();			
			$status1 = '';
			if($ticket['resolvedtype'] == 0)	{
				$status1 = '<span class="label label-info">Query</span>';
			} else if($ticket['resolvedtype'] == 1) {
				$status1 = '<span class="label label-info">Complaint</span>';			
			} else if($ticket['resolvedtype'] == 2) {
				$status1 = '<span class="label label-info">Request</span>';
			}	
			$status = '';
			if($ticket['resolved'] == 0)	{
				$status = '<span class="label label-success">Open</span>';
			} else if($ticket['resolved'] == 3) {
				$status = '<span class="label label-primary">In Progress</span>';
			} else if($ticket['resolved'] == 2) {
				$status = '<span class="label label-warning">Escaltion</span>';
			
			} else if($ticket['resolved'] == 1) {
				$status = '<span class="label label-danger">Closed</span>';
			}	
			$title = $ticket['title'];
			if((isset($_SESSION["admin"]) && !$ticket['admin_read'] && $ticket['last_reply'] != $_SESSION["userid"]) || (!isset($_SESSION["admin"]) && !$ticket['user_read'] && $ticket['last_reply'] != $ticket['user'])) {
				$title = $this->getRepliedTitle($ticket['title']);			
			}

			$title1 = $ticket['title1'];
			$title2 = $ticket['title2'];


			$disbaled = '';
			if (!isset($_SESSION["superadmin"])) {
				$disbaled = 'disabled';
			}			

			$ticketRows[] = $ticket['uniqidd'];
			$ticketRows[] = $ticket['profilename1'];
			$ticketRows[] = $ticket['profilename'];
			$ticketRows[] = $ticket['profilename2'];
			$ticketRows[] = $ticket['profilename4'];
		
			$ticketRows[] = $ticket['department'];
			$ticketRows[] = $ticket['type'];
			$ticketRows[] = $ticket['subtype'];
		    $ticketRows[] = $title . $ticket['replyy2'] . '<br><a href="view_comments.php?id='.$ticket["uniqidd"].'" class="btn btn-primary active btn-xs update">View All Remarks</a> ';
			$ticketRows[] = $title1 . $ticket['replyy'];
			$ticketRows[] = $title2 . $ticket['replyy1'];
			$ticketRows[] = $ticket['replyy3'];
			$ticketRows[] = $ticket['creater']; 
			$ticketRows[] = $ticket['createrbranch']; 			
			$ticketRows[] = $ticket['creatermanager']; 			
			$ticketRows[] = $time->ago($ticket['date']);
			$ticketRows[] = $status1;
			$ticketRows[] = $status;

			$ticketRows[] = '<a href="view_ticket.php?id='.$ticket["uniqidd"].'" class="btn btn-success btn-xs update">View Ticket</a>';	
			$ticketRows[] = '<button type="button" name="update" id="'.$ticket["id"].'" class="btn btn-warning btn-xs update" '.$disbaled.'>Edit</button>';
			$ticketRows[] = '<button type="button" name="open" id="'.$ticket["id"].'" class="btn btn-success btn-xs open">Re-Open</button>';
			$ticketRows[] = '<button type="button" name="delete" id="'.$ticket["id"].'" class="btn btn-danger btn-xs delete">Close</button>';
			$ticketData[] = $ticketRows;
		}
		$output = array(
			"draw"				=>	intval($_POST["draw"]),
			"recordsTotal"  	=>  $numRows,
			"recordsFiltered" 	=> 	$numRows,
			"data"    			=> 	$ticketData
		);
		echo json_encode($output);
	}
	public function showTickets6(){

				
			$time1 = new time1;  			 
			$sqlWhere = '';
			if ( !empty($_POST["search"]["value"])) {
				$sqlWhere .= " WHERE ";
			}
					 
			$sqlQuery = "SELECT t.id, t.uniqidd, t.title, t.title1, t.title2, t.date, t.last_reply, t.resolved, t.resolvedtype, u.name as creater, u.branch as createrbranch, u.report_manager as creatermanager, d.name as department,r.text as replyy, m.text1 as replyy1,  b.text2 as replyy2, c.text3 as replyy3, a.name as type, s.name as subtype, p.name1 as profilename,p.acc_num1 as profilename1,p.phone_num1 as profilename2,p.email1 as profilename3,p.nrc as profilename4, u.user_type, t.user, t.user_read, t.admin_read
			FROM hd_tickets t 
			LEFT JOIN hd_users u ON t.user = u.id 
			LEFT JOIN hd_departments d ON t.department = d.id
			LEFT JOIN hd_type a ON t.type = a.id
			LEFT JOIN hd_profile p ON t.profile = p.id
			LEFT JOIN hd_ticket_replies r ON t.id = r.ticket_id
			LEFT JOIN hd_ticket_replies1 m ON t.id = m.ticket_id1
			LEFT JOIN hd_ticket_replies2 b ON t.id = b.ticket_id2
			LEFT JOIN hd_ticket_replies3 c ON t.id = c.ticket_id3

			LEFT JOIN hd_subtype s ON t.subtype = s.id $sqlWhere ";
		if (!empty($_POST["search"]["value"])) {
			$sqlQuery .= ' (t.uniqidd LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR t.title LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR t.title1 LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR t.title2 LIKE "%'.$_POST["search"]["value"].'%" ';

			$sqlQuery .= ' OR p.acc_num1 LIKE "%'.$_POST["search"]["value"].'%" ';		
            $sqlQuery .= ' OR p.name1 LIKE "%'.$_POST["search"]["value"].'%" ';	
			$sqlQuery .= ' OR p.phone_num1 LIKE "%'.$_POST["search"]["value"].'%" ';	
			$sqlQuery .= ' OR p.nrc LIKE "%'.$_POST["search"]["value"].'%" ';	
			$sqlQuery .= ' OR d.name LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR a.name LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR s.name LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR t.resolved LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR t.resolvedtype LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR t.last_reply LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR u.name LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR u.branch LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR u.report_manager LIKE "%'.$_POST["search"]["value"].'%") ';
			
		
			
		}
			
		if (!empty($_POST["order"])) {
			$sqlQuery .= " ORDER BY " . $_POST['order']['0']['column'] . " " . $_POST['order']['0']['dir'];
		} else {
			$sqlQuery .= " ORDER BY t.id DESC ";
		}
	
		// Limit and offset
		if (!empty($_POST["length"]) && $_POST["length"] != -1) {
			$sqlQuery .= " LIMIT " . $_POST['start'] . ", " . $_POST['length'];
		}
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$numRows = mysqli_num_rows($result);
		$ticketData = array();	
		while( $ticket = mysqli_fetch_assoc($result) ) {		

			$ticketRows = array();			
			$status1 = '';
			if($ticket['resolvedtype'] == 0)	{
				$status1 = 'Query';
			} else if($ticket['resolvedtype'] == 1) {
				$status1 = 'Complaint';			
			} else if($ticket['resolvedtype'] == 2) {
				$status1 = 'Request';
			}	
			$status = '';
			if($ticket['resolved'] == 0)	{
				$status = '<span class="label label-success">Open</span>';
			} else if($ticket['resolved'] == 3) {
				$status = '<span class="label label-primary">In Progress</span>';
			} else if($ticket['resolved'] == 2) {
				$status = '<span class="label label-warning">Escaltion</span>';
			
			} else if($ticket['resolved'] == 1) {
				$status = '<span class="label label-danger">Closed</span>';
			}	
			$title = $ticket['title'];
			if((isset($_SESSION["admin"]) && !$ticket['admin_read'] && $ticket['last_reply'] != $_SESSION["userid"]) || (!isset($_SESSION["admin"]) && !$ticket['user_read'] && $ticket['last_reply'] != $ticket['user'])) {
				$title = $this->getRepliedTitle($ticket['title']);			
			}

			$title1 = $ticket['title1'];
			$title2 = $ticket['title2'];


			$disbaled = '';
			if (!isset($_SESSION["admin"]) && !isset($_SESSION["superadmin"])) {
				$disbaled = 'disabled';
			}			
			$ticketRows[] = $time1->ago($ticket['date']);

			$ticketRows[] = $ticket['uniqidd'];


			$ticketRows[] = $ticket['profilename4'];
		       $ticketRows[] = $status1;

			$ticketRows[] = $ticket['profilename1'];
			$ticketRows[] =  "A/C " . $ticket['profilename'];
			$ticketRows[] = $ticket['profilename2'];
			$ticketRows[] = $title;
			$ticketRows[] = $title1 . $ticket['replyy'];
			$ticketRows[] = $time1->ago($ticket['date']);
			$ticketRows[] = $title2 . $ticket['replyy1'];
			$ticketRows[] = $ticket['replyy3'];

			$ticketRows[] = $ticket['type'];
			$ticketRows[] = $ticket['subtype'];
		
			$ticketRows[] = $ticket['department'];
			$ticketData[] = $ticketRows;
		}
		$output = array(
			"draw" => isset($_POST["draw"]) ? intval($_POST["draw"]) : 0,
			"recordsTotal"  	=>  $numRows,
			"recordsFiltered" 	=> 	$numRows,
			"data"    			=> 	$ticketData
		);
		echo json_encode($output);
	}	
	public function showTickets1(){
		$sqlWhere = '';
			if ( !empty($_POST["search"]["value"])) {
				$sqlWhere .= " WHERE ";
			}
				
			$time = new time;  			 
			$sqlQuery = "SELECT t.id, t.uniqidd, t.title, t.title1, t.title2, t.date, t.last_reply, t.resolved, t.resolvedtype, u.name as creater, u.branch as createrbranch, u.report_manager as creatermanager, d.name as department,r.text as replyy, m.text1 as replyy1,  b.text2 as replyy2, c.text3 as replyy3, a.name as type, s.name as subtype, p.name1 as profilename,p.acc_num1 as profilename1,p.phone_num1 as profilename2,p.email1 as profilename3,p.nrc as profilename4, u.user_type, t.user, t.user_read, t.admin_read
			FROM hd_tickets t 
			LEFT JOIN hd_users u ON t.user = u.id 
			LEFT JOIN hd_departments d ON t.department = d.id
			LEFT JOIN hd_type a ON t.type = a.id
			LEFT JOIN hd_profile p ON t.profile = p.id
			LEFT JOIN hd_ticket_replies r ON t.id = r.ticket_id
			LEFT JOIN hd_ticket_replies1 m ON t.id = m.ticket_id1
			LEFT JOIN hd_ticket_replies2 b ON t.id = b.ticket_id2
			LEFT JOIN hd_ticket_replies3 c ON t.id = c.ticket_id3

			LEFT JOIN hd_subtype s ON t.subtype = s.id $sqlWhere ";

		if (!empty($_POST["search"]["value"])) {
			$sqlQuery .= ' (t.uniqidd LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR t.title LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR t.title1 LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR t.title2 LIKE "%'.$_POST["search"]["value"].'%" ';

			$sqlQuery .= ' OR p.acc_num1 LIKE "%'.$_POST["search"]["value"].'%" ';		
            $sqlQuery .= ' OR p.name1 LIKE "%'.$_POST["search"]["value"].'%" ';	
			$sqlQuery .= ' OR p.phone_num1 LIKE "%'.$_POST["search"]["value"].'%" ';	
			$sqlQuery .= ' OR p.nrc LIKE "%'.$_POST["search"]["value"].'%" ';	
			$sqlQuery .= ' OR d.name LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR a.name LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR s.name LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR t.resolved LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR t.resolvedtype LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR t.last_reply LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR u.name LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR u.branch LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR u.report_manager LIKE "%'.$_POST["search"]["value"].'%") ';
			
		
			
		}
			
		if(!empty($_POST["order"])){
			$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
		} else {
			$sqlQuery .= 'ORDER BY t.id DESC ';
		}
		if($_POST["length"] != -1){
			$sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}	
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$numRows = mysqli_num_rows($result);
		$ticketData = array();	
		while( $ticket = mysqli_fetch_assoc($result) ) {		
			$ticketRows = array();			
			$status1 = '';
			if($ticket['resolvedtype'] == 0)	{
				$status1 = '<span class="label label-info">Query</span>';
			} else if($ticket['resolvedtype'] == 1) {
				$status1 = '<span class="label label-info">Complaint</span>';			
			} else if($ticket['resolvedtype'] == 2) {
				$status1 = '<span class="label label-info">Request</span>';
			}	
			$status = '';
			if($ticket['resolved'] == 0)	{
				$status = '<span class="label label-success">Open</span>';
			} else if($ticket['resolved'] == 3) {
				$status = '<span class="label label-primary">In Progress</span>';
			} else if($ticket['resolved'] == 2) {
				$status = '<span class="label label-warning">Escaltion</span>';
			
			} else if($ticket['resolved'] == 1) {
				$status = '<span class="label label-danger">Closed</span>';
			}	
			$title = $ticket['title'];
			if((isset($_SESSION["admin"]) && !$ticket['admin_read'] && $ticket['last_reply'] != $_SESSION["userid"]) || (!isset($_SESSION["admin"]) && !$ticket['user_read'] && $ticket['last_reply'] != $ticket['user'])) {
				$title = $this->getRepliedTitle($ticket['title']);			
			}

			$title1 = $ticket['title1'];
			$title2 = $ticket['title2'];


			$disbaled = '';
			if (!isset($_SESSION["admin"]) && !isset($_SESSION["superadmin"])) {
				$disbaled = 'disabled';
			}			

			$ticketRows[] = $ticket['uniqidd'];
			$ticketRows[] = $ticket['profilename1'];
			$ticketRows[] = $ticket['profilename'];
			$ticketRows[] = $ticket['profilename2'];
			$ticketRows[] = $ticket['profilename4'];
		
			$ticketRows[] = $ticket['department'];
			$ticketRows[] = $ticket['type'];
			$ticketRows[] = $ticket['subtype'];
		    $ticketRows[] = $title . $ticket['replyy2'] . '<br><a href="view_comments.php?id='.$ticket["uniqidd"].'" class="btn btn-primary active btn-xs update">View All Remarks</a> ';
			$ticketRows[] = $title1 . $ticket['replyy'];
			$ticketRows[] = $title2 . $ticket['replyy1'];
			$ticketRows[] = $ticket['replyy3'];
			$ticketRows[] = $ticket['creater']; 
			$ticketRows[] = $ticket['createrbranch']; 			
			$ticketRows[] = $ticket['creatermanager']; 			
			$ticketRows[] = $time->ago($ticket['date']);
			$ticketRows[] = $status1;
			$ticketRows[] = $status;

			$ticketRows[] = '<a href="view_ticket.php?id='.$ticket["uniqidd"].'" class="btn btn-success btn-xs update">View Ticket</a>';	
			$ticketRows[] = '<button type="button" name="update" id="'.$ticket["id"].'" class="btn btn-warning btn-xs update" '.$disbaled.'>Edit</button>';
			$ticketRows[] = '<button type="button" name="open" id="'.$ticket["id"].'" class="btn btn-success btn-xs open" '.$disbaled.'>Re-Open</button>';
			$ticketRows[] = '<button type="button" name="delete" id="'.$ticket["id"].'" class="btn btn-danger btn-xs delete"  '.$disbaled.'>Close</button>';
			$ticketData[] = $ticketRows;
		}
		$output = array(
			"draw"				=>	intval($_POST["draw"]),
			"recordsTotal"  	=>  $numRows,
			"recordsFiltered" 	=> 	$numRows,
			"data"    			=> 	$ticketData
		);
		echo json_encode($output);
	}	

	public function getTicketCount() {
        // Prepare the SQL query
        $query = "SELECT COUNT(*) AS count FROM ".$this->ticketTable;
        
        // Execute the SQL query
        $result = mysqli_query($this->dbConnect, $query);
        
        // Fetch the count from the result
        $row = mysqli_fetch_assoc($result);
        $count = $row['count'];
        
        // Return the count
        return $count;
    }
	public function getRepliedTitle($title) {
		$title = $title.'<span class="answered">Answered</span>';
		return $title; 		
	}
	public function getRepliedTitle1($title1) {
		$title1 = $title1.'<span class="answered">Answered</span>';
		return $title1; 		
	}
	public function getRepliedTitle2($title2) {
		$title2 = $title2.'<span class="answered">Answered</span>';
		return $title2; 		
	}
	public function createTicket()
	{
		if (!empty($_POST['subject'])) {
			$date = time();
			$prefix = '000-';
			$timestamp = date('dmY', $date);
			
			// Retrieve the last ticket number from the database
			$lastTicketQuery = "SELECT MAX(CAST(SUBSTRING_INDEX(uniqidd, '-', -1) AS UNSIGNED)) as last_ticket FROM " . $this->ticketTable;


			$lastTicketResult = mysqli_query($this->dbConnect, $lastTicketQuery);
			$lastTicketRow = mysqli_fetch_assoc($lastTicketResult);
            $lastTicketNumber = $lastTicketRow['last_ticket'];
            $ticketNumber = str_pad($lastTicketNumber + 1, 2, '0', STR_PAD_LEFT);
			
			$suffix = '-' . $ticketNumber;
			$uniqidd = $prefix . $timestamp . $suffix;
			$message = strip_tags($_POST['subject']);
	
			$queryInsert = "INSERT INTO " . $this->ticketTable . " (uniqidd, user, title, title1, title2, department, type, subtype, profile, date, last_reply, user_read, admin_read, resolved, resolvedtype) 
				VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 0, 0, ?, ?)";
			$stmt = mysqli_prepare($this->dbConnect, $queryInsert);
			mysqli_stmt_bind_param($stmt, "sssssssssiiss", $uniqidd, $_SESSION["userid"], $_POST['subject'], $_POST['subject1'], $_POST['subject2'], $_POST['department'], $_POST['type'], $_POST['subtype'], $_POST['profile'], $date, $_SESSION["userid"], $_POST['status'], $_POST['status1']);
			mysqli_stmt_execute($stmt);
	
			echo 'success ' . $uniqidd;
		} else {
			echo '<div class="alert error">Please fill in all fields.</div>';
		}
	}
	public function getTicketDetails(){
		if($_POST['ticketId']) {	
			$sqlQuery = "
				SELECT * FROM ".$this->ticketTable." 
				WHERE id = '".$_POST["ticketId"]."'";
			$result = mysqli_query($this->dbConnect, $sqlQuery);	
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			echo json_encode($row);
		}
	}
	public function getOpenTicketCount() {
		$stmt = $this->dbConnect->prepare("SELECT COUNT(*) FROM hd_tickets WHERE resolved = 0");
		$stmt->execute();
		$stmt->bind_result($count);
		$stmt->fetch();
		$stmt->close();
	
		return $count;
	}
	public function getClosedTicketCount() {
		$stmt = $this->dbConnect->prepare("SELECT COUNT(*) FROM hd_tickets WHERE resolved = 1");
		$stmt->execute();
		$stmt->bind_result($count);
		$stmt->fetch();
		$stmt->close();
	
		return $count;
	}
	public function getEscalationTicketCount() {
		$stmt = $this->dbConnect->prepare("SELECT COUNT(*) FROM hd_tickets WHERE resolved = 2");
		$stmt->execute();
		$stmt->bind_result($count);
		$stmt->fetch();
		$stmt->close();
	
		return $count;
	}
	public function getProgressTicketCount() {
		$stmt = $this->dbConnect->prepare("SELECT COUNT(*) FROM hd_tickets WHERE resolved = 3");
		$stmt->execute();
		$stmt->bind_result($count);
		$stmt->fetch();
		$stmt->close();
	
		return $count;
	}

	public function updateTicket()
		{
			if ($_POST['ticketId']) {
				$updateQuery = "UPDATE " . $this->ticketTable . "
					SET title = '" . $_POST["subject"] . "', title1 = '" . $_POST["subject1"] . "', title2 = '" . $_POST["subject2"] . "', department = '" . $_POST["department"] . "', type = '" . $_POST["type"] . "', subtype = '" . $_POST["subtype"] . "', profile = '" . $_POST["profile"] . "', resolvedtype = '" . $_POST["status1"] . "', resolved = '" . $_POST["status"] . "'
					WHERE id = '" . $_POST["ticketId"] . "'";
				$isUpdated = mysqli_query($this->dbConnect, $updateQuery);
			}
		}	
	public function closeTicket(){
		if($_POST["ticketId"]) {
			$sqlDelete = "UPDATE ".$this->ticketTable." 
				SET resolved = '1'
				WHERE id = '".$_POST["ticketId"]."'";		
			mysqli_query($this->dbConnect, $sqlDelete);		
		}
	}	
	public function reopenTicket(){
		if($_POST["ticketId"]) {
			$sqlUpdate = "UPDATE ".$this->ticketTable." 
				SET resolved = '0'
				WHERE id = '".$_POST["ticketId"]."'";        
			mysqli_query($this->dbConnect, $sqlUpdate);       
		}
	}
	public function getDepartments() {       
		$sqlQuery = "SELECT * FROM ".$this->departmentsTable;
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		while($department = mysqli_fetch_assoc($result) ) {       
            echo '<option value="' . $department['id'] . '">' . $department['name']  . '</option>';           
        }
    }	    
	public function getTypes() {       
		$sqlQuery = "SELECT * FROM ".$this->typesTable;
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		while($type = mysqli_fetch_assoc($result) ) {       
            echo '<option value="' . $type['id'] . '">' . $type['name']  . '</option>';           
        }
    }	    
	public function getSubtypes() {       
		$sqlQuery = "SELECT * FROM ".$this->subtypesTable;
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		while($subtype = mysqli_fetch_assoc($result) ) {       
            echo '<option value="' . $subtype['id'] . '">' . $subtype['name']  . '</option>';           
        }
    }	    
	// public function getProfiles($selectedProfile = '') {
	// 	$sqlQuery = "SELECT * FROM " . $this->departmentsTable2 . " WHERE id = " . $selectedProfile;
	// 	$result = mysqli_query($this->dbConnect, $sqlQuery);
	
	// 	if ($department2 = mysqli_fetch_assoc($result)) {
	// 		echo $department2['name1'] . ' - ' . $department2['acc_num1']  . ' - ' . $department2['phone_num1'];
	// 	}
	// }
	// public function getProfiles() {
	// 	$sqlQuery = "SELECT * FROM " . $this->departmentsTable2 . " ORDER BY id DESC";
	// 	$result = mysqli_query($this->dbConnect, $sqlQuery);
	
	// 	while ($department2 = mysqli_fetch_assoc($result)) {
	// 		echo '<option value="' . $department2['id'] . '">' . $department2['name1'] . ' - ' . $department2['acc_num1']  . ' - ' . $department2['phone_num1']  . '</option>';
	// 	}
	// } 


	public function getProfiles($selectedProfile = '') {
		$sqlQuery = "SELECT * FROM " . $this->departmentsTable2 . " ORDER BY id DESC";
		$result = mysqli_query($this->dbConnect, $sqlQuery);
	
		while ($department2 = mysqli_fetch_assoc($result)) {
			$selected = ($selectedProfile == $department2['id']) ? 'selected' : '';
			echo '<option value="' . $department2['id'] . '" ' . $selected . '>' . $department2['acc_num1'] . ' - ' . $department2['name1']  . ' - ' . $department2['phone_num1']  . '</option>';
		}
	}
    public function ticketInfo($id) {  		
		$sqlQuery = "SELECT t.id, t.uniqidd, t.title, t.title1,  t.title2, t.user,  t.date, t.last_reply, t.resolved, t.resolvedtype,  u.name as creater,u.branch as createrbranch, p.name1 as profilename,p.acc_num1 as profilename1,p.phone_num1 as profilename2,p.email1 as profilename3,p.nrc as profilename4, u.report_manager as creatermanager, d.name as department, a.name as type, s.name as subtype
			FROM ".$this->ticketTable." t 
			LEFT JOIN hd_users u ON t.user = u.id 
			LEFT JOIN hd_departments d ON t.department = d.id 
			LEFT JOIN hd_type a ON t.type = a.id
			LEFT JOIN hd_subtype s ON t.subtype = s.id
			LEFT JOIN hd_profile p ON t.profile = p.id
			WHERE t.uniqidd = '".$id."'";	
		$result = mysqli_query($this->dbConnect, $sqlQuery);
        $tickets = mysqli_fetch_assoc($result);
        return $tickets;        
    }    

	public function saveTicketReplies()
		{
			if ($_POST['message']) {
				$date = time();
				$queryInsert = "INSERT INTO " . $this->ticketRepliesTable . " (user, text, ticket_id, date) 
					VALUES (?, ?, ?, ?)";
				$stmt = mysqli_prepare($this->dbConnect, $queryInsert);
				mysqli_stmt_bind_param($stmt, "issi", $_SESSION["userid"], $_POST['message'], $_POST['ticketId'], $date);
				mysqli_stmt_execute($stmt);
				
				$updateTicket = "UPDATE " . $this->ticketTable . " 
					SET last_reply = ?, user_read = '0', admin_read = '0' 
					WHERE id = ?";
				$stmt = mysqli_prepare($this->dbConnect, $updateTicket);
				mysqli_stmt_bind_param($stmt, "ii", $_SESSION["userid"], $_POST['ticketId']);
				mysqli_stmt_execute($stmt);
			}
		}
	public function getTicketReplies($id) {  		
		$sqlQuery = "SELECT r.id, r.text as message, r.date, u.name as creater,u.branch as createrbranch,p.name1 as profilename,p.acc_num1 as profilename1,p.phone_num1 as profilename2,p.nrc as profilename4,p.email1 as profilename3, u.report_manager as creatermanager, d.name as department,a.name as type, s.name as subtype, u.user_type  
			FROM ".$this->ticketRepliesTable." r
			LEFT JOIN ".$this->ticketTable." t ON r.ticket_id = t.id
			LEFT JOIN hd_users u ON r.user = u.id 
			LEFT JOIN hd_departments d ON t.department = d.id 
			LEFT JOIN hd_type a ON t.type = a.id
			LEFT JOIN hd_subtype s ON t.subtype = s.id
			LEFT JOIN hd_profile p ON t.profile = p.id
			WHERE r.ticket_id = '".$id."'";	
		$result = mysqli_query($this->dbConnect, $sqlQuery);
       	$data= array();
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$data[]=$row;            
		}
        return $data;
    }





	public function saveTicketReplies1()
	{
		if ($_POST['message1']) {
			$date = time();
			$queryInsert = "INSERT INTO " . $this->ticketRepliesTable1 . " (user1, text1, ticket_id1, date) 
				VALUES (?, ?, ?, ?)";
			$stmt = mysqli_prepare($this->dbConnect, $queryInsert);
			mysqli_stmt_bind_param($stmt, "issi", $_SESSION["userid"], $_POST['message1'], $_POST['ticketId'], $date);
			mysqli_stmt_execute($stmt);
			
			$updateTicket = "UPDATE " . $this->ticketTable . " 
				SET last_reply = ?, user_read = '0', admin_read = '0' 
				WHERE id = ?";
			$stmt = mysqli_prepare($this->dbConnect, $updateTicket);
			mysqli_stmt_bind_param($stmt, "ii", $_SESSION["userid"], $_POST['ticketId']);
			mysqli_stmt_execute($stmt);
		}
	}
public function getTicketReplies1($id) {  		
	$sqlQuery = "SELECT m.id, m.text1 as message1, m.date, u.name as creater,u.branch as createrbranch,p.name1 as profilename,p.acc_num1 as profilename1,p.phone_num1 as profilename2,p.nrc as profilename4,p.email1 as profilename3, u.report_manager as creatermanager, d.name as department,a.name as type, s.name as subtype, u.user_type  
		FROM ".$this->ticketRepliesTable1." m
		LEFT JOIN ".$this->ticketTable." t ON m.ticket_id1 = t.id
		LEFT JOIN hd_users u ON m.user1 = u.id 
		LEFT JOIN hd_departments d ON t.department = d.id 
		LEFT JOIN hd_type a ON t.type = a.id
		LEFT JOIN hd_subtype s ON t.subtype = s.id
		LEFT JOIN hd_profile p ON t.profile = p.id
		WHERE m.ticket_id1 = '".$id."'";	
	$result = mysqli_query($this->dbConnect, $sqlQuery);
	   $data= array();
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$data[]=$row;            
	}
	return $data;
}



public function saveTicketReplies2()
{
	if ($_POST['message2']) {
		$date = time();
		$queryInsert = "INSERT INTO " . $this->ticketRepliesTable2 . " (user2, text2, ticket_id2, date) 
			VALUES (?, ?, ?, ?)";
		$stmt = mysqli_prepare($this->dbConnect, $queryInsert);
		mysqli_stmt_bind_param($stmt, "issi", $_SESSION["userid"], $_POST['message2'], $_POST['ticketId'], $date);
		mysqli_stmt_execute($stmt);
		
		$updateTicket = "UPDATE " . $this->ticketTable . " 
			SET last_reply = ?, user_read = '0', admin_read = '0' 
			WHERE id = ?";
		$stmt = mysqli_prepare($this->dbConnect, $updateTicket);
		mysqli_stmt_bind_param($stmt, "ii", $_SESSION["userid"], $_POST['ticketId']);
		mysqli_stmt_execute($stmt);
	}
}
public function getTicketReplies2($id) {  		
$sqlQuery = "SELECT b.id, b.text2 as message2, b.date, u.name as creater,u.branch as createrbranch,p.name1 as profilename,p.acc_num1 as profilename1,p.phone_num1 as profilename2,p.nrc as profilename4,p.email1 as profilename3, u.report_manager as creatermanager, d.name as department,a.name as type, s.name as subtype, u.user_type  
	FROM ".$this->ticketRepliesTable2." b
	LEFT JOIN ".$this->ticketTable." t ON b.ticket_id2 = t.id
	LEFT JOIN hd_users u ON b.user2 = u.id 
	LEFT JOIN hd_departments d ON t.department = d.id 
	LEFT JOIN hd_type a ON t.type = a.id
	LEFT JOIN hd_subtype s ON t.subtype = s.id
	LEFT JOIN hd_profile p ON t.profile = p.id
	WHERE b.ticket_id2 = '".$id."'";	
$result = mysqli_query($this->dbConnect, $sqlQuery);
   $data= array();
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	$data[]=$row;            
}
return $data;
}


public function saveTicketReplies3()
{
	if ($_POST['message3']) {
		$date = time();
		$queryInsert = "INSERT INTO " . $this->ticketRepliesTable3 . " (user3, text3, ticket_id3, date) 
			VALUES (?, ?, ?, ?)";
		$stmt = mysqli_prepare($this->dbConnect, $queryInsert);
		mysqli_stmt_bind_param($stmt, "issi", $_SESSION["userid"], $_POST['message3'], $_POST['ticketId'], $date);
		mysqli_stmt_execute($stmt);
		
		$updateTicket = "UPDATE " . $this->ticketTable . " 
			SET last_reply = ?, user_read = '0', admin_read = '0' 
			WHERE id = ?";
		$stmt = mysqli_prepare($this->dbConnect, $updateTicket);
		mysqli_stmt_bind_param($stmt, "ii", $_SESSION["userid"], $_POST['ticketId']);
		mysqli_stmt_execute($stmt);
	}
}
public function getTicketReplies3($id) {  		
$sqlQuery = "SELECT c.id, c.text3 as message3, c.date, u.name as creater,u.branch as createrbranch,p.name1 as profilename,p.acc_num1 as profilename1,p.phone_num1 as profilename2,p.nrc as profilename4,p.email1 as profilename3, u.report_manager as creatermanager, d.name as department,a.name as type, s.name as subtype, u.user_type  
	FROM ".$this->ticketRepliesTable3." c
	LEFT JOIN ".$this->ticketTable." t ON c.ticket_id3 = t.id
	LEFT JOIN hd_users u ON c.user3 = u.id 
	LEFT JOIN hd_departments d ON t.department = d.id 
	LEFT JOIN hd_type a ON t.type = a.id
	LEFT JOIN hd_subtype s ON t.subtype = s.id
	LEFT JOIN hd_profile p ON t.profile = p.id
	WHERE c.ticket_id3 = '".$id."'";	
$result = mysqli_query($this->dbConnect, $sqlQuery);
   $data= array();
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	$data[]=$row;            
}
return $data;
}
	public function updateTicketReadStatus($ticketId) {
		$updateField = '';
		if(isset($_SESSION["admin"])) {
			$updateField = "admin_read = '1'";
		} else {
			$updateField = "user_read = '1'";
		}
		$updateTicket = "UPDATE ".$this->ticketTable." 
			SET $updateField
			WHERE id = '".$ticketId."'";				
		mysqli_query($this->dbConnect, $updateTicket);
	}
}
