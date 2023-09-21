<?php 
include 'init.php'; 
if(!$users->isLoggedIn()) {
	header("Location: authenticate.php");	
}
include('inc/header.php');
$ticketDetails = $tickets->ticketInfo($_GET['id']);
$ticketReplies = $tickets->getTicketReplies($ticketDetails['id']);
$ticketReplies1 = $tickets->getTicketReplies1($ticketDetails['id']);
$ticketReplies2 = $tickets->getTicketReplies2($ticketDetails['id']);
$ticketReplies3 = $tickets->getTicketReplies3($ticketDetails['id']);


$user = $users->getUserInfo();
$tickets->updateTicketReadStatus($ticketDetails['id']);
?>	
<link rel="icon" href="Favicon.ico" type="image/x-icon">
<title>IZB-CRM</title>
<script src="js/general.js"></script>
<script src="js/tickets.js"></script>
<link rel="stylesheet" href="css/style.css" />
<?php include('inc/container.php');?>
<div class="container">
	<div class="row home-sections">
	<img src="images/logo_white.png" alt="" style="
    width: 30vw;">
	<?php include('menus.php'); ?>		
	</div> 
	
	<section class="comment-list">          
		<article class="row">            
			<div class="col-md-10 col-sm-10">
				<div class="panel panel-default arrow left">
					<div class="panel-heading right">
					
			
				
					<div class="panel-body">						
						<div class="comment-post">
						
						<strong>Remarks:</strong> <?php echo $ticketDetails['title']; ?><br>

						
						</p>
						</div>                 
					</div>
		
				</div>			 
			</div>
		</article>		



		<strong>Voice of Customer :</strong><br/>
		<?php foreach ($ticketReplies2 as $replies2) { ?>
    <article class="row">
        <div class="col-md-10 col-sm-10">
            <div class="panel panel-default arrow right">
                <div class="panel-heading">
                    <?php if ($replies2['user_type'] == 'admin') { ?>
                        <span class="glyphicon glyphicon-user"></span> <?php echo $replies2['creater']; ?>
                    <?php } else { ?>
                        <span class="glyphicon glyphicon-user"></span> <?php echo $replies2['creater']; ?>
                    <?php } ?>
                    &nbsp;&nbsp;<span class="glyphicon glyphicon-time"></span> <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> <?php echo $time->ago($replies2['date']); ?></time>
                </div>
                <div class="panel-body">
                    <div class="comment-post">
                        <p>
                            <?php echo $replies2['message2']; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </article>
<?php } ?>

<form method="post" id="ticketReply2">
    <article class="row">
        <div class="col-md-10 col-sm-10">
            <div class="form-group">
                <textarea class="form-control" rows="5" id="message2" name="message2" placeholder="Enter your reply..." required></textarea>
            </div>
        </div>
    </article>
    <article class="row">
        <div class="col-md-10 col-sm-10">
            <div class="form-group">
                <input type="submit" name="reply2" id="reply2" class="btn btn-success" style="background: rgba(177, 0, 0, 1);" value="Reply" />
            </div>
        </div>
    </article>
    <input type="hidden" name="ticketId" id="ticketId" value="<?php echo $ticketDetails['id']; ?>" />
    <input type="hidden" name="action" id="action" value="saveTicketReplies2" />
</form>












		<strong>Action Taken :</strong><br/>
		<?php foreach ($ticketReplies as $replies) { ?>		
			<article class="row">
				<div class="col-md-10 col-sm-10">
					<div class="panel panel-default arrow right">
						<div class="panel-heading">
							<?php if($replies['user_type'] == 'admin') { ?>							
								<span class="glyphicon glyphicon-user"></span> <?php echo $replies['creater']; ?>
							<?php } else { ?>
								<span class="glyphicon glyphicon-user"></span> <?php echo $replies['creater']; ?>
							<?php } ?>
							&nbsp;&nbsp;<span class="glyphicon glyphicon-time"></span> <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> <?php echo $time->ago($replies['date']); ?></time>							
						</div>
						<div class="panel-body">						
							<div class="comment-post">
							<p>
							<?php echo $replies['message']; ?>
							</p>
							</div>                  
						</div>
						
					</div>
				</div>            
			</article> 		
		<?php } ?>
		
		<form method="post" id="ticketReply">
			<article class="row">
				<div class="col-md-10 col-sm-10">				
					<div class="form-group">							
						<textarea class="form-control" rows="5" id="message" name="message" placeholder="Enter your reply..." required></textarea>	
					</div>				
			</div>
			</article>  
			<article class="row">
				<div class="col-md-10 col-sm-10">
					<div class="form-group">							
						<input type="submit" name="reply" id="reply" class="btn btn-success" style="    background: rgba(177, 0, 0, 1);" value="Reply" />		
					</div>
				</div>
			</article> 
			<input type="hidden" name="ticketId" id="ticketId" value="<?php echo $ticketDetails['id']; ?>" />	
			<input type="hidden" name="action" id="action" value="saveTicketReplies" />			
		</form>




		<strong>Feedback From the Concerned Complainant :</strong><br/>
		<?php foreach ($ticketReplies1 as $replies1) { ?>
    <article class="row">
        <div class="col-md-10 col-sm-10">
            <div class="panel panel-default arrow right">
                <div class="panel-heading">
                    <?php if ($replies1['user_type'] == 'admin') { ?>
                        <span class="glyphicon glyphicon-user"></span> <?php echo $replies1['creater']; ?>
                    <?php } else { ?>
                        <span class="glyphicon glyphicon-user"></span> <?php echo $replies1['creater']; ?>
                    <?php } ?>
                    &nbsp;&nbsp;<span class="glyphicon glyphicon-time"></span> <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> <?php echo $time->ago($replies1['date']); ?></time>
                </div>
                <div class="panel-body">
                    <div class="comment-post">
                        <p>
                            <?php echo $replies1['message1']; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </article>
<?php } ?>

<form method="post" id="ticketReply1">
    <article class="row">
        <div class="col-md-10 col-sm-10">
            <div class="form-group">
                <textarea class="form-control" rows="5" id="message1" name="message1" placeholder="Enter your reply..." required></textarea>
            </div>
        </div>
    </article>
    <article class="row">
        <div class="col-md-10 col-sm-10">
            <div class="form-group">
                <input type="submit" name="reply1" id="reply1" class="btn btn-success" style="background: rgba(177, 0, 0, 1);" value="Reply" />
            </div>
        </div>
    </article>
    <input type="hidden" name="ticketId" id="ticketId" value="<?php echo $ticketDetails['id']; ?>" />
    <input type="hidden" name="action" id="action" value="saveTicketReplies1" />
</form>










<strong>Approved By :</strong><br/>
		<?php foreach ($ticketReplies3 as $replies3) { ?>
    <article class="row">
        <div class="col-md-10 col-sm-10">
            <div class="panel panel-default arrow right">
                <div class="panel-heading">
                    <?php if ($replies3['user_type'] == 'admin') { ?>
                        <span class="glyphicon glyphicon-user"></span> <?php echo $replies3['creater']; ?>
                    <?php } else { ?>
                        <span class="glyphicon glyphicon-user"></span> <?php echo $replies3['creater']; ?>
                    <?php } ?>
                    &nbsp;&nbsp;<span class="glyphicon glyphicon-time"></span> <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> <?php echo $time->ago($replies3['date']); ?></time>
                </div>
                <div class="panel-body">
                    <div class="comment-post">
                        <p>
                            <?php echo $replies3['message3']; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </article>
<?php } ?>

<form method="post" id="ticketReply3">
    <article class="row">
        <div class="col-md-10 col-sm-10">
            <div class="form-group">
            <select class="form-control" id="message3" name="message3" required>
                    <option value="" disabled selected>Approved By</option>
                    <option value="Esther">Esther</option>
                    <option value="Linda">Linda</option>
                    <option value="Memory">Memory</option>
         </select>
            </div>
        </div>
    </article>
    <article class="row">
        <div class="col-md-10 col-sm-10">
            <div class="form-group">
                <input type="submit" name="reply3" id="reply3" class="btn btn-success" style="background: rgba(177, 0, 0, 1);" value="Reply" />
            </div>
        </div>
    </article>
    <input type="hidden" name="ticketId" id="ticketId" value="<?php echo $ticketDetails['id']; ?>" />
    <input type="hidden" name="action" id="action" value="saveTicketReplies3" />
</form>











	</section>	
	<?php include('add_ticket_model.php'); ?>
</div>
<?php include('inc/footer.php');?>