
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
			$('#newTestingOfficerModal #management_center_id').val("");
			$('#newTestingOfficerModal #jobcode').val("");
			$('#newTestingOfficerModal #position_number').val('');
			//$('#newTestingOfficerModal #status_validity').val("");
			$('#newTestingOfficerModal #status').val("");
			$('#newTestingOfficerModal input:radio').prop('checked', false);
			$('#newTestingOfficerModal input:checkbox').prop('checked', false);
			$('input[name="me_no_roles[]"], input[name="me_yes_roles[]"]').removeAttr('disabled');
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
					console.log(user);
					if (user.BSC_EMPLID > 0) {
						$('#newTestingOfficerModal #name').val(user.FIRST_NAME+" "+user.LAST_NAME);
						$('#newTestingOfficerModal #department').val(user.DEPTID);
						$('#newTestingOfficerModal #business_unit').val(user.BUSINESS_UNIT);
						$('#newTestingOfficerModal #management_center_id').val(user.DEPTID);
						$('#newTestingOfficerModal #jobcode').val(user.JOBCODE);
						$('#newTestingOfficerModal #position_number').val(user.POSITION_NBR);
						$('#newTestingOfficerModal #status_validity').val(user.STATUS_VALIDITY);
						$('#newTestingOfficerModal #status').val(user.STATUS);

						//$('#newTestingOfficerModal #bscid, #newTestingOfficerModal #name').attr('disabled', true);
						var roles = user.roles;

						$.each(roles, function(rkey, role){
							var yes_id = '#me_yes_role_'+role.ROLE_ID;
							var no_id = '#me_no_role_'+role.ROLE_ID;
							if (role.MUTUALLY_EXCLUSIVE == 'Y') {
								$(yes_id).prop("checked", true);
								$('input[name="me_yes_roles[]"]').change();

							}else if(role.MUTUALLY_EXCLUSIVE == 'N') {
								$(no_id).prop("checked", true);
								$('input[name="me_no_roles[]"]').change();
							}
						});
						

						$('#status_validity').change();
						$('#newTestingOfficerModal #end_date').val(user.END_DATE);
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
						$('#newTestingOfficerModal #management_center_id').val("");
						$('#newTestingOfficerModal #jobcode').val("");
						$('#newTestingOfficerModal #position_number').val('');
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
	$(document).on('click', '#newTestingOfficerButton', function(e){
		e.preventDefault();
		$('#updateToHidden').val('');
	})
	/*$(document).on('click', '.date', function (e){
		e.preventDefault();
		$(this).datepicker({
			minDate: 0
		});
	});*/

	$(document).delegate(".date", "focusin", function () {
		$(this).datepicker({
			beforeShow:function(textbox, instance){
		     	$('.date').parent().append($('#ui-datepicker-div'));
		   	},
		   	afterShow:function(textbox, instance){
		   		//$('#ui-datepicker-div').css({'top': '0'});
		   	}

		});
	});
	 
	 
	$('#newTestingOfficerModal').on('show.bs.modal', function () {
			resetTestingOfficerForm();
			//$('#newTestingOfficerModal #bscid, #newTestingOfficerModal #name').removeAttr('disabled');
			
			$('#newTestingOfficerModal #bscid, #newTestingOfficerModal #name').val("").removeAttr('readonly').removeAttr('onfocus');
			$('#newTestingOfficerModal #department').val("");
			$('#newTestingOfficerModal #business_unit').val("");
			$('#newTestingOfficerModal #management_center_id').val("");
			$('#newTestingOfficerModal #jobcode').val("");
			$('#newTestingOfficerModal #position_number').val("");
			$('#newTestingOfficerModal #status_validity').val("");
			$('#newTestingOfficerModal #status').val("");
			var updateToHidden = $('#updateToHidden').val();

			// new TO form 
			if (updateToHidden != 1) {
				$('#newTestingOfficerModal #bscid, #newTestingOfficerModal #name').removeAttr('readonly').removeAttr('onfocus');
			}
			$('#newToReset').click();
			

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
					$('#status_validity').change();
				},
				error: function(e){
					console.log(e);
				}
			})
	});
	
	/*
	Left Side Check Boxes - Data Entry For Self,Data Entry For Others Only,Designated Instructor,Qualified Personnel
	**/
	$('.me-yes').on('change', 'input[name="me_yes_roles[]"]', function(){
		$('input[name="me_no_roles[]"], input[name="me_yes_roles[]"]').removeAttr('disabled');

		let me_yes_roles_checked = [];
		$('input[name="me_yes_roles[]"]').attr('disabled', 'disabled');

		$('input[name="me_yes_roles[]"]:checked').each(function(){
			me_yes_roles_checked.push(this.value);
			$(this).removeAttr('disabled');
		});
		
		if(me_yes_roles_checked.length > 0){

			$('input[name="me_no_roles[]"]').prop("checked", false);
			$('input[name="me_no_roles[]"]').attr('disabled', 'disabled');
		}else{
			$('input[name="me_yes_roles[]"]').removeAttr('disabled');
		}
	});


	/**
	Right Side Check Boxes - Rules Administrator, View Reports etc....
	**/
	$(document).on('change', 'input[name="me_no_roles[]"]', function(){
		$('input[name="me_no_roles[]"], input[name="me_yes_roles[]"]').removeAttr('disabled');
		let me_no_roles_checked = [];
		me_no_roles_checked = $('input[name="me_no_roles[]"]:checked');
		if(me_no_roles_checked.length > 0){

			$('input[name="me_yes_roles[]"]').prop("checked", false);
			$('input[name="me_yes_roles[]"]').attr('disabled', 'disabled');
		}

	});

	/**
	status validity expire Date validation
	**/
	$(document).on('change', '#status_validity', function(){
		let status_validity = $('#status_validity option:selected').val();
		let tatus_validity_div = '';
		if (status_validity == 'EFFECTIVE UNTILL') {
			
			/*status_validity_div = ''+
							'<label for="status validity end date" class="col-md-5 status_validity_end_date">End Date</label>'+
							'<input type="text" name="end_date" id="end_date" class="form-control col-md-7 status_validity_end_date" placeholder="yyyy/m/d"/>'+
							'';
			$(this).parent().parent().siblings().find('.form-group').html(status_validity_div);*/
			$('#newTestingOfficerModal #management_center_id').removeAttr('disabled').removeAttr('readonly');
			$('#newTestingOfficerModal #jobcode').removeAttr('disabled').removeAttr('readonly');
			$('#newTestingOfficerModal #position_number').removeAttr('disabled').removeAttr('readonly');
			$('.status_validity_end_date').show();
			
		}else if(status_validity == 'NEVER EXPIRE'){
			
			$('#newTestingOfficerModal #management_center_id').removeAttr('disabled').removeAttr('readonly');
			$('#newTestingOfficerModal #jobcode').removeAttr('disabled').removeAttr('readonly');
			$('#newTestingOfficerModal #position_number').removeAttr('disabled').removeAttr('readonly');
			$('.status_validity_end_date').hide();
			
		}else{
			$('#newTestingOfficerModal #management_center_id').attr('disabled', 'disabled').attr('readonly', 'readonly');
			$('#newTestingOfficerModal #jobcode').attr('disabled', 'disabled').attr('readonly', 'readonly');
			$('#newTestingOfficerModal #position_number').attr('disabled', 'disabled').attr('readonly', 'readonly');
			$('.status_validity_end_date').hide();
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
		var updateToHidden = $('#updateToHidden').val();

		// new TO form 
		if (updateToHidden != 1) {
			$('#newTestingOfficerModal #bscid, #newTestingOfficerModal #name').removeAttr('readonly').removeAttr('onfocus');
		}

		// update TO
		//resetTestingOfficerForm();
		let bscid = $('#newTestingOfficerModal #bscid').val();
		$('#newTestingOfficerModal #bscid').val(bscid).keyup();

	});


	$(document).on('click', '.f_reset', function(){
		var form = $(this).closest('form');
		$(form).find('input[type=text]').val('');
		window.location.href = base_url+'/user_data/index';
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
		var attribues = {'readonly': 'readonly', 'onfocus': 'this.blur()'};

		$('#newTestingOfficerModal').modal('show');
		
		$('#newTestingOfficerModal #bscid').val(bscid).attr(attribues).keyup();
		$('#newTestingOfficerModal #name').attr(attribues);
		$('#newTestingOfficerModal #updateToHiddenSpan').html('<input type="hidden" name="updateToHidden" id="updateToHidden" value="1" />');
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
		
		$('#newRailroadForm #status').removeAttr('checked','checkbox');
		$('#newRailroadForm #status').prop('checked', false);
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
					    }, 3000);   
					}else{
						try{
							var data = JSON.parse(data);
							showErrorMsg(data);
						}catch(e){
							showCustomMsg(data);
						}
						
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
				$('#updateRailroadForm #status').prop('checked', false);			
				if(status!=''){
				
						$('#updateRailroadForm #status[value='+status+']').attr('checked','checkbox');
						$('#updateRailroadForm #status[value='+status+']').prop('checked','checked');
				}


				$('.rail_id_hidden').val(railroad_id_value);
				$('#updateRailroadForm .status_message_div').html('');
		}else{
			//Create Rail road form
				$('#newRailroadForm #railroad').val('');
				$('#newRailroadForm #description').val('');
				$('#newRailroadForm #status').removeAttr('checked','checkbox');
				$('#newRailroadForm #status').prop('checked', false);
				$('#newRailroadForm .status_message_div').html('');
			//Update Rail road form
				$('#updateRailroadForm #railroad').val('');
				$('#updateRailroadForm #description').val('');
				$('#updateRailroadForm #status').removeAttr('checked','checkbox');
				$('#updateRailroadForm #status').prop('checked', false);
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
		$('#updateRailroadForm #status').removeAttr('checked','checkbox');
		$('#updateRailroadForm #status').prop('checked', false);			
		if(status!=''){
		
			$('#updateRailroadForm #status[value='+status+']').attr('checked','checkbox');
			$('#updateRailroadForm #status[value='+status+']').prop('checked','checked');
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
Lines Functions starts from here
***/

$('#newLineModal').on('show.bs.modal', function () {

		$('#newLineForm #linecode').val('');
		$('#newLineForm #description').val('');
		$('#newLineForm .status_message_div').html('');
		$('#newLineForm #status').prop('checked', false);			
		$('#updateLineForm #status').prop('checked', false);
		if(status!=''){
		
				$('#updateLineForm #status[value='+status+']').attr('checked','checkbox');
				$('#updateLineForm #status[value='+status+']').prop('checked','checked');
		}
		//$('#updateLineForm #status option[value=Created]').attr('selected','selected');
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
						try{
							var data = JSON.parse(data);
							showErrorMsg(data);
						}catch(e){
							showCustomMsg(data);
						}
					}
				},
				error: function(e){
					console.log(e);
				}
			});
	});

	$(document).on('click', '.updatelineModal', function(e){
		e.preventDefault();
		console.log('clicked');
		var line_id = $(this).find('.hidden_line_id').val();

		$('form#updateLineForm .description').val();
		var linecode = $(this).next().text();
		var description = $(this).next().next().text();
		var status = $(this).next().next().next().text();

		//var html = ' <input type="hidden" class="line_id_hidden" name="line_id" value="'+line_id+'" />';

		$('#updateLineForm #linecode').val(linecode);
		$('#updateLineForm #description').val(description);
		

		$('#updateLineForm #status').prop('checked', false);
		if(status!=''){
		
				$('#updateLineForm #status[value='+status+']').attr('checked','checkbox');
				$('#updateLineForm #status[value='+status+']').prop('checked','checked');
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
		$('#updateLineForm #status').prop('checked', false);
		if(status!=''){
		
				$('#updateLineForm #status[value='+status+']').attr('checked','checkbox');
				$('#updateLineForm #status[value='+status+']').prop('checked','checked');
		}

		$('.line_id_hidden').val(line_id_value);
		$('#updateLineForm .status_message_div').html('');
}else{
		$('#newLineForm #linecode').val('');
		$('#newLineForm #description').val('');
		$('#newLineForm #status').prop('checked', false);
		$('#newLineForm .status_message_div').html('');
		
		$('#updateLineForm #linecode').val('');
		$('#updateLineForm #description').val('');
		$('#updateLineForm #status').prop('checked', false);
		$('#updateLineForm .line_id_hidden').val('');
		$('#updateLineForm .status_message_div').html('');

		}	
	});

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



/***
	 USER ADMIN DATA TABLE 
***/
	
	$('.users-data-users').DataTable();
	$('.railroad-administrator').DataTable();
	$('.line-administration').DataTable();
	$('.location-administration').DataTable();
	$('.location-type-administration').DataTable();
	$('.Track-Designation-Administration').DataTable();
	
	
	 /*var table = $('.users-data-users').DataTable({
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
			    });*/




























}); 


	function resetTestingOfficerForm(){
			


			$('#newTestingOfficerModal input:radio').prop('checked', false);
			$('#newTestingOfficerModal input:checkbox').prop('checked', false);
			$('input[name="me_no_roles[]"], input[name="me_yes_roles[]"]').removeAttr('disabled');
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
	function showCustomMsg(data){
		var error_data = '<div class="alert alert-danger">';
						error_data +=	'<ul class="list-group">';
						error_data += 	'<li>'+data+'</li>';
						
						error_data +=	'</ul>';
						error_data +=	'</div>';
						$('.status_message_div').html(error_data);
	}
	function showSuccessMsg(){
		$('.status_message_div').html('<div class="alert alert-success">'+
														  '<strong>Success!</strong> Data Successfully Updated.'+
														'</div>');
	}

	 //var $j_custom = jQuery.noConflict(true);


// User filter API
/*
$(document).ready(function () {
      $( function() {
       $( "#f_bscid" ).autocomplete({
        maxShowItems:4,	
        minLength:3,	
        source: function( request, response ) { 
        var searchText = request.term;
        console.log(searchText);
         $.ajax({
          url: "http://localhost/ecr2/Api/userFilter",
          type: 'get',
          dataType: "json",
          data: {
           bscid: request.term
          },
          success: function( data ) {
           response( data );
          }
      });
      },
      select: function (event, ui) {
       // Set selection
       $('#f_bscid').val(ui.item.label); // display the selected text
       return false;
      }
       
       });

       });
    });
 */
$(document).on('focus','.autocomplete-input', handleAutocomplete);

function getId(element){
    var id, idArr;
    id = element.attr('id');
    idArr = id.split("_");
    return idArr[idArr.length - 1];
}
    
function getFieldValue(type){
    var fieldValue;
    switch (type) {
    	case 'f_bscid':
            fieldValue = 0;
            break;
        case 'f_first_name':
            fieldValue = 1;
            break;
        case 'f_last_name':
            fieldValue = 2;
            break;
        case 'f_job_code':
            fieldValue = 3;
            break;
        case 'f_mgmt_ctr_id':
            fieldValue = 4;
            break;
        default:
            break;
    }
    return fieldValue;
}

function handleAutocomplete() {
    var type, fieldValue, currentEle; 
    type = $(this).attr('name');
    console.log(type);
    fieldValue = getFieldValue(type);
    currentEle = $(this);

    if(typeof fieldValue === 'undefined') {
        return false;
    }

    $(this).autocomplete({
    	maxShowItems:4,	
        minLength:3,
        source: function( data, cb ) {   
            $.ajax({
                url:'http://localhost/ecr2/Api/userFilter',
                method: 'GET',
                dataType: 'json',
                data: {
                    name:  data.term,
                    fieldValue: fieldValue
                },
                success: function(res){
                    var result;
                    if (res.length) {
                        result = $.map(res, function(obj){
         
                            var arr = obj.split("|");
                            console.log(arr);
                            console.log(fieldValue);
                            return {
                                label: arr[fieldValue],
                                value: arr[fieldValue],
                                data : obj
                            };
                        });
                    }
                    cb(result);
                }
            });
        },
        select: function( event, ui ) {
        	if(fieldValue == 0){
        	resArr = ui.item.data.split(" ");
        	console.log(resArr);
            $('#f_bscid').val(resArr[0]); // display the selected text
             return false; 	
        }
            
        }         
    });
}
              
	