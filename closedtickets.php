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
<!-- <script src="js/tickets.js"></script> -->
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
						<th  class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; "></th>
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

<script>
	$(document).ready(function() {     
    $(document).on('submit','#ticketReply', function(event){
		event.preventDefault();
		$('#reply').attr('disabled','disabled');
		var formData = $(this).serialize();
		$.ajax({
			url:"ticket_action.php",
			method:"POST",
			data:formData,
			success:function(data){				
				$('#ticketReply')[0].reset();
				$('#reply').attr('disabled', false);
				location.reload();
			}
		})
	});		
	$(document).on('submit','#ticketReply1', function(event){
		event.preventDefault();
		$('#reply1').attr('disabled','disabled');
		var formData = $(this).serialize();
		$.ajax({
			url:"ticket_action.php",
			method:"POST",
			data:formData,
			success:function(data){				
				$('#ticketReply1')[0].reset();
				$('#reply1').attr('disabled', false);
				location.reload();
			}
		})
	});	
	$(document).on('submit','#ticketReply2', function(event){
		event.preventDefault();
		$('#reply2').attr('disabled','disabled');
		var formData = $(this).serialize();
		$.ajax({
			url:"ticket_action.php",
			method:"POST",
			data:formData,
			success:function(data){				
				$('#ticketReply2')[0].reset();
				$('#reply2').attr('disabled', false);
				location.reload();
			}
		})
	});	
	$(document).on('submit','#ticketReply3', function(event){
		event.preventDefault();
		$('#reply3').attr('disabled','disabled');
		var formData = $(this).serialize();
		$.ajax({
			url:"ticket_action.php",
			method:"POST",
			data:formData,
			success:function(data){				
				$('#ticketReply3')[0].reset();
				$('#reply3').attr('disabled', false);
				location.reload();
			}
		})
	});	
	$('#createTicket').click(function(){
		$('#ticketModal').modal('show');
		$('#ticketForm')[0].reset();
		$('.modal-title').html("<i class='fa fa-plus'></i> Create Ticket");
		$('#action').val('createTicket');
		$('#save').val('Save Ticket');
	});	
	if($('#listTickets').length) {
		var ticketData = $('#listTickets').DataTable({
			
			"lengthChange": false,
			"processing":true,
			"serverSide":true,
			"bInfo": false, //Dont display info e.g. "Showing 1 to 4 of 4 entries"
			"paging": false,
			"order":[],
			"ajax":{
				url:"ticket_action.php",
				type:"POST",
				data:{action:'listTicket5'},
				dataType:"json"
			},
			"columnDefs":[
				{
					"targets":[0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19],
					"orderable":false,
				},
			],
			"pageLength": 10
		});			
		$(document).on('submit','#ticketForm', function(event){
			event.preventDefault();
			$('#save').attr('disabled','disabled');
			var formData = $(this).serialize();
			$.ajax({
				url:"ticket_action.php",
				method:"POST",
				data:formData,
				success:function(data){				
					$('#ticketForm')[0].reset();
					$('#ticketModal').modal('hide');				
					$('#save').attr('disabled', false);
					ticketData.ajax.reload();
				}
			})
		});			
		$(document).on('click', '.update', function(){
			var ticketId = $(this).attr("id");
			var action = 'getTicketDetails';
			$.ajax({
				url:'ticket_action.php',
				method:"POST",
				data:{ticketId:ticketId, action:action},
				dataType:"json",
				success:function(data){
					$('#ticketModal').modal('show');
					$('#ticketId').val(data.id);
					$('#department').val(data.department);
					$('#type').val(data.type);
					$('#subtype').val(data.subtype);
					$('#subject').val(data.title);
					$('#subject1').val(data.title1);
					$('#subject2').val(data.title2);


					if(data.gender == '0') {
						$('#open').prop("checked", true);
					} else if(data.gender == '1') {
						$('#close').prop("checked", true);
					}
					$('.modal-title').html("<i class='fa fa-plus'></i> Edit Ticket");
					$('#action').val('updateTicket');
					$('#save').val('Save Ticket');
				}
			})
		});				
		$(document).on('click', '.delete', function(){
			var ticketId = $(this).attr("id");		
			var action = "closeTicket";
			if(confirm("Are you sure you want to close this ticket?")) {
				$.ajax({
					url:"ticket_action.php",
					method:"POST",
					data:{ticketId:ticketId, action:action},
					success:function(data) {					
						ticketData.ajax.reload();
					}
				})
			} else {
				return false;
			}
		});	
		$(document).on('click', '.open', function(){
			var ticketId = $(this).attr("id");     
			var action = "reopenTicket";
			if(confirm("Are you sure you want to reopen this ticket?")) {
				$.ajax({
					url:"ticket_action.php",
					method:"POST",
					data:{ticketId:ticketId, action:action},
					success:function(data) {                    
						ticketData.ajax.reload();
					}
				})
			} else {
				return false;
			}
		});
    }
});



</script>