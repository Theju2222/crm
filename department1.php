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
<script src="js/department1.js"></script>
<link rel="stylesheet" href="css/style.css" />
<?php include('inc/container.php');?>
<style>
	div#listDepartment1_filter {
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
			<button type="button" name="add" id="addDepartment1" class="btn btn-success btn-xs" style="font-weight: 700; background:#fbad33; padding: 10px 35px; font-size: 12px; line-height:1.5; border-radius: 5px;">Add Lead</button>
			<!--<a href="export1.php" type="button" class="btn btn-info btn-xs" style="font-weight: 700;  padding: 10px 35px; font-size: 10px; line-height:1.5; border-radius: 5px; margin-top: 1rem;">Export Data</a>-->

				<!-- <button type="button" name="add" id="addDepartment1" class="btn btn-success btn-xs">Add New</button> -->
			</div>
		</div>
	</div>
			
	<table id="listDepartment1" class="table table-bordered table-striped" style="font-size:15px;">
		<thead>
			<tr>
				<th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">SL No</th>
				<th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">Name</th>
				<th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">Account Number</th>					
				<th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">Phone Number</th>					
				<th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">Email</th>					
				<th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">Source</th>					
				<th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">Remarks</th>		
				<th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">Action Taken</th>					

				<th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">Customer Type</th>					
				<th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">Created At</th>
				<th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">Status</th>
				<th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; "></th>
				<th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; "></th>									
			</tr>
		</thead>
	</table>
	
	<div id="departmentModal1" class="modal fade">
		<div class="modal-dialog">
			<form method="post" id="departmentForm1">
				<div class="modal-content">
					<div class="modal-header " style="background:
            rgba(177, 0, 0, 1); border: rgba(177, 0, 0, 1);">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4  class="modal-title" style="color:white;"><i class="fa fa-plus"></i> Add Lead</h4>
					</div>
					<div class="modal-body">
					<div class="form-group">
							<label for="acc_num" class="control-label">Name</label>
							<input type="text" class="form-control" id="acc_num" name="acc_num" placeholder="Name" >			
						</div>
						
						<div class="form-group">
							<label for="name" class="control-label">Account Number</label>
							<input type="text" class="form-control" id="name" name="name" placeholder="Account Number" >			
						</div>
						<div class="form-group">
							<label for="phone_num" class="control-label">Phone Number</label>
							<input type="text" class="form-control" id="phone_num" name="phone_num" placeholder="Phone Number" >			
						</div>
						<div class="form-group">
							<label for="email" class="control-label">Email</label>
							<input type="text" class="form-control" id="email" name="email" placeholder="Email" >			
						</div>
						<div class="form-group">
							<label for="source_type" class="control-label">Source</label>				
							<select id="source_type" name="source_type" class="form-control">
							<option value="whatsapp">Whatsapp</option>	
							<option value="facebook">Facebook</option>		
							<option value="email">Email</option>				
		                    <option value="website">Website</option>	
		                    <option value="call">Call</option>
		                    <option value="branch-walk-in">Branch Walk-In</option>

							</select>						
						</div>	
						<div class="form-group">
							<label for="comments_lead" class="control-label">Remarks</label>
							<input type="text" class="form-control" id="comments_lead" name="comments_lead" placeholder="Remarks" >			
						</div>
						<div class="form-group">
							<label for="comments_lead1" class="control-label">Action Taken</label>
							<input type="text" class="form-control" id="comments_lead1" name="comments_lead1" placeholder="Action Taken" >			
						</div>
						<div class="form-group">
							<label for="cust_type" class="control-label">Customer Type</label>				
							<select id="cust_type" name="cust_type" class="form-control">
							<option value="new">New</option>	
							<option value="existing">Existing</option>				

							</select>						
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
						<input type="hidden" name="departmentId1" id="departmentId1" />
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