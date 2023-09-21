<?php 
include 'init.php'; 
if(!$users->isLoggedIn()) {
	header("Location: login.php");	
}
include('inc/header.php');
$user = $users->getUserInfo();
?>
<link rel="icon" href="Favicon.ico" type="image/x-icon">
<title>IZB-CRM</title>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>		
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css" />
<script src="js/general.js"></script>
<script src="js/department2.js"></script>
<link rel="stylesheet" href="css/style.css" />
<?php include('inc/container.php');?>
<style>
	div#listDepartment2_filter {
    font-weight: 700;
    white-space: nowrap;
    text-align: end;
    color: rgba(177, 0, 0, 1);
    font-size: 18px;
	margin: 20px 0px 20px 0px;
}

</style>
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
				<button type="button" name="add" id="addDepartment2" class="btn btn-success btn-xs" style="font-weight: 700; background:#fbad33; padding: 10px 35px; font-size: 12px; line-height:1.5; border-radius: 5px;">Add Profile</button>
			</div>
		</div>
	</div>
			
	<table id="listDepartment2" class="table table-bordered table-striped" style="font-size:15px;">
		<thead>
			<tr>
				<th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">SL No</th>
				<th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">Name</th>
				<th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">Account Number</th>			
					<th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">NRC Details</th>	
				<th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">Phone Number</th>					
				<th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">Email</th>	
					<th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">Created At</th>	
				<th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">Status</th>
				<th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; "></th>
				<th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; "></th>									
			</tr>
		</thead>
	</table>
	
	<div id="departmentModal2" class="modal fade">
		<div class="modal-dialog">
			<form method="post" id="departmentForm2">
				<div class="modal-content">
					<div class="modal-header " style="background:
            rgba(177, 0, 0, 1); border: rgba(177, 0, 0, 1);">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4  class="modal-title" style="color:white;"><i class="fa fa-plus"></i> Add Profile</h4>
					</div>
					<div class="modal-body">
					<div class="form-group">
							<label for="acc_num1" class="control-label">Name</label>
							<input type="text" class="form-control" id="acc_num1" name="acc_num1" placeholder="Name" >			
						</div>
						
						<div class="form-group">
							<label for="name1" class="control-label">Account Number</label>
							<input type="text" class="form-control" id="name1" name="name1" placeholder="Account Number" >			
						</div>
							<div class="form-group">
							<label for="nrc" class="control-label">NRC Details</label>
							<input type="text" class="form-control" id="nrc" name="nrc" placeholder="NRC Details" >			
						</div>
						<div class="form-group">
							<label for="phone_num1" class="control-label">Phone Number</label>
							<input type="text" class="form-control" id="phone_num1" name="phone_num1" placeholder="Phone Number" >			
						</div>
						<div class="form-group">
							<label for="email1" class="control-label">Email</label>
							<input type="text" class="form-control" id="email1" name="email1" placeholder="Email" >			
						</div>
						<div class="form-group">
							<label for="status" class="control-label">Status</label>				
							<select id="status" name="status" class="form-control">
							<option value="1">Enable</option>				
							<option value="0">Disable</option>	
							</select>						
						</div>						
						
					</div>
					<div class="modal-footer">
						<input type="hidden" name="departmentId2" id="departmentId2" />
						<input type="hidden" name="action" id="action" value="" />
						<input type="submit" style="background:
            rgba(177, 0, 0, 1); border: rgba(177, 0, 0, 1);" name="save" id="save" class="btn btn-info" value="Save" />
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>	
<?php include('inc/footer.php');?>