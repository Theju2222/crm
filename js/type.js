$(document).ready(function() {        
	
	var typeData = $('#listType').DataTable({
	    "searching": false,
		"bInfo": false, //Dont display info e.g. "Showing 1 to 4 of 4 entries"
		"paging": false,
		"lengthChange": false,
		"processing":true,
		"serverSide":true,
		"order":[],
		"ajax":{
			url:"type_action.php",
			type:"POST",
			data:{action:'listType'},
			dataType:"json"
		},
		"columnDefs":[
			{
				"targets":[0, 1, 2, 3, 4],
				"orderable":false,
			},
		],
		"pageLength": 10
	});	

	$(document).on('click', '.update', function(){
		var typeId = $(this).attr("id");
		var action = 'getTypeDetails';
		$.ajax({
			url:'type_action.php',
			method:"POST",
			data:{typeId:typeId, action:action},
			dataType:"json",
			success:function(data){
				$('#typeModal').modal('show');
				$('#typeId').val(data.id);
				$('#type').val(data.name);
				$('#status').val(data.status);				
				$('.modal-title').html("<i class='fa fa-plus'></i> Edit Type");
				$('#action').val('updateType');
				$('#save').val('Save');
			}
		})
	});		
	
	$('#addType').click(function(){
		$('#typeModal').modal('show');
		$('#typeForm')[0].reset();
		$('.modal-title').html("<i class='fa fa-plus'></i> Add type");
		$('#action').val('addType');
		$('#save').val('Save');
	});	
		
	$(document).on('submit','#typeForm', function(event){
		event.preventDefault();
		$('#save').attr('disabled','disabled');
		var formData = $(this).serialize();
		$.ajax({
			url:"type_action.php",
			method:"POST",
			data:formData,
			success:function(data){				
				$('#typeForm')[0].reset();
				$('#typeModal').modal('hide');				
				$('#save').attr('disabled', false);
				typeData.ajax.reload();
			}
		})
	});			
			
	$(document).on('click', '.delete', function(){
		var typeId = $(this).attr("id");		
		var action = "deleteType";
		if(confirm("Are you sure you want to delete this record?")) {
			$.ajax({
				url:"type_action.php",
				method:"POST",
				data:{typeId:typeId, action:action},
				success:function(data) {					
					typeData.ajax.reload();
				}
			})
		} else {
			return false;
		}
	});	
    
});

