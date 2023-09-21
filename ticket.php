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
<script src="js/tickets.js"></script>
<link rel="stylesheet" href="css/style.css" />
<style>
	div#listTickets_filter {
    font-weight: 700;
    white-space: nowrap;
    text-align: end;
    color: rgba(177, 0, 0, 1);
    font-size: 18px;
	margin: 20px 0px 20px 0px;
}

</style>
<?php include('inc/container.php');?>
<div class="container">	
	<div class="row home-sections">
<img src="images/logo_white.png" alt="" style="
    width: 30vw;">	
	<?php include('menus.php'); ?>		
	</div> 
	<div class="" style=" width:1120px;">    		
		<!-- <p>View and manage tickets that may have responses from support team.</p>	 -->

		<div class="panel-heading">
			<div class="row">
				<div class="col-md-10">
					<h3 class="panel-title"></h3>
				</div>
				<div class="col-md-2" >
				<!--<button type="button" name="add" id="createTicket" class="btn btn-success btn-xs" style="font-weight: 700; background:#fbad33; padding: 10px 35px; font-size: 10px; line-height:1.5; border-radius: 5px;">Create Ticket</button>-->

				</div>
			</div>
		</div>
<table id="listTickets" class="table table-bordered table-striped"  style="font-size:11px; width:1120px;">

			<thead>
				<tr>
					<!--<th  class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">S/N</th>-->
					<th  class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">Ticket ID</th>
					<th  class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">Account Holder Name</th>		
					<th  class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">Account Number</th>
					<th  class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">Phone Number</th>
					<!--<th  class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">Email ID</th>-->
					<th  class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">NRC Details</th>
					<th  class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">Source</th>
					<th  class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">Type</th>
					<th  class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">Sub-Type</th>
					<th  class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">Voice of Customer</th>
					<th  class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">Action Taken</th>
					<th  class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">FeedBack</th>
					<th  class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">Approved By</th>


					<th  class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">Created By</th>		
					<th  class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">Branch</th>					
					<th  class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">Reporting Manager</th>					
					<th  class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">Created At</th>	
						<th  class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">Type of V.O.C</th>
					<th  class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">Status</th>
					<th  class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; "></th>				
					<th  class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; "></th>
					<th  class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; "></th>
					<th  class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; "></th>					
				</tr>
			</thead>
		</table>
	</div>
	<?php include('add_ticket_model.php'); ?>
</div>	
<?php include('inc/footer.php');?>