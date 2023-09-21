<?php
include 'init.php';
if (!$users->isLoggedIn()) {
    header("Location: authenticate.php");
}
include('inc/header.php');
$departmentDetails2 = $department2->getDepartmentInfo($_GET['id']);
$user = $users->getUserInfo();
?>
<link rel="icon" href="Favicon.ico" type="image/x-icon">
<title>IZB-CRM</title>

<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css" />
<script src="js/general.js"></script>

<link rel="stylesheet" href="css/style.css" />
<?php include('inc/container.php'); ?>
<div class="container">
    <div class="row home-sections">
        <img src="images/logo_white.png" alt="" style="
            width: 30vw;">
        <?php include('menus.php'); ?>
    </div>

    <section class="comment-list">
        <article class="row">
            <div class="col-md-10 col-sm-10">
                <div class=" arrow left">
                    <div class="panel-heading right">

                        <div class="panel-body">
                            <div class="comment-post">
                                <p>
                                    <strong>Name:</strong> <?php echo $departmentDetails2['acc_num1']; ?><br>
                                    <strong>Account Number:</strong> <?php echo $departmentDetails2['name1']; ?><br>
                                    <strong>NRC Details:</strong> <?php echo $departmentDetails2['nrc']; ?><br>
                                    <strong>Phone Number:</strong> <?php echo $departmentDetails2['phone_num1']; ?><br>
                                    <strong>Email:</strong> <?php echo $departmentDetails2['email1']; ?><br>
                                </p>
                            </div>
                        </div>
                        <div class="" style=" width:1120px;">

                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-md-10">
                                        <h3 class="panel-title"></h3>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" name="add" id="createTicket" class="btn btn-success btn-xs" style="font-weight: 700; background:#fbad33; padding: 10px 35px; font-size: 10px; line-height:1.5; border-radius: 5px;">Create Ticket</button>

                                    </div>
                                </div>
                            </div>
                            <table id="listTickets" class="table table-bordered table-striped" style="font-size:11px; width:1120px; display:none;"></table>
                        </div>
                        <table id="" class="table table-bordered table-striped" style="font-size:11px; width:1120px;">

                            <thead>
                                <tr>
                                    <!--<th  class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">S/N</th>-->
                                    <th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">Ticket ID</th>
                                    <th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">Account Holder Name</th>
                                    <th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">Account Number</th>
                                    <th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">Phone Number</th>
                                    <!--<th  class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">Email ID</th>-->
                                    <th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">NRC Details</th>
                                    <th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">Source</th>
                                    <th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">Type</th>
                                    <th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">Sub-Type</th>
                                    <th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">Voice of Customer</th>
                                    <th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">Action Taken</th>
                                    <th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">FeedBack</th>
                                    <th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">Approved By</th>


                                    <th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">Created By</th>
                                    <th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">Branch</th>
                                    <th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">Reporting Manager</th>
                                    <th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">Created At</th>
                                    <th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">Type of V.O.C</th>
                                    <th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">Status</th>
                                    <th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; "></th>
                                   <th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; "></th>
                                           <th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; "></th>    
                                           <th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; "></th>
                                     <!-- <th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; "></th>
                                    <th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; "></th>
                                    <th class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; "></th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <!--<th  class="text-center" style="background:rgba(177, 0, 0, 1); color:#ffffff; ">S/N</th>-->
                                    <th class="text-center"><?php echo $departmentDetails2['sdss']; ?></th>
                                    <th class="text-center"><?php echo $departmentDetails2['acc_num1']; ?></th>
                                    <th class="text-center"><?php echo $departmentDetails2['name1']; ?></th>
                                    <th class="text-center"><?php echo $departmentDetails2['phone_num1']; ?></th>
                                    <th class="text-center"><?php echo $departmentDetails2['nrc']; ?></th>
                                    <th class="text-center"><?php echo $departmentDetails2['department']; ?></th>
                                    <th class="text-center"><?php echo $departmentDetails2['type']; ?></th>
                                    <th class="text-center"><?php echo $departmentDetails2['subtype']; ?></th>
                                    <th class="text-center"><?php echo $departmentDetails2['sdss1']; ?><br/><?php echo $departmentDetails2['replyy2']; ?><a href="view_comments.php?id=<?php echo $departmentDetails2['sdss']; ?>" class="btn btn-primary active btn-xs update">View All Remarks</a></th>
                                    <th class="text-center"><?php echo $departmentDetails2['sdss2']; ?><br/><?php echo $departmentDetails2['replyy']; ?></th>
                                    <th class="text-center"><?php echo $departmentDetails2['sdss3']; ?><br/><?php echo $departmentDetails2['replyy1']; ?></th>
                                    <th class="text-center"><?php echo $departmentDetails2['replyy3']; ?></th>

                                    <th class="text-center"><?php echo $departmentDetails2['creater']; ?></th>
                                    <th class="text-center"><?php echo $departmentDetails2['createrbranch']; ?></th>
                                    <th class="text-center"><?php echo $departmentDetails2['creatermanager']; ?></th>
                                    <th class="text-center"><?php echo $time->ago($departmentDetails2['sdss4']); ?></th>
                     
									
                            <th class="text-center">
										<?php
										$status1 = '';
										if($departmentDetails2['sdss7'] == 0)	{
											$status1 = '<span class="label label-info">Query</span>';
										} else if($departmentDetails2['sdss7'] == 1) {
											$status1 = '<span class="label label-info">Complaint</span>';			
										} else if($departmentDetails2['sdss7'] == 2) {
											$status1 = '<span class="label label-info">Request</span>';
										}	
										echo $status1;
										?>
									</th>
									<th class="text-center">
										<?php
										$status = '';
										if ($departmentDetails2['sdss6'] == 0) {
											$status = '<span class="label label-success">Open</span>';
										} else if ($departmentDetails2['sdss6'] == 3) {
											$status = '<span class="label label-primary">In Progress</span>';
										} else if ($departmentDetails2['sdss6'] == 2) {
											$status = '<span class="label label-warning">Escalation</span>';
										} else if ($departmentDetails2['sdss6'] == 1) {
											$status = '<span class="label label-danger">Closed</span>';
										}
										echo $status;
										?>
									</th>
									<th class="text-center"><a href="view_ticket.php?id=<?php echo $departmentDetails2['sdss']; ?>" class="btn btn-success btn-xs update">View Ticket</a></th>
                                    <th class="text-center"><button type="button" name="update" id="<?php echo $departmentDetails2['tid']; ?>" class="btn btn-warning btn-xs update">Edit</button></th>
                                    <th class="text-center"><button type="button" name="open" id="<?php echo $departmentDetails2['tid']; ?>" class="btn btn-success btn-xs open">Re-Open</button></th>
                                    <th class="text-center"><button type="button" name="delete" id="<?php echo $departmentDetails2['tid']; ?>" class="btn btn-danger btn-xs delete" >Close</button></th>
                                </tr>
                            </tbody>
                        </table>
                        <?php include('add_ticket_model.php'); ?>
                    </div>
                </div>
            </div>
        </article>
    </section>

</div>
<?php include('inc/footer.php'); ?>

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
        $('#createTicket').click(function() {
            $('#ticketModal').modal('show');
            $('#ticketForm')[0].reset();
            $('.modal-title').html("<i class='fa fa-plus'></i> Create Ticket");
            $('#action').val('createTicket');
            $('#save').val('Save Ticket');
        });
        if ($('#listTickets').length) {
            var ticketData = $('#listTickets').DataTable({

                "lengthChange": false,
                "searching": false,

                "processing": true,
                "serverSide": true,
                "bInfo": false, //Dont display info e.g. "Showing 1 to 4 of 4 entries"
                "paging": false,
                "order": [],
                "ajax": {
                    url: "ticket_action.php",
                    type: "POST",
                    data: {
                        action: 'listTicket1'
                    },
                    dataType: "json"
                },
                "columnDefs": [{
                    "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
                    "orderable": false,
                }, ],
                "pageLength": 10
            });
            $(document).on('submit', '#ticketForm', function(event) {
                event.preventDefault();
                $('#save').attr('disabled', 'disabled');
                var formData = $(this).serialize();
                $.ajax({
                    url: "ticket_action.php",
                    method: "POST",
                    data: formData,
                    success: function(data) {
                        $('#ticketForm')[0].reset();
                        $('#ticketModal').modal('hide');
                        $('#save').attr('disabled', false);
                        ticketData.ajax.reload();
                    }
                })
            });
            $(document).on('click', '.update', function() {
                var ticketId = $(this).attr("id");
                var action = 'getTicketDetails';
                $.ajax({
                    url: 'ticket_action.php',
                    method: "POST",
                    data: {
                        ticketId: ticketId,
                        action: action
                    },
                    dataType: "json",
                    success: function(data) {
                        $('#ticketModal').modal('show');
                        $('#ticketId').val(data.id);
                        $('#department').val(data.department);
                        $('#type').val(data.type);
                        $('#subtype').val(data.subtype);
                        $('#subject').val(data.title);
                        $('#subject1').val(data.title1);
                        $('#subject2').val(data.title2);


                        if (data.gender == '0') {
                            $('#open').prop("checked", true);
                        } else if (data.gender == '1') {
                            $('#close').prop("checked", true);
                        }
                        $('.modal-title').html("<i class='fa fa-plus'></i> Edit Ticket");
                        $('#action').val('updateTicket');
                        $('#save').val('Save Ticket');
                    }
                })
            });
            $(document).on('click', '.delete', function() {
                var ticketId = $(this).attr("id");
                var action = "closeTicket";
                if (confirm("Are you sure you want to close this ticket?")) {
                    $.ajax({
                        url: "ticket_action.php",
                        method: "POST",
                        data: {
                            ticketId: ticketId,
                            action: action
                        },
                        success: function(data) {
                            ticketData.ajax.reload();
                        }
                    })
                } else {
                    return false;
                }
            });
            $(document).on('click', '.open', function() {
                var ticketId = $(this).attr("id");
                var action = "reopenTicket";
                if (confirm("Are you sure you want to reopen this ticket?")) {
                    $.ajax({
                        url: "ticket_action.php",
                        method: "POST",
                        data: {
                            ticketId: ticketId,
                            action: action
                        },
                        success: function(data) {
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
