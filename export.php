<?php 
include 'init.php'; 
$tickets = new Tickets();
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
<script src="js/general.js"></script>

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
 		



		
    <?php
$ticketData = $tickets->showTickets6();
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Ticket_Report.xls");

echo '<table border="1">';

echo '<tr>';
echo '<th>Date</th>';
echo '<th>Ticket ID	</th>';
echo '<th>NRC Details</th>';
echo '<th>Type of V.O.C</th>';
echo '<th>Account Holder Name</th>';
echo '<th>Account Number</th>';
echo '<th>Phone Number</th>';
echo '<th>Voice of Customer</th>';
echo '<th>Action Taken</th>';
echo '<th>Date Resolved</th>';
echo '<th>FeedBack</th>';
echo '<th>Approved By</th>';
echo '<th>Type</th>';
echo '<th>Sub-Type</th>';
echo '<th>Source</th>';

echo '</tr>';

foreach ($ticketData as $ticket) {
    echo '<tr>';
    echo '<td>' . $ticket['date'] . '</td>';
    echo '<td>' . $ticket['uniqidd'] . '</td>';
    echo '<td>' . $ticket['profilename4'] . '</td>';
    echo '<td>' . $status1 . '</td>';
    echo '<td>' . $ticket['profilename1'] . '</td>';
    echo '<td>' . $ticket['profilename'] . '</td>';
    echo '<td>' . $ticket['profilename2'] . '</td>';
    echo '<td>' . $title . '</td>';
    echo '<td>' . $title1 . $ticket['replyy'] . '</td>';
    echo '<td>' . $time1->ago($ticket['date']) . '</td>';
    echo '<td>' . $title2 . $ticket['replyy1'] . '</td>';
    echo '<td>' . $ticket['replyy3'] . '</td>';
    echo '<td>' . $ticket['type'] . '</td>';
    echo '<td>' . $ticket['subtype'] . '</td>';
    echo '<td>' . $ticket['department'] . '</td>';
    echo '</tr>';
}

echo '</table>';


exit;
?>


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
				data:{action:'listTicket6'},
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