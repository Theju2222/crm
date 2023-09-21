<style>
	.navbar-inverse .navbar-nav>.active>a {
	background-color: #fbad33!important;
	height: 53px;
}
.navbar-inverse .navbar-nav>.open>a, .navbar-inverse .navbar-nav>.open>a:focus, .navbar-inverse .navbar-nav>.open>a:hover {
	background-color: #fbad33!important ;

}

</style>


<nav class="navbar navbar-inverse" style="background:rgba(177, 0, 0, 1);;color:#ffffff;font-weight:bold;">
	<div class="container-fluid">		
		<ul class="nav navbar-nav menus" >
		<ul class="nav navbar-nav menus">
    <?php if (isset($_SESSION["admin"])) { ?>
        <li id="dashboard"><a style="font-size:18px; color: #ffffff;" href="dashboard.php" class="navbar-brand text-white">Dashboard</a></li>
        <li id="department2"><a style="font-size:18px; color: #ffffff;" href="department2.php">Profile</a></li>
        <li id="ticket"><a style="font-size:18px; color: #ffffff;" href="ticket.php">Ticket</a></li>
        <li id="department1"><a style="font-size:18px; color: #ffffff;" href="department1.php">Leads</a></li>
        <li id="ticket_download"><a style="font-size:18px; color: #ffffff;" href="ticket_download.php"><img src="https://techrowth.s3.eu-north-1.amazonaws.com/images/download.png" alt="" style="width: 1.2vw;"></a></li>

		
   
    <?php } elseif (isset($_SESSION["user1"])) { ?>
        <li id="department1"><a style="font-size:18px; color: #ffffff;" href="department1.php">Leads</a></li>
	<?php } elseif (isset($_SESSION["superadmin"])) { ?>
		<li id="dashboard"><a style="font-size:18px; color: #ffffff;" href="dashboard.php" class="navbar-brand text-white">Dashboard</a></li>
        <li id="department2"><a style="font-size:18px; color: #ffffff;" href="department2.php">Profile</a></li>
        <li id="ticket"><a style="font-size:18px; color: #ffffff;" href="ticket.php">Ticket</a></li>
        <li id="department1"><a style="font-size:18px; color: #ffffff;" href="department1.php">Leads</a></li>
        <li id="type"><a style="font-size:18px; color: #ffffff;" href="type.php">Type</a></li>
        <li id="subtype"><a style="font-size:18px; color: #ffffff;" href="subtype.php">Sub-Type</a></li>
        <li id="user"><a style="font-size:18px; color: #ffffff;" href="user.php">Users</a></li>
        <li id="ticket_download"><a style="font-size:18px; color: #ffffff;" href="ticket_download.php"><img src="https://techrowth.s3.eu-north-1.amazonaws.com/images/download.png" alt="" style="width: 1.2vw;"></a></li>

    <?php } elseif (isset($_SESSION["user"])) { ?>
        <li id="department2"><a style="font-size:18px; color: #ffffff;" href="department2.php">Profile</a></li>
        <li id="department1"><a style="font-size:18px; color: #ffffff;" href="department1.php">Leads</a></li>
    <?php } ?>
</ul>
				
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" style="font-size:18px; color: #ffffff;" data-toggle="dropdown"><span class="label label-pill label-danger count"></span> 
				<img src="images/profile.png" style="width: 20px;
    margin-right: 7px;" alt=""><?php if(isset($_SESSION["userid"])) { echo $user['name']; } ?>
			</a>
				<ul class="dropdown-menu">					
					<li><a href="logout.php">Logout</a></li>
				</ul>
			</li>
		</ul>
	</div>
</nav>

