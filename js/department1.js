$(document).ready(function() {        
	if($('#listDepartment1').length) {
	var departmentData1 = $('#listDepartment1').DataTable({
		
		// "searching": false,
		"lengthChange": false,
		"processing":true,
		"serverSide":true,
		"bInfo": false, //Dont display info e.g. "Showing 1 to 4 of 4 entries"
		"paging": false,

		"order":[],
		"ajax":{
			url:"department_action1.php",
			type:"POST",
			data:{action:'listDepartment1'},
			dataType:"json"
		},
		"columnDefs":[
			{
				"targets":[0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
				"orderable":false,
			},
		],
		"pageLength": 10
	});	

	$(document).on('click', '.update', function(){
		var departmentId1 = $(this).attr("id");
		var action = 'getDepartmentDetails1';
		$.ajax({
			url:'department_action1.php',
			method:"POST",
			data:{departmentId1:departmentId1, action:action},
			dataType:"json",
			success:function(data){
				$('#departmentModal1').modal('show');
				$('#departmentId1').val(data.id);
				$('#name').val(data.name);
				$('#acc_num').val(data.acc_num);
				$('#phone_num').val(data.phone_num);
				$('#email').val(data.email);
				$('#source_type').val(data.source_type);
				$('#comments_lead').val(data.comments_lead);
				$('#comments_lead1').val(data.comments_lead1);

				$('#cust_type').val(data.cust_type);			
				$('#status').val(data.status);				
				$('.modal-title').html("<i class='fa fa-plus'></i> Edit Lead");
				$('#action').val('updateDepartment1');
				$('#save').val('Save');
			}
		})
	});		
	
	$('#addDepartment1').click(function(){
		$('#departmentModal1').modal('show');
		$('#departmentForm1')[0].reset();
		$('.modal-title').html("<i class='fa fa-plus'></i> Add Lead");
		$('#action').val('addDepartment1');
		$('#save').val('Save');
	});	
		
	$(document).on('submit','#departmentForm1', function(event){
		event.preventDefault();
		$('#save').attr('disabled','disabled');
		var formData = $(this).serialize();
		$.ajax({
			url:"department_action1.php",
			method:"POST",
			data:formData,
			success:function(data){				
				$('#departmentForm1')[0].reset();
				$('#departmentModal1').modal('hide');				
				$('#save').attr('disabled', false);
				departmentData1.ajax.reload();
			}
		})
	});			
			
	$(document).on('click', '.delete', function(){
		var departmentId1 = $(this).attr("id");		
		var action = "deleteDepartment1";
		if(confirm("Are you sure you want to delete this record?")) {
			$.ajax({
				url:"department_action1.php",
				method:"POST",
				data:{departmentId1:departmentId1, action:action},
				success:function(data) {					
					departmentData1.ajax.reload();
				}
			})
		} else {
			return false;
		}
	});	
}
});

