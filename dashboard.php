<?php 
include 'init.php'; 
if(!$users->isLoggedIn()) {
	header("Location: login.php");	
}
include('inc/header.php');
$user = $users->getUserInfo();
$tickets = new Tickets();
$openTicketCount = $tickets->getOpenTicketCount();
$closedTicketCount = $tickets->getClosedTicketCount();
$escalationTicketCount = $tickets->getEscalationTicketCount();
$progressTicketCount = $tickets->getProgressTicketCount();


?>
<link rel="icon" href="Favicon.ico" type="image/x-icon">
<title>IZB-CRM</title>

<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>		
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css" />
<script src="js/general.js"></script>
<script src="js/tickets.js"></script>
<link rel="stylesheet" href="css/main.css" />
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
	<div class="row">

	</div>
	<?php include('menus.php'); ?>		
	</div> 
    <div class="row">
    
    <a href="ticket.php">
    <div class="col-lg-4" style="width: 24.333333%!important;">
                    <div class="card card-body mb-4">
                        <article class="icontext">
                            <div class="text">
                                <h3 class="mb-1 card-title">Total Tickets</h3>
                                <span><?php
                                $tickets = new Tickets();
                                $count = $tickets->getTicketCount();
                                echo " " . $count;
                                ?></span>
                            </div>
                        </article>
                    </div>
                </div>
                    </a>
</div>
    <div class="row">
    
<a href="openedtickets.php">
<div class="col-lg-4" style="width: 24.333333%!important;">
                <div class="card card-body mb-4">
                    <article class="icontext">
                        <div class="text">
                            <h3 class="mb-1 card-title">Open Tickets</h3>
                            <span><?php echo $openTicketCount; ?></span>
                        </div>
                    </article>
                </div>
            </div>
                </a>
                <a href="inprogresstickets.php">
                <div class="col-lg-4" style="width: 24.333333%!important;">
                    <div class="card card-body mb-4">
                        <article class="icontext">
                         
                            <div class="text">
                                <h3 class="mb-1 card-title">In Progress Tickets</h3> <span><?php echo $progressTicketCount; ?></span>
                           
                            </div>
                        </article>
                    </div>
                </div>
                </a>
<a href="closedtickets.php">
<div class="col-lg-4" style="width: 24.333333%!important;">
                    <div class="card card-body mb-4">
                        <article class="icontext">
                         
                            <div class="text">
                                <h3 class="mb-1 card-title">Closed Tickets</h3> <span><?php echo $closedTicketCount; ?></span>
                           
                            </div>
                        </article>
                    </div>
                </div>
                </a>
<!-- <a href="ticket.php?resolved=2"> -->
<a href="escalationtickets.php">

<div class="col-lg-4" style="width: 24.333333%!important;">
                    <div class="card card-body mb-4">
                        <article class="icontext">
                          
                            <div class="text">
                                <h3 class="mb-1 card-title">Escalation Tickets</h3> <span><?php echo $escalationTicketCount; ?></span>
                              
                            </div>
                        </article>
                    </div>
                </div>
</a>
 </div>
 <div class="row">
 <a href="department2.php">
 <div class="col-lg-4" style="width: 24.333333%!important;">
                    <div class="card card-body mx-3">
                        <article class="icontext">
                    
                            <div class="text">
                                <h3 class="mb-1 card-title">Total Profiles</h3>
                                <span>
                                <?php
                                $department2 = new Department2();
                                $count = $department2->getDepartment2Count();
                                echo " " . $count;
                                ?>
                                </span>
                               
                            </div>
                        </article>
                    </div>
                </div>
</a>
<a href="department1.php">
<div class="col-lg-4" style="width: 24.333333%!important;">
                    <div class="card card-body mb-4">
                        <article class="icontext">
                         
                            <div class="text">
                                <h3 class="mb-1 card-title">Total Leads</h3> <span>
                                <?php
                                $department1 = new Department1();
                                $count = $department1->getDepartment1Count();
                                echo " " . $count;
                                ?>
                                </span>
                           
                            </div>
                        </article>
                    </div>
                </div>
                </a>
<a href="user.php">
                <div class="col-lg-4" style="width: 24.333333%!important;">
                    <div class="card card-body mb-4">
                        <article class="icontext">
                          
                            <div class="text">
                                <h3 class="mb-1 card-title">Total Users</h3> <span>
                                <?php
                                $users = new Users();
                                $count = $users->getUserCount();
                                echo " " . $count;
                                ?>
                                </span>
                              
                            </div>
                        </article>
                    </div>
                </div>
</a>
 </div>
</div>	
<?php include('inc/footer.php');?>