$(document).ready(function() {        
	if($('#listDepartment2').length) {
	var departmentData2 = $('#listDepartment2').DataTable({
		
		// "searching": false,
		"lengthChange": false,
		"processing":true,
		"serverSide":true,
		"bInfo": false, //Dont display info e.g. "Showing 1 to 4 of 4 entries"
		"paging": false,

		"order":[],
		"ajax":{
			url:"department_action2.php",
			type:"POST",
			data:{action:'listDepartment2'},
			dataType:"json"
		},
		"columnDefs":[
			{
				"targets":[0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
				"orderable":false,
			},
		],
		"pageLength": 10
	});	

	$(document).on('click', '.update', function(){
		var departmentId2 = $(this).attr("id");
		var action = 'getDepartmentDetails2';
		$.ajax({
			url:'department_action2.php',
			method:"POST",
			data:{departmentId2:departmentId2, action:action},
			dataType:"json",
			success:function(data){
				$('#departmentModal2').modal('show');
				$('#departmentId2').val(data.id);
				$('#name1').val(data.name1);
				$('#acc_num1').val(data.acc_num1);
				$('#nrc').val(data.nrc);
				$('#phone_num1').val(data.phone_num1);
				$('#email1').val(data.email1);
				$('#status').val(data.status);				
				$('.modal-title').html("<i class='fa fa-plus'></i> Edit Profile");
				$('#action').val('updateDepartment2');
				$('#save').val('Save');
			}
		})
	});		
	
	$('#addDepartment2').click(function(){
		$('#departmentModal2').modal('show');
		$('#departmentForm2')[0].reset();
		$('.modal-title').html("<i class='fa fa-plus'></i> Add Profile");
		$('#action').val('addDepartment2');
		$('#save').val('Save');
	});	
		
	$(document).on('submit','#departmentForm2', function(event){
		event.preventDefault();
		$('#save').attr('disabled','disabled');
		var formData = $(this).serialize();
		$.ajax({
			url:"department_action2.php",
			method:"POST",
			data:formData,
			success:function(data){				
				$('#departmentForm2')[0].reset();
				$('#departmentModal2').modal('hide');				
				$('#save').attr('disabled', false);
				departmentData2.ajax.reload();
			}
		})
	});			
			
	$(document).on('click', '.delete', function(){
		var departmentId2 = $(this).attr("id");		
		var action = "deleteDepartment2";
		if(confirm("Are you sure you want to delete this record?")) {
			$.ajax({
				url:"department_action2.php",
				method:"POST",
				data:{departmentId2:departmentId2, action:action},
				success:function(data) {					
					departmentData2.ajax.reload();
				}
			})
		} else {
			return false;
		}
	});	
}
});

