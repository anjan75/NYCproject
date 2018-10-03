
$(document).ready(function(){
	var base_url = $('#base_url').text();
	$(".add-row").click(function(){
 	    var tb =  $("table tbody");
 	    if (tb.children().length == 0) {
 	    	var markupEdit = "<td style='text-align: center;'><a href='#' data-toggle='modal' data-target='#exampleModal'><i class='fas fa-pen'></i></a><div class='modal fade' id='exampleModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'><div class='modal-dialog' role='document'><div class='modal-content'><div class='modal-header'><h5 class='modal-title' id='exampleModalLabel'>Modal title</h5><button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div><div class='modal-body'></div><div class='modal-footer'><button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button><button type='button' class='btn btn-primary'>Save changes</button></div></div></div></div></td>"
            var markup = "<tr><th scope='row' id='ob'>1</th>" + markupEdit + "<td style='text-align: center;'><a href='#' class='btnDelete'><i class='far fa-trash-alt'></i></a></td><td></td><td></td><td></td><td></td></tr>";
            tb.append(markup);
 	    } else {
 	    var $tableBody = $("table").find("tbody"),
		$trLast = $tableBody.find("tr:last"),
		$trNew = $trLast.clone();
		var newValue = parseInt($trLast.find("#ob").text())+1;
		$trNew.find("#ob").text(newValue);			
		$trLast.after($trNew);
 	    }

	});


	$("table").on('click', '.btnDelete', function () {
	    $(this).closest('tr').remove();
	});

	/***
	Logout Popover 
	***/
	$('[data-toggle="popover"]').popover({
		html: true, 
	    placement: "bottom"
	}); 




	

	
	
	
	/***
	BSC ID USER INFORMATION
	***/
	$("input#bscid").on("keyup", function(){
		let bscid = $(this).val();

		//var user = getBscIdUser(bscid);
		if (bscid != null && bscid > 0) {
			$('#newTestingOfficerModal #name').val("");
			$('#newTestingOfficerModal #department').val("");
			$('#newTestingOfficerModal #business_unit').val("");
			$('#newTestingOfficerModal #status_validity').val("");
			$('#newTestingOfficerModal #status').val("");
			$('#newTestingOfficerModal input:radio').prop('checked', false);
			$('#newTestingOfficerModal input:checkbox').prop('checked', false);
			$('.status_message_div').html('');

			if (bscid.length < 7) {
				return false;
			}
			let input_data = {
				bscid : bscid
			};

			$.ajax({
				type: 'GET',
				url: base_url+'/api/getBscIdUser',
				data: input_data,
				cache: false,
				success: function(data){

					var data = JSON.parse(data);
					var user = data.data;
					//console.log(user);
					if (user.BSC_EMPLID > 0) {
						$('#newTestingOfficerModal #name').val(user.FIRST_NAME+" "+user.LAST_NAME);
						$('#newTestingOfficerModal #department').val(user.DEPTID);
						$('#newTestingOfficerModal #business_unit').val(user.BUSINESS_UNIT);
						$('#newTestingOfficerModal #status_validity').val(user.STATUS_VALIDITY);
						$('#newTestingOfficerModal #status').val(user.STATUS);
						//$('#newTestingOfficerModal #bscid, #newTestingOfficerModal #name').attr('disabled', true);
						var roles = user.roles;

						$.each(roles, function(rkey, role){
							var yes_id = '#me_yes_role_'+role.ROLE_ID;
							var no_id = '#me_no_role_'+role.ROLE_ID;
							if (role.MUTUALLY_EXCLUSIVE == 'Y') {
								$(yes_id).prop("checked", true);
							}else if(role.MUTUALLY_EXCLUSIVE == 'N') {
								$(no_id).prop("checked", true);
							}
						});
						


					}else{
						var error_data = '<div class="alert alert-danger">';
						error_data +=	'<ul class="list-group">';
								error_data +=	'<li>'+'Entered BSCID '+bscid+' not found!'+'</li>';
						error_data +=	'</ul>';
						error_data +=	'</div>';

						$('.status_message_div').html(error_data);
						//$('#newTestingOfficerModal #bscid, #newTestingOfficerModal #name').removeAttr('disabled');
						$('#newTestingOfficerModal #bscid').val("");
						$('#newTestingOfficerModal #name').val("");
						$('#newTestingOfficerModal #department').val("");
						$('#newTestingOfficerModal #business_unit').val("");

						$('#newTestingOfficerModal #status_validity').val("");
						$('#newTestingOfficerModal #status').val("");
						$('#newTestingOfficerModal input:radio').prop('checked', false);
						$('#newTestingOfficerModal input:checkbox').prop('checked', false);
					}

				},
				error: function(e){
					console.log(e);
				}
			})
		}
	});

	/***
	GET USER ROLES 
	***/
	$('#newTestingOfficerModal').on('show.bs.modal', function () {
			resetTestingOfficerForm();

  			$.ajax({
				type: 'GET',
				url: base_url+'/api/getRoles',
				success: function(data){
					var data = JSON.parse(data);
					
					var roles = data.data;
					me_yes = "";
					me_no = "";
					$.each(roles, function(rkey, role){
						if (role.MUTUALLY_EXCLUSIVE == 'Y') {
							me_yes += '<div class="form-check">'+
					                    '<label class="form-check-label" for="'+role.ROLE_CODE+'">'+
					                      role.ROLE_CODE+
					                    '</label>'+
					                    '<input class="form-check-input" type="checkbox" name="me_yes_roles[]" id="me_yes_role_'+role.ROLE_ID+'" value="'+role.ROLE_ID+'">'+
					                  '</div>';
					       
						}else if(role.MUTUALLY_EXCLUSIVE == 'N') {
							me_no += '<div class="checkbox">'+
					                '<label>'+role.ROLE_CODE+'<input type="checkbox" name="me_no_roles[]" id="me_no_role_'+role.ROLE_ID+'" value="'+role.ROLE_ID+'"></label>'+
					                '</div>';
						}
					});
					$('.me-yes').html(me_yes);
					$('.me-no').html(me_no);
				},
				error: function(e){
					console.log(e);
				}
			})
	});
	
	$(document).on('change', 'input[name="me_yes_roles[]"]', function(){
		//alert();
		let me_yes_roles_checked = [];
		$('input[name="me_yes_roles[]"]:checked').each(function(){
			me_yes_roles_checked.push(this.value);
		});
		
		if(me_yes_roles_checked.length > 0){
			console.log(me_yes_roles_checked);

			$('input[name="me_no_roles[]"]').attr('disabled', 'disabled');
		}else{
			console.log('nothing selected');
			$('input[name="me_no_roles[]"]').removeAttr('disabled');
		}
	});

	/***
	ADD NEW TESTING OFFICER
	***/
	$("form#newTestingOfficerForm").on("submit", function(e){
		e.preventDefault();
		var formData = $(this).serialize();
		$.ajax({
				type: 'POST',
				url: base_url+'/user_data/create_TO',
				data: formData,
				success: function(data){
					console.log(data);
					if (data == 200) {
						showSuccessMsg();
						setTimeout(function(){
					        location.reload();
					    }, 3000)   
					}else{
						var data = JSON.parse(data);
						showErrorMsg(data);
					}
				},
				error: function(e){
					console.log(e);
				}
			});
	});


	$("#newToReset").on("click", function(e){
		e.preventDefault();
		resetTestingOfficerForm();
	});
	
	/*$(document).on('keyup keypress', 'form input[type="text"]', function(e) {
	  if(e.keyCode == 13) {
	    e.preventDefault();
	    return false;
	  }
	});*/

	$(".updateTestingOfficerModal").on("click", function(e){
		e.preventDefault();
		var bscid = $(this).next().html();
		$('#newTestingOfficerModal').modal('show');
		$('#newTestingOfficerModal #bscid').val(bscid).attr('disabled', 'disabled').keyup();
		$('#newTestingOfficerModal #name').attr('disabled', 'disabled');
	});


	/***
	ADD NEW Location type
	***/


	$('#newLocationTypeModal').on('show.bs.modal', function () {

		$('#newLocationTypeForm #name').val('');
		$('#newLocationTypeForm #description').val('');
		$('#newLocationTypeForm .status_message_div').html('');
	});

	$("form#newLocationTypeForm").on("submit", function(e){
		e.preventDefault();
		$('#newLocationTypeForm .status_message_div').html('Processing.....');
		var formData = $(this).serialize();
		$.ajax({
				type: 'POST',
				url: base_url+'/location_types/create_location_type',
				data: formData,
				success: function(data){
					//console.log(data);
					if (data == 200) {
						showSuccessMsg();
						setTimeout(function(){
					        location.reload();
					    }, 3000);
					}else{
						var data = JSON.parse(data);
						showErrorMsg(data);
					}
				},
				error: function(e){
					console.log(e);
				}
			});
	});

	$('.updateLocationTypeLink').on('click', function(e){
		e.preventDefault();
		var location_type_id = $(this).find('.hidden_location_type_id').val();

		$('form#updateLocationTypeForm .description').val();
		var name = $(this).next().text();
		var description = $(this).next().next().text();
		var html = ' <input type="hidden" name="location_type_id" value="'+location_type_id+'" />';

		$('#updateLocationTypeForm #name').val(name);
		$('#updateLocationTypeForm #description').val(description);
		$('#updateLocationTypeForm').append(html);
		$('#updateLocationTypeForm .status_message_div').html('');
		//var bscid = $(this).next().html();
		$('#updateLocationTypeModal').modal('show');
	});

	$('.location_type_reset').on('click', function(){
		$('#newLocationTypeForm #name').val('');
		$('#newLocationTypeForm #description').val('');
		$('#updateLocationTypeForm #name').val('');
		$('#updateLocationTypeForm #description').val('');
	});
	/***
	UPDATE Location type
	***/
	$("form#updateLocationTypeForm").on("submit", function(e){
		$('#updateLocationTypeForm .status_message_div').html('Processing.....');
		e.preventDefault();
		var formData = $(this).serialize();
		$.ajax({
				type: 'POST',
				url: base_url+'/location_types/update_location_type',
				data: formData,
				success: function(data){
					console.log(data);
					if (data == 200) {
						showSuccessMsg();
						setTimeout(function(){
					        location.reload();
					    }, 3000);
					}else{

						var data = JSON.parse(data);
						showErrorMsg(data);
					}
				},
				error: function(e){
					console.log(e);
				}
			});
	});


	$('#newRailroad').on('show.bs.modal', function () {
	//$(".newRailroadButton").on("click", function(e){
		//e.preventDefault();
		//alert();
		$('#newRailroadForm #railroad').val('');
		$('#newRailroadForm #description').val('');
		$('#newRailroadForm .status_message_div').html('');
		$('#newRailroadForm #status option[value=Created]').attr('selected','selected');
		$('#updateRailroadForm .rail_id_hidden').val('');
		//$('#newRailroad').modal('show'); 

	});

	/***
	create railroad
	***/
	$("form#newRailroadForm").on("submit", function(e){
		e.preventDefault();
		
		$('#newRailroadForm .status_message_div').html('Processing.....');
		var formData = $(this).serialize();
		$.ajax({
				type: 'POST',
				url: base_url+'/railroads/create_rail_road',
				data: formData,
				success: function(data){
					console.log(data);
					if (data == 200) {
						showSuccessMsg();
						setTimeout(function(){
					        location.reload();
					    }, 3000)   
					}else{
						var data = JSON.parse(data);
						showErrorMsg(data);
					}
				},
				error: function(e){
					console.log(e);
				}
			});
	});
	
	

	$(".railroad_reset").on("click", function(e){
		e.preventDefault();
		var railroad_id_value = $('#updateRailroadForm .rail_id_hidden').val();
		//console.log(railroad_id_value);
		if(railroad_id_value > 0){
				var railroad = $('table').find('input[value="'+railroad_id_value+'"]').parent().next('td').text();
				var description = $('table').find('input[value="'+railroad_id_value+'"]').parent().next('td').next('td').text();
				var status = $('table').find('input[value="'+railroad_id_value+'"]').parent().next('td').next('td').next('td').text();
				$('#updateRailroadForm #railroad').val(railroad);
				$('#updateRailroadForm #description').val(description);
				$('#updateRailroadForm #status').find('option').removeAttr('selected');
			
				if(status!=''){
					$('#updateRailroadForm #status option[value='+status+']').attr('selected','selected');
					$('#updateRailroadForm #status option[value='+status+']').prop('selected','selected');
				}

				$('.rail_id_hidden').val(railroad_id_value);
				$('#updateRailroadForm .status_message_div').html('');
		}else{
				$('#newRailroadForm #railroad').val('');
				$('#newRailroadForm #description').val('');
				$('#newRailroadForm #status option[value=Created]').attr('selected','selected');
				$('#newRailroadForm .status_message_div').html('');
				$('#updateRailroadForm #railroad').val('');
				$('#updateRailroadForm #description').val('');
				$('#updateRailroadForm #status option[value=Created]').attr('selected','selected');
				$('#updateRailroadForm .status_message_div').html('');
				$('.rail_id_hidden').val('');
		}
	});

	$(".updateRailRoadModal").on("click", function(e){
		e.preventDefault();
		$('#updateRailroadForm .status_message_div').html('');
		
		var railroad_id = $(this).find('.hidden_railroad_id').val();
		var railroad = $(this).next().text();
		var description = $(this).next().next().text();
		var status = $(this).next().next().next().text();
		//var html = ' <input type="hidden" name="railroad_id" value="'+railroad_id+'" />';

		$('#updateRailroadForm #railroad').val(railroad);
		$('#updateRailroadForm #description').val(description);
		$('#updateRailroadForm #status').find('option').removeAttr('selected');
			
				if(status!=''){
					$('#updateRailroadForm #status option[value='+status+']').attr('selected','selected');
					$('#updateRailroadForm #status option[value='+status+']').prop('selected','selected');
				}
		$('#updateRailroadForm .rail_id_hidden').val(railroad_id);
		
		//var bscid = $(this).next().html();
		$('#updateRailroad').modal('show');
	});
	/***
	Update Railroad
	***/
	$("form#updateRailroadForm").on("submit", function(e){
		e.preventDefault();
		var formData = $(this).serialize();
		$.ajax({
				type: 'POST',
				url: base_url+'/railroads/update_rail_road',
				data: formData,
				success: function(data){
					console.log(data);
					if (data == 200) {
						showSuccessMsg();
						setTimeout(function(){
					        location.reload();
					    }, 3000)   
					}else{
						var data = JSON.parse(data);
						showErrorMsg(data);
					}
				},
				error: function(e){
					console.log(e);
				}
			});
	});





	/***
	Track designation starts from here
	***/

	$('#newTrack').on('show.bs.modal', function () {
	//$(".newTrackButton").on("click", function(e){
		//e.preventDefault();
		$('#newTrackForm #trackcode').val('');
		$('#newTrackForm #description').val('');
		$('#newTrackForm .status_message_div').html('');
		//$('#newTrack').modal('show'); 

	});

	/***
	create track
	***/
	$("form#newTrackForm").on("submit", function(e){
		e.preventDefault();
		
		$('#newTrackForm .status_message_div').html('Processing.....');
		var formData = $(this).serialize();
		$.ajax({
				type: 'POST',
				url: base_url+'/tracks/create_track',
				data: formData,
				success: function(data){
					console.log(data);
					if (data == 200) {
						showSuccessMsg();
						setTimeout(function(){
					        location.reload();
					    }, 3000)   
					}else{
						var data = JSON.parse(data);
						showErrorMsg(data);
					}
				},
				error: function(e){
					console.log(e);
				}
			});
	});
	
	

	$(".track_reset").on("click", function(e){
		e.preventDefault();
		$('#newTrackForm #trackcode').val('');
		$('#newTrackForm #description').val('');
		$('#newTrackForm .status_message_div').html('');
		$('#updateTrackForm #trackcode').val('');
		$('#updateTrackForm #description').val('');
		$('#updateTrackForm .status_message_div').html('');

	});
	$(".updateTrackModal").on("click", function(e){
		e.preventDefault();
		$('#updateTrackForm .status_message_div').html('');
		
		var track_id = $(this).find('.hidden_track_id').val();
		var trackcode = $(this).next().text();
		var description = $(this).next().next().text();
		var html = ' <input type="hidden" name="track_id" value="'+track_id+'" />';

		
		
		$('#updateTrackForm #trackcode').val(trackcode);
		$('#updateTrackForm #description').val(description);
		$('#updateTrackForm').append(html);
		
		//var bscid = $(this).next().html();
		$('#updateTrack').modal('show');
	});
	/***
	Update Track
	***/
	$("form#updateTrackForm").on("submit", function(e){
		e.preventDefault();
		var formData = $(this).serialize();
		
		$.ajax({
				type: 'POST',
				url: base_url+'/tracks/update_track',
				data: formData,
				success: function(data){
					console.log(data);
					if (data == 200) {
						showSuccessMsg();
						setTimeout(function(){
					        location.reload();
					    }, 3000)   
					}else{
						var data = JSON.parse(data);
						showErrorMsg(data);
					}
				},
				error: function(e){
					console.log(e);
				}
			});
	});





	




	/***
	 USER ADMIN DATA TABLE 
	***/
	//$('.users-data-users').DataTable();
	 var table = $('.users-data-users').DataTable({
					 	"processing": true,
				        "serverSide": true,
				        "ajax": {
				            url: base_url+'/user_data/getUsers',
				            type: 'POST'
				        },
				        "order": [[ 1, "desc" ]],
				        "columns": [
				            { "data": "MODIFY" },
				            { "data": "BSC_EMPLID" },
				            { "data": "FIRST_NAME" },
				            { "data": "BUSINESS_UNIT" },
				            { "data": "DEPTID" },
				            { "data": "JOBCODE" },
				            { "data": "JOBCODE_DESCR" },
				            { "data": "POSITION_NUMBER" },
				            { "data": "POSITION_DESCRIPTION" },
				            { "data": "POSITION_ROLE" },
				            { "data": "DEPTID" },
				            { "data": "ROLES" },
				            { "data": "STATUS" },
				        ],
			          	"responsive":true,
					    "rowCallback": function (row, data, index) {
					      	//check to see if row is expanded
						  	if(!$(row).attr('role') || $(row).attr('role') != 'row' || $(row).hasClass('parent')){
						        return;
						    }
					      	//add class to expand row
					      	$(row).addClass('parent');
					    }
			    });








/***
Lines Functions starts from here
***/

$('#newLineModal').on('show.bs.modal', function () {

		$('#newLineForm #linecode').val('');
		$('#newLineForm #description').val('');
		$('#newLineForm .status_message_div').html('');
		$('#updateLineForm #status option[value=Created]').attr('selected','selected');
		$('#updateLineForm .line_id_hidden').val('');
		//$('#updateLineForm #linecode').val('');
		//$('#updateLineForm #description').val('');
		//$('#updateLineForm .status_message_div').html('');
	});
	/***
	ADD NEW Location type
	***/
	$("form#newLineForm").on("submit", function(e){
		e.preventDefault();
		$('#newLineForm .status_message_div').html('Processing.....');
		var formData = $(this).serialize();
		
		$.ajax({
				type: 'POST',
				url: base_url+'/lines/create_line',
				data: formData,
				success: function(data){
					console.log(data);
					if (data == 200) {
						showSuccessMsg();
						setTimeout(function(){
					        location.reload();
					    }, 3000);
					}else{
						var data = JSON.parse(data);
						showErrorMsg(data);
					}
				},
				error: function(e){
					console.log(e);
				}
			});
	});

	$('.updatelineModal').on('click', function(e){
		e.preventDefault();
		var line_id = $(this).find('.hidden_line_id').val();

		$('form#updateLineForm .description').val();
		var linecode = $(this).next().text();
		var description = $(this).next().next().text();
		var status = $(this).next().next().next().text();

		//var html = ' <input type="hidden" class="line_id_hidden" name="line_id" value="'+line_id+'" />';

		$('#updateLineForm #linecode').val(linecode);
		$('#updateLineForm #description').val(description);
		

		$('#updateLineForm #status').find('option').removeAttr('selected');
			
				if(status!=''){
					$('#updateLineForm #status option[value='+status+']').attr('selected','selected');
					$('#updateLineForm #status option[value='+status+']').prop('selected','selected');
				}

		$('.line_id_hidden').val(line_id);
		$('#updateLineForm .status_message_div').html('');
		//var bscid = $(this).next().html();
		$('#updatelineModal').modal('show');
	});

	$('.line_reset').on('click', function(){
var line_id_value = $('.line_id_hidden').val();
if(line_id_value!=''){
var linecode = $('table').find('input[value="'+line_id_value+'"]').parent().next('td').text();
		var description = $('table').find('input[value="'+line_id_value+'"]').parent().next('td').next('td').text();
		var status = $('table').find('input[value="'+line_id_value+'"]').parent().next('td').next('td').next('td').text();
		$('#updateLineForm #linecode').val(linecode);
		$('#updateLineForm #description').val(description);
		$('#updateLineForm #status').find('option').removeAttr('selected');
			
				if(status!=''){
					$('#updateLineForm #status option[value='+status+']').attr('selected','selected');
					$('#updateLineForm #status option[value='+status+']').prop('selected','selected');
				}

		$('.line_id_hidden').val(line_id_value);
		$('#updateLineForm .status_message_div').html('');
}else{
		$('#newLineForm #linecode').val('');
		$('#newLineForm #description').val('');
		$('#newLineForm .status_message_div').html('');
		$('#newLineForm #status option[value=Created]').attr('selected','selected');
		$('#updateLineForm #linecode').val('');
		$('#updateLineForm #description').val('');
		$('#updateLineForm .line_id_hidden').val('');
		$('#updateLineForm .status_message_div').html('');

		}	});
	/***
	UPDATE Location type
	***/
	$("form#updateLineForm").on("submit", function(e){
		$('#updateLineForm .status_message_div').html('Processing.....');
		e.preventDefault();
		var formData = $(this).serialize();
		$.ajax({
				type: 'POST',
				url: base_url+'/lines/update_line',
				data: formData,
				success: function(data){
					console.log(data);
					if (data == 200) {
						showSuccessMsg();
						setTimeout(function(){
					        location.reload();
					    }, 3000);
					}else{

						var data = JSON.parse(data);
						showErrorMsg(data);
					}
				},
				error: function(e){
					console.log(e);
				}
			});
	});


























}); 
	
	function resetTestingOfficerForm(){
			$('#newTestingOfficerModal #bscid, #newTestingOfficerModal #name').removeAttr('disabled');
			$('#newTestingOfficerModal #bscid').val("");
			$('#newTestingOfficerModal #name').val("");
			$('#newTestingOfficerModal #department').val("");
			$('#newTestingOfficerModal #business_unit').val("");

			$('#newTestingOfficerModal #status_validity').val("");
			$('#newTestingOfficerModal #status').val("");
			$('#newTestingOfficerModal input:radio').prop('checked', false);
			$('#newTestingOfficerModal input:checkbox').prop('checked', false);
			$('.status_message_div').html('');
	}

	
	function showErrorMsg(data){
		var error_data = '<div class="alert alert-danger">';
						error_data +=	'<ul class="list-group">';
						$.each(data, function(ekey, err){
							$.each(err, function(ekry1, err2){
								error_data +=	'<li>'+err2+'</li>';
							});
						});
						error_data +=	'</ul>';
						error_data +=	'</div>';
						$('.status_message_div').html(error_data);
	}
	function showSuccessMsg(){
		$('.status_message_div').html('<div class="alert alert-success">'+
														  '<strong>Success!</strong> Data Successfully Updated.'+
														'</div>');
	}