<div id="ticketModal" class="modal fade text-center">
	<div class="modal-dialog"  style="width: 60%;">
	<form method="post" id="ticketForm" style="display: flex;">

	<div class="col-md-6 side-image justify-content-center" style="width: 40%; background-image: url(images/Frame_3.png); background-position: center; background-size: cover; background-repeat: no-repeat; position: relative;">
                </div>
			<div class="modal-content" style="width: 60%; border-radius: 0; background-image: url(images/Group35.png); background-position: center; background-size: cover; background-repeat: no-repeat; position: relative;">
			<div class="test">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title text-center" style="font-size: 25px; color:  rgba(177, 0, 0, 1); font-weight: 800;">Created Ticket</h4>
					<div class="icon">
					<img src="images/icon1.png" alt="" style="width: 12vw;">
					</div>
					<label for="status" class="control-label text-center" style="color: rgba(118, 118, 118, 1);">Check For Details</label>							

				
				</div>



<div class="modal-body">
<div class="form-group">
						<label for="profile" class="control-label" style="color: rgba(118, 118, 118, 1)">Account Details</label>							
						<select id="profile" name="profile" class="form-control" placeholder="profile...">
							<?php $tickets->getProfiles($departmentDetails2['id']); ?>
						</select>									
					</div>	

				<div class="test1" style="display: flex; gap:10px;">
				
<div class="form-group" style="width: 18vw;">						<label for="department" class="control-label" style="color: rgba(118, 118, 118, 1)">Source</label>							
						<select id="department" name="department" class="form-control" placeholder="Department...">					
							<?php $tickets->getDepartments(); ?>
						</select>						
					</div>						
					<div class="form-group" style="width: 18vw;">
						<label for="type" class="control-label" style="color: rgba(118, 118, 118, 1)">Type</label>							
						<select id="type" name="type" class="form-control" placeholder="type...">					
							<?php $tickets->getTypes(); ?>
						</select>						
					</div>	
				<div class="form-group" style="width: 18vw;">
						<label for="subtype" class="control-label" style="color: rgba(118, 118, 118, 1)">Sub-Type</label>							
						<select id="subtype" name="subtype" class="form-control" placeholder="subtype...">					
							<?php $tickets->getSubtypes(); ?>
						</select>						
					</div>	
								
					
				</div>
				<div class="form-group">
								
						<label class="radio-inline">
							<input type="radio" name="status1" id="open" value="0"  required>Query
						</label>
							<label class="radio-inline">
							<input type="radio" name="status1" id="progress" value="1" required>Complaint
						</label>
						<label class="radio-inline">
							<input type="radio" name="status1" id="escaltion" value="2" required>Request 
						</label>
					
					</div>
				</div>
				<div class="form-group" style=" margin-left: 20px;
        margin-right: 20px;">
						<label for="subject" class="control-label" style="color: rgba(118, 118, 118, 1)">Brief Nature of Complaint / Suggestion</label>
						<textarea class="form-control" id="subject" row="3" name="subject" placeholder="Brief Nature of Complaint/ Suggestion" required style=""></textarea>
	
				</div>
				<div class="form-group" style=" margin-left: 20px; margin-right: 20px;">
						<label for="subject1" class="control-label" style="color: rgba(118, 118, 118, 1)">Action Taken</label>
						<textarea class="form-control" id="subject1" row="3" name="subject1" placeholder="Action Taken"  style=""></textarea>
	
				</div>
				<div class="form-group" style=" margin-left: 20px; margin-right: 20px;">
						<label for="subject2" class="control-label" style="color: rgba(118, 118, 118, 1)">Feedback From the Concerned Complainant</label>
						<textarea class="form-control" id="subject2" row="3" name="subject2" placeholder="Feedback From the Concerned Complainant"  style=""></textarea>
	
				</div>
				<div class="form-group">
						<label for="status" class="control-label" style="color: rgba(118, 118, 118, 1);">Ticket Status: </label>							
						<label class="radio-inline">
							<input type="radio" name="status" id="open" value="0" checked required>Open
						</label>
							<label class="radio-inline">
							<input type="radio" name="status" id="progress" value="3" required>In Progress
						</label>
						<label class="radio-inline">
							<input type="radio" name="status" id="escaltion" value="2" required>Escaltion
						</label>
						
					
							<label class="radio-inline">
								<input type="radio" name="status" id="close" value="1" required>Close
							</label>
					
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="ticketId" id="ticketId" />
					<input type="hidden" name="action" id="action" value="" />
					<button type="submit" name="save" id="save" value="Save"  class="btn btn-info" style="background:
            rgba(177, 0, 0, 1); border: rgba(177, 0, 0, 1);">Submit</button>
					
					</div>
			</div>
			</div>
		</form>
	</div>
</div>