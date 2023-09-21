$(document).ready(function() {        
	
	var subtypeData = $('#listSubtype').DataTable({
		"searching": false,
		"bInfo": false, //Dont display info e.g. "Showing 1 to 4 of 4 entries"
		"paging": false,
		"lengthChange": false,
		"processing":true,
		"serverSide":true,
		"order":[],
		"ajax":{
			url:"subtype_action.php",
			type:"POST",
			data:{action:'listSubtype'},
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
		var subtypeId = $(this).attr("id");
		var action = 'getSubtypeDetails';
		$.ajax({
			url:'subtype_action.php',
			method:"POST",
			data:{subtypeId:subtypeId, action:action},
			dataType:"json",
			success:function(data){
				$('#subtypeModal').modal('show');
				$('#subtypeId').val(data.id);
				$('#subtype').val(data.name);
				$('#status').val(data.status);				
				$('.modal-title').html("<i class='fa fa-plus'></i> Edit Subtype");
				$('#action').val('updateSubtype');
				$('#save').val('Save');
			}
		})
	});		
	
	$('#addSubtype').click(function(){
		$('#subtypeModal').modal('show');
		$('#subtypeForm')[0].reset();
		$('.modal-title').html("<i class='fa fa-plus'></i> Add subtype");
		$('#action').val('addSubtype');
		$('#save').val('Save');
	});	
		
	$(document).on('submit','#subtypeForm', function(event){
		event.preventDefault();
		$('#save').attr('disabled','disabled');
		var formData = $(this).serialize();
		$.ajax({
			url:"subtype_action.php",
			method:"POST",
			data:formData,
			success:function(data){				
				$('#subtypeForm')[0].reset();
				$('#subtypeModal').modal('hide');				
				$('#save').attr('disabled', false);
				subtypeData.ajax.reload();
			}
		})
	});			
			
	$(document).on('click', '.delete', function(){
		var subtypeId = $(this).attr("id");		
		var action = "deleteSubtype";
		if(confirm("Are you sure you want to delete this record?")) {
			$.ajax({
				url:"subtype_action.php",
				method:"POST",
				data:{subtypeId:subtypeId, action:action},
				success:function(data) {					
					subtypeData.ajax.reload();
				}
			})
		} else {
			return false;
		}
	});	
    
});

