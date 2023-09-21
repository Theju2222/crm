<?php 
include 'init.php'; 
if(!$users->isLoggedIn()) {
	header("Location: login.php");	
}
include('inc/header.php');
$user = $users->getUserInfo();
?>

<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>		
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css" />
<script src="js/general.js"></script>
<script src="js/type.js"></script>
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
				<button type="button" name="add" id="addType" class="btn btn-success btn-xs" style="font-weight: 700; background:#fbad33; padding: 10px 35px; font-size: 12px; line-height:1.5; border-radius: 5px;">Add New Type</button>
			</div>
		</div>
	</div>
			
	<table id="listType" class="table table-bordered table-striped">
		<thead>
			<tr>
				<th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">S/N</th>
				<th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">Type</th>					
				<th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">Status</th>
				<th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; "></th>
				<th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; "></th>									
			</tr>
		</thead>
	</table>
	
	<div id="typeModal" class="modal fade">
		<div class="modal-dialog">
			<form method="post" id="typeForm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"><i class="fa fa-plus"></i> Add Type</h4>
					</div>
					<div class="modal-body">
						<div class="form-group"
							<label for="type" class="control-label">Type</label>
							<input type="text" class="form-control" id="type" name="type" placeholder="type" required>			
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
						<input type="hidden" name="typeId" id="typeId" />
						<input type="hidden" name="action" id="action" value="" />
						<input type="submit" name="save" id="save" class="btn btn-info" value="Save" />
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>	
<?php include('inc/footer.php');?>