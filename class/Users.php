<?php
class Users extends Database { 
	private $userTable = 'hd_users';
	private $dbConnect = false;
	public function __construct(){		
        $this->dbConnect = $this->dbConnect();
    }	
	public function isLoggedIn () {
		if(isset($_SESSION["userid"])) {
			return true; 			
		} else {
			return false;
		}
	}
	public function login()
	{        
		$errorMessage = '';
		if (!empty($_POST["login"]) && $_POST["email"] && $_POST["password"]) {
			$email = $_POST['email'];
			$password = $_POST['password'];
			$sqlQuery = "SELECT * FROM " . $this->userTable . " 
				WHERE email='" . $email . "' AND password='" . md5($password) . "' AND status = 1";
	
			$resultSet = mysqli_query($this->dbConnect, $sqlQuery);
			$isValidLogin = mysqli_num_rows($resultSet);
			if ($isValidLogin) {
				$userDetails = mysqli_fetch_assoc($resultSet);
				$_SESSION["userid"] = $userDetails['id'];
				$_SESSION["user_name"] = $userDetails['name'];
	
				if ($userDetails['user_type'] == 'admin') {
					$_SESSION["admin"] = 1;
					header("location: dashboard.php");
				} elseif ($userDetails['user_type'] == 'user') {
					$_SESSION["user"] = 1;
					header("location: department2.php");
				} elseif ($userDetails['user_type'] == 'user1') {
					$_SESSION["user1"] = 1;
					header("location: department1.php");
				
				} elseif ($userDetails['user_type'] == 'superadmin') {
					$_SESSION["superadmin"] = 1;
					header("location: department1.php");
				}
			} else {
				$errorMessage = "Invalid login!";
			}
		} else if (!empty($_POST["login"])) {
			$errorMessage = "Enter both email and password!";
		}
		return $errorMessage;
	}
	
	public function getUserCount() {
        // Prepare the SQL query
        $query = "SELECT COUNT(*) AS count FROM ".$this->userTable;
        
        // Execute the SQL query
        $result = mysqli_query($this->dbConnect, $query);
        
        // Fetch the count from the result
        $row = mysqli_fetch_assoc($result);
        $count = $row['count'];
        
        // Return the count
        return $count;
    }
	public function getUserInfo() {
		if(!empty($_SESSION["userid"])) {
			$sqlQuery = "SELECT * FROM ".$this->userTable." 
				WHERE id ='".$_SESSION["userid"]."'";
			$result = mysqli_query($this->dbConnect, $sqlQuery);		
			$userDetails = mysqli_fetch_assoc($result);
			return $userDetails;
		}		
	}
	public function getColoumn($id, $column) {     
        $sqlQuery = "SELECT * FROM ".$this->userTable." 
			WHERE id ='".$id."'";
		$result = mysqli_query($this->dbConnect, $sqlQuery);		
		$userDetails = mysqli_fetch_assoc($result);
		return $userDetails[$column];       
    }
	
	
	public function listUser()
	{
		$sqlQuery = "SELECT id, name, email, branch, report_manager, create_date, user_type, status 
			FROM " . $this->userTable;
	
		if (!empty($_POST["search"]["value"])) {
			$searchValue = $_POST["search"]["value"];
			$sqlQuery .= " WHERE id LIKE '%$searchValue%' 
				OR name LIKE '%$searchValue%' 
				OR email LIKE '%$searchValue%' 
				OR branch LIKE '%$searchValue%' 
				OR report_manager LIKE '%$searchValue%' 
				OR status LIKE '%$searchValue%'";
		}
	
		if (!empty($_POST["order"])) {
			$orderColumn = $_POST['order']['0']['column'];
			$orderDir = $_POST['order']['0']['dir'];
			$sqlQuery .= " ORDER BY " . $orderColumn . " " . $orderDir;
		} else {
			$sqlQuery .= " ORDER BY id DESC";
		}
	
		if ($_POST["length"] != -1) {
			$start = $_POST['start'];
			$length = $_POST['length'];
			$sqlQuery .= " LIMIT $start, $length";
		}
	
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$numRows = mysqli_num_rows($result);
		$userData = array();
	
		while ($user = mysqli_fetch_assoc($result)) {
			$status = ($user['status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';
			// $userRole = ($user['user_type'] == 'admin') ? '<span class="label label-danger">Admin</span>' : '<span class="label label-warning">Associate</span>';

			$userRole = '';
        
			if ($user['user_type'] == 'superadmin') {
				$userRole = '<span class="label label-success">Super Admin</span>';
			} elseif ($user['user_type'] == 'admin') {
				$userRole = '<span class="label label-danger">Admin</span>';
			} elseif ($user['user_type'] == 'user') {
				$userRole = '<span class="label label-warning">Associate</span>';
			} elseif ($user['user_type'] == 'user1') {
				$userRole = '<span class="label label-info">Lead Associate</span>';
			}
	
			$userRows = array(
				$user['id'],
				$user['name'],
				$user['email'],
				$user['branch'],
				$user['report_manager'],
				$user['create_date'],
				$userRole,
				$status,
				'<button type="button" name="update" id="' . $user["id"] . '" class="btn btn-warning btn-xs update">Edit</button>',
				'<button type="button" name="delete" id="' . $user["id"] . '" class="btn btn-danger btn-xs delete">Delete</button>'
			);
	
			$userData[] = $userRows;
		}
	
		$output = array(
			"draw" => intval($_POST["draw"]),
			"recordsTotal" => $numRows,
			"recordsFiltered" => $numRows,
			"data" => $userData
		);
	
		echo json_encode($output);
	}
	
	
	
	public function getUserDetails(){		
		if($this->id) {		
			$sqlQuery = "SELECT id, name, email,branch,report_manager, password, create_date, user_type, status 
				FROM ".$this->userTable." 
				WHERE id = '".$this->id."'";
			$result = mysqli_query($this->dbConnect, $sqlQuery);	
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			echo json_encode($row);
		}		
	}
	
	// public function insert() {      
	// 	if($this->userName && $this->email) {		              
	// 		$this->userName = strip_tags($this->userName);			
	// 		$this->newPassword = md5($this->newPassword);			
	// 		$queryInsert = "
	// 			INSERT INTO ".$this->userTable."(name, email,branch,report_manager, user_type, status, password) VALUES(
	// 			'".$this->userName."', '".$this->email."', '".$this->branch."', '".$this->report_manager."', '".$this->role."','".$this->status."', '".$this->newPassword."')";				
	// 		mysqli_query($this->dbConnect, $queryInsert);			
	// 	}
	// }	
	public function insert()
{
    if ($this->userName && $this->email) {
        $queryInsert = "INSERT INTO ".$this->userTable." (name, email, branch, report_manager, user_type, status, password) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($this->dbConnect, $queryInsert);
        mysqli_stmt_bind_param($stmt, "sssssss", $this->userName, $this->email, $this->branch, $this->report_manager, $this->role, $this->status, $this->newPassword);
        mysqli_stmt_execute($stmt);
    }
}
	
	
	public function update() {      
		if($this->updateUserId && $this->userName) {		              
			$this->userName = strip_tags($this->userName);

			$changePassword = '';
			if($this->newPassword) {
				$this->newPassword = md5($this->newPassword);
				$changePassword = ", password = '".$this->newPassword."'";
			}
			
			$queryUpdate = "
				UPDATE ".$this->userTable." 
				SET name = '".$this->userName."', email = '".$this->email."', branch = '".$this->branch."', report_manager = '".$this->report_manager."', user_type = '".$this->role."', status = '".$this->status."' $changePassword
				WHERE id = '".$this->updateUserId."'";				
			mysqli_query($this->dbConnect, $queryUpdate);			
		}
	}	
	
	public function delete() {      
		if($this->deleteUserId) {		          
			$queryUpdate = "
				DELETE FROM ".$this->userTable." 
				WHERE id = '".$this->deleteUserId."'";				
			mysqli_query($this->dbConnect, $queryUpdate);			
		}
	}
	
}