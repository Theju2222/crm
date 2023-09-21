<?php 
include 'init.php'; 
if(!$users->isLoggedIn()) {
	header("Location: login.php");	
}
include('inc/header.php');
$user = $users->getUserInfo();
?>
<style>
	div#listUser_filter {
    font-weight: 700;
    white-space: nowrap;
    text-align: end;
    color: rgba(177, 0, 0, 1);
    font-size: 18px;
	margin: 20px 0px 20px 0px;
}

</style>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>		
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css" />
<script src="js/general.js"></script>
<script src="js/user.js"></script>
<link rel="icon" href="Favicon.ico" type="image/x-icon">
<title>IZB-CRM</title>

<link rel="stylesheet" href="css/style.css" />
<?php include('inc/container.php');?>
<div class="container">	
	<div class="row home-sections">
	<img src="images/logo_white.png" alt="" style="
    width: 30vw;">	
	<?php include('menus.php'); ?>		
	</div> 
	
	<div class="panel-heading">
		<div class="row">
			<div class="col-md-10">
				<h3 class="panel-title"></h3>
			</div>
			<div class="col-md-2" align="right">
				<!-- <button type="button" name="add" id="addUser" class="btn btn-success btn-xs">Add New</button> -->
				<button type="button" name="add" id="addUser" class="btn btn-success btn-xs" style="font-weight: 700; background:#fbad33; padding: 10px 35px; font-size: 12px; line-height:1.5; border-radius: 5px;">Add New</button>

			</div>
		</div>
	</div>
			
	<table id="listUser" class="table table-bordered table-striped" style="font-size:15px;">
		<thead>
			<tr>
			<th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">SL No</th>
				<th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">Name</th>					
				<th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">Email</th>
				<th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">Branch</th>
				<th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">Reporting Manager</th>
				<th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">Created</th>
				<th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">Role</th>
				<th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">Status</th>
				<th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; "></th>
				<th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; "></th>			
			</tr>
		</thead>
	</table>
	
	<div id="userModal" class="modal fade">
		<div class="modal-dialog">
			<form method="post" id="userForm">
				<div class="modal-content">
					<div class="modal-header"  style="   background: rgba(177, 0, 0, 1);
    color: white;">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"><i class="fa fa-plus"></i> Add User</h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="username" class="control-label">Name*</label>
							<input type="text" class="form-control" id="userName" name="userName" placeholder="User name" required>			
						</div>
						
						<div class="form-group">
							<label for="username" class="control-label">Email*</label>
							<input type="email" class="form-control" id="email" name="email" placeholder="Email" required>			
						</div>
						<div class="form-group">
							<label for="username" class="control-label">Branch*</label>
							<input type="text" class="form-control" id="branch" name="branch" placeholder="Branch" required>			
						</div>
						<div class="form-group">
							<label for="username" class="control-label">Reporting Manager</label>
							<input type="text" class="form-control" id="report_manager" name="report_manager" placeholder="Reporting Manager" >			
						</div>
						
							<div class="form-group">
							<label for="status" class="control-label">Role</label>				
							<select id="role" name="role" class="form-control">
							<option value="superadmin">Super Admin</option>				

							<option value="admin">Admin</option>				
							<option value="user">Associate</option>	
							<option value="user1">Lead Associate</option>				

							</select>						
						</div>	
						
						<div class="form-group">
							<label for="status" class="control-label">Status</label>				
							<select id="status" name="status" class="form-control">
							<option value="1">Active</option>				
							<option value="0">Inactive</option>	
							</select>						
						</div>

						<div class="form-group">
							<label for="username" class="control-label">New Password</label>
							<input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Password">			
						</div>											
						
					</div>
					<div class="modal-footer">
						<input type="hidden" name="userId" id="userId" />
						<input type="hidden" name="action" id="action" value="" />
						<input type="submit" name="save" id="save" class="btn btn-info" value="Save" style="   background: rgba(177, 0, 0, 1);
    color: white;" />
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>	
<?php include('inc/footer.php');?>