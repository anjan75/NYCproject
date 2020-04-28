$(document).ready(function(){
	var base_url = $('#base_url').text();
	jQuery.datetimepicker.setLocale('en');
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


	/*$("table").on('click', '.btnDelete', function () {
	    $(this).closest('tr').remove();
	});*/

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

	/*$(document).delegate(".date", "focusin", function () {
		$(this).datepicker({
			beforeShow:function(textbox, instance){
				
		     	$('.date_container').append($('#ui-datepicker-div'));
		     	$('#ui-datepicker-div').css({
			        position: 'absolute',
			        top:-20,
			        left:5                   
			    });
		     	$('#ui-datepicker-div').hide();
		   	},
		   	afterShow:function(textbox, instance){
		   		$('#ui-datepicker-div').css({
			        position: 'absolute',
			        top:-20,
			        left:5                   
			    });
		   	}

		});
	});*/


	jQuery('.date').datetimepicker({
		timepicker:false,
		format:'m/d/y',
	});

	jQuery('#gif_date, #tif_date, #sif_date, #oif_date').datetimepicker({
		format:'m/d/Y',
		timepicker:false,
		minDate:'-1970/01/07',//yesterday is minimum date(for today use 0 or -1970/01/01)
 		maxDate:'+1970/01/01', //tomorrow is maximum date calendar
 		step: 10
	});
		//User admin datepicker
	jQuery('#end_date').datetimepicker({
		format:'m/d/Y',
		minDate:'-1970/01/01',//yesterday is minimum date(for today use 0 or -1970/01/01)
 		maxDate:'+1970/06/31', //tomorrow is maximum date calendar
 		//step: 10
	});


	jQuery('.time24').datetimepicker({
	  datepicker:true,
	  format:'G:i A'
	});
	jQuery('.time12').datetimepicker({
	  datepicker:false,
	  format : 'H:i A', //g:i A
	  formatTime: 'H:i A', //G:i A
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

/****
SELECT @ initialization 
****/
$('.select-single').select2();

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






/****
General Inspections Tasks
****/
$(document).on("change", "#gif_task", function(e){
	e.preventDefault();
	var task_id = $(this).val();
	$.ajax({
			type: 'POST',
			url: base_url+'/tasks/getTaskRules/'+task_id,
			data: task_id,
			success: function(data){
				var data = JSON.parse(data);
				var rule_data  = "<option>Select Option</option>";
				$.each(data, function(ekey, err){
					rule_data +=	'<option value="'+err.RULE_ID+'">'+err.DESCRIPTION+'</option>';
				});

				$('#gif_rule').html(rule_data);
			},
			error: function(e){
				console.log(e);
			}
		});
});

$(document).on("change", "#gif_location_type", function(e){
	e.preventDefault();
	var location_type_id = $(this).val();
	$.ajax({
			type: 'POST',
			url: base_url+'/location_types/getLocationsByTypeID/'+location_type_id,
			data: location_type_id,
			success: function(data){
				var data = JSON.parse(data);
				var loc_data  = "<option>Select Option</option>";
				$.each(data, function(ekey, err){
					loc_data +=	'<option value="'+err.LOCATION_ID+'">'+err.DESCRIPTION+'</option>';
				});

				$('#gif_location').html(loc_data);
			},
			error: function(e){
				console.log(e);
			}
		});
});

/***
General inspection non complaint raido box
***/
$(document).on('change', 'input[name="gif_result"]', function(){
	console.log(this.value);
	if (this.value == 'non_compliant') {
		$('.gif_non_compliant_div').removeAttr('style');
		$('#gif_non_compliant1, #gif_comment').attr('required', 'required');
	}else{
		var style = {
			'right' : '20',
			'display': 'none'
		};
		$('input[name="gif_non_compliant"]').prop('checked', false);
		
		$('.gif_non_compliant_div').css(style);
		$('#gif_non_compliant1, #gif_comment').removeAttr('required');
	}
});

// General Inspection observations cookie
$(document).on("submit", "#gif", function(e){
	e.preventDefault();
	var return_data = [];
	var formData = $(this).serializeArray();
	var form_array = {};

    $.map(formData, function(n, i){
        form_array[n['name']] = n['value'];
    });
    // Retrive desction of selected item
    form_array.gif_location_type_desc = $("#gif_location_type option:selected").text();
    form_array.gif_location_desc = $("#gif_location option:selected").text();
    form_array.gif_milepost_desc = $("#gif_milepost option:selected").text();
    form_array.gif_task_desc = $("#gif_task option:selected").text();
    form_array.gif_line_desc = $("#gif_line option:selected").text();
    form_array.gif_rule_code = $("#gif_rule option:selected").text();
    

    form_array.gif_result_value = $("input[name='gif_non_compliant']:checked").val();
	
	if (checkCookie('gif_data')) {
		return_data = getCookie('gif_data');
		return_data = JSON.parse(return_data);
		return_data.push(form_array);
	}else{
		return_data.push(form_array);
	}
	// Here we will get all the gi obsrvation list 
	// loop and show in table and remove duplecates
	//#TODO  check duplicate 
	var ob_row = '';
	$.each(return_data, function(k, ob){
		k = k+1;
		/*var dNow = new Date(ob.gif_date + ' EDT'); // EDT timezone
		var localdate= (dNow.getMonth()+1) + '/' + dNow.getDate() + '/' + dNow.getFullYear() + ' ' + dNow.getHours() + ':' + dNow.getMinutes();
		var gif_date = (dNow.getMonth()+1) + '/' + dNow.getDate() + '/' + dNow.getFullYear() ;
		var gif_time = formatAMPM(dNow); //dNow.getHours() + ':' + dNow.getMinutes();*/
		//console.log(dNow.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true }));
		if (typeof ob.gif_result_value !== "undefined") {
			var gif_result_value = ob.gif_result_value;
		}else{
			var gif_result_value = 'Complaint';
		}


		ob_row += '<tr>'+
      '<td id="ob" scope="row">'+k+'</td>'+
      '<td style="text-align: center;"><a href="#" data-toggle="modal" data-target="#gi_modal"><i class="fas fa-pen"></i></a></td>'+
      '<td style="text-align: center;"><a class="btnDelete" href="#"><i class="far fa-trash-alt"></i></a></td>'+
      '<td>'+ ob.gif_date+'</td>'+
      '<td>'+ ob.gif_time+'</td>'+
      '<td>'+ ob.gif_rule_code+'</td>'+
      '<td>'+ gif_result_value+'</td>'+
	  '</tr>';
		
	});
	$('.general-inspection tbody').html(ob_row);

	var single_gif_data = JSON.stringify(return_data);
	delete_cookie('gif_data');
	setCookie('gif_data', single_gif_data, 1);
	
	var return_data = getCookie('gif_data');
	return_data = JSON.parse(return_data);
	$('#gi_modal').find('form')[0].reset();
	$('#gi_modal').modal('toggle');
	return true;
});

//General inspection filed validation
$(document).on('click', '.add_observation_button', function(e){
	e.preventDefault();
	/*if (
		$('#gi_observed_employee').val() != ''
		//&& $('#gi_rail_road option:selected').value != ''
		&& $('#gi_crew_number').val() != ''
		&& $('#gi_train_number').val() != ''
		&& $('#gi_job_description').val() != ''
		&& $('#gi_department').val() != ''
		) {
		$('#gi_modal').modal('toggle');
	}else{
		alert('Please enter Inspection fields'); // we can customize it later
	}*/
	$('#gi_modal').modal('toggle');
});
var submit_new_gi_inspection = null;
$(document).on('click', '.submit_new_gi_inspection', function(e){
	e.preventDefault();
	window.submit_new_gi_inspection = true;
	$('#giform').submit();
});

$(document).on('click', '.submit_gi_inspection', function(e){
	e.preventDefault();
	window.submit_new_gi_inspection = null;
	$('#giform').submit();
});
$(document).on('submit', '#giform', function(e){
	e.preventDefault();
	var formData = $(this).serializeArray();
	var form_array = {};

    $.map(formData, function(n, i){
        form_array[n['name']] = n['value'];
    });
    

    $.ajax({
			type: 'POST',
			url: base_url+'/General_inspections/create_gi',
			data: form_array,
			success: function(data){
				
				if (typeof data === 'string' || data instanceof String) {
					data.replace(/(^[ \t]*\n)/gm, "")

					if (!String.prototype.trim) {
					  String.prototype.trim = function () {
					    return this.replace(/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g, '');
					  };
					}
					data.trim();

					if (window.submit_new_gi_inspection == true) {				    	
				    	//empty form and table
				    	$('#giform').find('input[type=text]').val('');
				    	$('#gi_rail_road').val('').trigger('change');

				    	$('.general-inspection tbody').html('');
				    	$('#gi_bsc_id_show').val($('#gi_bsc_id').val());

				    }else if (data == 'success') {
						window.location.href = base_url+'/dashboards/index';
					}
					console.log(data);
				}else{
					var data = JSON.parse(data);
					console.log(data);
				}
			},
			error: function(e){
				console.log(e);
			}
		});
    
});


























/****
Train Inspections Tasks
****/
$(document).on("change", "#tif_task", function(e){
	e.preventDefault();
	var task_id = $(this).val();
	$.ajax({
			type: 'POST',
			url: base_url+'/tasks/getTaskRules/'+task_id,
			data: task_id,
			success: function(data){
				var data = JSON.parse(data);
				var rule_data  = "<option>Select Option</option>";
				$.each(data, function(ekey, err){
					rule_data +=	'<option value="'+err.RULE_ID+'">'+err.DESCRIPTION+'</option>';
				});

				$('#tif_rule').html(rule_data);
			},
			error: function(e){
				console.log(e);
			}
		});
});

$(document).on("change", "#tif_location_type", function(e){
	e.preventDefault();
	var location_type_id = $(this).val();
	$('#tif_location').change();
	$.ajax({
			type: 'POST',
			url: base_url+'/location_types/getLocationsByTypeID/'+location_type_id,
			data: location_type_id,
			success: function(data){
				var data = JSON.parse(data);
				var loc_data  = ""; //"<option>Select Option</option>";
				$.each(data, function(ekey, err){
					loc_data +=	'<option value="'+err.LOCATION_ID+'">'+err.DESCRIPTION+'</option>';
				});

				$('#tif_location').html(loc_data);

			},
			error: function(e){
				console.log(e);
			}
		});
});

/***
Train inspection non complaint raido box
***/
$(document).on('change', 'input[name="tif_result"]', function(){
	console.log(this.value);
	if (this.value == 'non_compliant') {
		$('.tif_non_compliant_div').removeAttr('style');
		$('#tif_non_compliant1, #tif_comment').attr('required', 'required');
	}else{
		var style = {
			'right' : '20',
			'display': 'none'
		};
		$('input[name="tif_non_compliant"]').prop('checked', false);
		$('.tif_non_compliant_div').css(style);
		$('#tif_non_compliant1, #tif_comment').removeAttr('required');
	}
});

// Train Inspection observations cookie
$(document).on("submit", "#tif", function(e){
	e.preventDefault();
	var return_data = [];
	var formData = $(this).serializeArray();
	var form_array = {};

    $.map(formData, function(n, i){
        form_array[n['name']] = n['value'];
    });
    
    form_array.tif_location_type_desc = $("#tif_location_type option:selected").text();
    form_array.tif_location_desc = $("#tif_location option:selected").text();
    form_array.tif_milepost_desc = $("#tif_milepost option:selected").text();
    form_array.tif_task_desc = $("#tif_task option:selected").text();
    form_array.tif_line_desc = $("#tif_line option:selected").text();
    form_array.tif_rule_code = $("#tif_rule option:selected").text();

    form_array.tif_result_value = $("input[name='tif_non_compliant']:checked").val();
	
	if (checkCookie('tif_data')) {
		return_data = getCookie('tif_data');
		return_data = JSON.parse(return_data);
		return_data.push(form_array);
	}else{
		return_data.push(form_array);
	}
	// Here we will get all the ti obsrvation list 
	// loop and show in table and remove duplecates
	//#TODO  check duplicate 
	var ob_row = '';
	$.each(return_data, function(k, ob){
		k = k+1;
		/*var dNow = new Date(ob.tif_date + ' EDT'); // EDT timezone
		var localdate= (dNow.getMonth()+1) + '/' + dNow.getDate() + '/' + dNow.getFullYear() + ' ' + dNow.getHours() + ':' + dNow.getMinutes();
		var tif_date = (dNow.getMonth()+1) + '/' + dNow.getDate() + '/' + dNow.getFullYear() ;
		var tif_time = formatAMPM(dNow); //dNow.getHours() + ':' + dNow.getMinutes();
		console.log(dNow.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true }));*/
		if (typeof ob.tif_result_value !== "undefined") {
			var tif_result_value = ob.tif_result_value;
		}else{
			var tif_result_value = 'Complaint';
		}


		ob_row += '<tr>'+
      '<td id="ob" scope="row">'+k+'</td>'+
      '<td style="text-align: center;"><a href="#" data-toggle="modal" data-target="#ti_modal"><i class="fas fa-pen"></i></a></td>'+
      '<td style="text-align: center;"><a class="btnDelete" href="#"><i class="far fa-trash-alt"></i></a></td>'+
      '<td>'+ ob.tif_date+'</td>'+
      '<td>'+ ob.tif_time+'</td>'+
      '<td>'+ ob.tif_rule_code+'</td>'+
      '<td>'+tif_result_value+'</td>'+
	  '</tr>';
		
	});
	$('.train-inspection tbody').html(ob_row);

	var single_tif_data = JSON.stringify(return_data);
	delete_cookie('tif_data');
	setCookie('tif_data', single_tif_data, 1);
	
	var return_data = getCookie('tif_data');
	return_data = JSON.parse(return_data);
	$('#ti_modal').find('form')[0].reset();
	$('#ti_modal').modal('toggle');
	return true;
});

//Train inspection filed validation
$(document).on('click', '.add_observation_button', function(e){
	e.preventDefault();
	/*if (
		$('#ti_observed_employee').val() != ''
		//&& $('#ti_rail_road option:selected').value != ''
		&& $('#ti_crew_number').val() != ''
		&& $('#ti_train_number').val() != ''
		&& $('#ti_job_description').val() != ''
		&& $('#ti_department').val() != ''
		) {
		$('#ti_modal').modal('toggle');
	}else{
		alert('Please enter Inspection fields'); // we can customize it later
	}*/
	$('#tif_location_type').change();
	$('#tif_location').change();
	$('#ti_modal').modal('toggle');
	
});

var submit_new_ti_inspection = null;
$(document).on('click', '.submit_new_ti_inspection', function(e){
	e.preventDefault();
	window.submit_new_ti_inspection = true;
	$('#tiform').submit();
});

$(document).on('click', '.submit_ti_inspection', function(e){
	e.preventDefault();
	var submit_new_ti_inspection = null;
	$('#tiform').submit();
});
$(document).on('submit', '#tiform', function(e){
	e.preventDefault();
	var formData = $(this).serializeArray();
	var form_array = {};

    $.map(formData, function(n, i){
        form_array[n['name']] = n['value'];
    });

    $.ajax({
			type: 'POST',
			url: base_url+'/Train_inspections/create_ti',
			data: form_array,
			success: function(data){
				
				if (typeof data === 'string' || data instanceof String) {
					data.replace(/(^[ \t]*\n)/gm, "")

					if (!String.prototype.trim) {
					  String.prototype.trim = function () {
					    return this.replace(/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g, '');
					  };
					}
					data.trim();

					if (window.submit_new_ti_inspection == true) {				    	
				    	//empty form and table
				    	$('#tiform').find('input[type=text]').val('');
				    	$('#ti_rail_road').val('').trigger('change');

				    	$('.train-inspection tbody').html('');
				    	$('#ti_bsc_id_show').val($('#ti_bsc_id').val());

				    }else if (data == 'success') {
						window.location.href = base_url+'/dashboards/index';
					}
					console.log(data);
				}else{
					var data = JSON.parse(data);
					console.log(data);
				}
			},
			error: function(e){
				console.log(e);
			}
		});
    
});



/****
Speed Inspections Tasks
****/
$(document).on("change", "#sif_task", function(e){
	e.preventDefault();
	var task_id = $(this).val();
	$.ajax({
			type: 'POST',
			url: base_url+'/tasks/getTaskRules/'+task_id,
			data: task_id,
			success: function(data){
				var data = JSON.parse(data);
				var rule_data  = "<option>Select Option</option>";
				$.each(data, function(ekey, err){
					rule_data +=	'<option value="'+err.RULE_ID+'">'+err.DESCRIPTION+'</option>';
				});

				$('#sif_rule').html(rule_data);
			},
			error: function(e){
				console.log(e);
			}
		});
});

$(document).on("change", "#sif_location_type", function(e){
	e.preventDefault();
	var location_type_id = $(this).val();
	$.ajax({
			type: 'POST',
			url: base_url+'/location_types/getLocationsByTypeID/'+location_type_id,
			data: location_type_id,
			success: function(data){
				var data = JSON.parse(data);
				var loc_data  = "<option>Select Option</option>";
				$.each(data, function(ekey, err){
					loc_data +=	'<option value="'+err.LOCATION_ID+'">'+err.DESCRIPTION+'</option>';
				});

				$('#sif_location').html(loc_data);
			},
			error: function(e){
				console.log(e);
			}
		});
});

/***
Speed inspection non complaint raido box
***/
$(document).on('change', 'input[name="sif_result"]', function(){
	console.log(this.value);
	if (this.value == 'non_compliant') {
		$('.sif_non_compliant_div').removeAttr('style');
		$('#sif_non_compliant1, #sif_comment').attr('required', 'required');
	}else{
		var style = {
			'right' : '20',
			'display': 'none'
		};
		$('input[name="sif_non_compliant"]').prop('checked', false);
		$('.sif_non_compliant_div').css(style);
		$('#sif_non_compliant1, #sif_comment').removeAttr('required');
	}
});

// Speed Inspection observations cookie
$(document).on("submit", "#sif", function(e){
	e.preventDefault();
	var return_data = [];
	var formData = $(this).serializeArray();
	var form_array = {};

    $.map(formData, function(n, i){
        form_array[n['name']] = n['value'];
    });
    
    form_array.sif_location_type_desc = $("#sif_location_type option:selected").text();
    form_array.sif_location_desc = $("#sif_location option:selected").text();
    form_array.sif_milepost_desc = $("#sif_milepost option:selected").text();
    form_array.sif_task_desc = $("#sif_task option:selected").text();
    form_array.sif_line_desc = $("#sif_line option:selected").text();
    form_array.sif_rule_code = $("#sif_rule option:selected").text();

    form_array.sif_result_value = $("input[name='sif_non_compliant']:checked").val();
	
	if (checkCookie('sif_data')) {
		return_data = getCookie('sif_data');
		return_data = JSON.parse(return_data);
		return_data.push(form_array);
	}else{
		return_data.push(form_array);
	}
	// Here we will get all the ti obsrvation list 
	// loop and show in table and remove duplecates
	//#TODO  check duplicate 
	var ob_row = '';
	$.each(return_data, function(k, ob){
		k = k+1;
		/*var dNow = new Date(ob.sif_date + ' EDT'); // EDT timezone
		var localdate= (dNow.getMonth()+1) + '/' + dNow.getDate() + '/' + dNow.getFullYear() + ' ' + dNow.getHours() + ':' + dNow.getMinutes();
		var sif_date = (dNow.getMonth()+1) + '/' + dNow.getDate() + '/' + dNow.getFullYear() ;
		var sif_time = formatAMPM(dNow); //dNow.getHours() + ':' + dNow.getMinutes();
		console.log(dNow.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true }));*/
		if (typeof ob.sif_result_value !== "undefined") {
			var sif_result_value = ob.sif_result_value;
		}else{
			var sif_result_value = 'Complaint';
		}


		ob_row += '<tr>'+'<td id="ob" scope="row">'+k+'</td>'+
      '<td style="text-align: center;"><a href="#" data-toggle="modal" data-target="#si_modal"><i class="fas fa-pen"></i></a></td>'+
      '<td style="text-align: center;"><a class="btnDelete" href="#"><i class="far fa-trash-alt"></i></a></td>'+
      '<td>'+ ob.sif_date+'</td>'+
      '<td>'+ ob.sif_time+'</td>'+
      '<td>'+ ob.sif_rule_code+'</td>'+
      '<td>'+sif_result_value+'</td>'+
	  '</tr>';
		
	});
	$('.speed-inspection tbody').html(ob_row);

	var single_sif_data = JSON.stringify(return_data);
	delete_cookie('sif_data');
	setCookie('sif_data', single_sif_data, 1);
	
	var return_data = getCookie('sif_data');
	return_data = JSON.parse(return_data);
	$('#si_modal').find('form')[0].reset();
	$('#si_modal').modal('toggle');
	return true;
});

//Speed inspection filed validation
$(document).on('click', '.add_observation_button', function(e){
	e.preventDefault();
	/*if (
		$('#si_observed_employee').val() != ''
		//&& $('#si_rail_road option:selected').value != ''
		&& $('#si_crew_number').val() != ''
		&& $('#si_speed_number').val() != ''
		&& $('#si_job_description').val() != ''
		&& $('#si_department').val() != ''
		) {
		$('#si_modal').modal('toggle');
	}else{
		alert('Plese enter all fields'); 
	}*/
	$('#si_modal').modal('toggle');
	
});

var submit_new_si_inspection = null;
$(document).on('click', '.submit_new_si_inspection', function(e){
	e.preventDefault();
	window.submit_new_si_inspection = true;
	$('#siform').submit();
});

$(document).on('click', '.submit_si_inspection', function(e){
	e.preventDefault();
	var submit_new_si_inspection = null;
	$('#siform').submit();
});
$(document).on('submit', '#siform', function(e){
	e.preventDefault();
	var formData = $(this).serializeArray();
	var form_array = {};

    $.map(formData, function(n, i){
        form_array[n['name']] = n['value'];
    });

    $.ajax({
			type: 'POST',
			url: base_url+'/Speed_inspections/create_si',
			data: form_array,
			success: function(data){
				
				if (typeof data === 'string' || data instanceof String) {
					data.replace(/(^[ \t]*\n)/gm, "")

					if (!String.prototype.trim) {
					  String.prototype.trim = function () {
					    return this.replace(/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g, '');
					  };
					}
					data.trim();

					if (window.submit_new_si_inspection == true) {				    	
				    	//empty form and table
				    	$('#siform').find('input[type=text]').val('');
				    	$('#si_rail_road').val('').trigger('change');

				    	$('.speed-inspection tbody').html('');
				    	$('#si_bsc_id_show').val($('#si_bsc_id').val());

				    }else if (data == 'success') {
						window.location.href = base_url+'/dashboards/index';
					}
					console.log(data);
				}else{
					var data = JSON.parse(data);
					console.log(data);
				}
			},
			error: function(e){
				console.log(e);
			}
		});
    
});

//End Speed Inspection//






/****
OperatingYard Inspections Tasks 
****/
$(document).on("change", "#oif_task", function(e){
	e.preventDefault();
	var task_id = $(this).val();
	$.ajax({
			type: 'POST',
			url: base_url+'/tasks/getTaskRules/'+task_id,
			data: task_id,
			success: function(data){
				var data = JSON.parse(data);
				var rule_data  = "<option>Select Option</option>";
				$.each(data, function(ekey, err){
					rule_data +=	'<option value="'+err.RULE_ID+'">'+err.DESCRIPTION+'</option>';
				});

				$('#oif_rule').html(rule_data);
			},
			error: function(e){
				console.log(e);
			}
		});
});

$(document).on("change", "#oif_location_type", function(e){
	e.preventDefault();
	var location_type_id = $(this).val();
	$.ajax({
			type: 'POST',
			url: base_url+'/location_types/getLocationsByTypeID/'+location_type_id,
			data: location_type_id,
			success: function(data){
				var data = JSON.parse(data);
				var loc_data  = "<option>Select Option</option>";
				$.each(data, function(ekey, err){
					loc_data +=	'<option value="'+err.LOCATION_ID+'">'+err.DESCRIPTION+'</option>';
				});

				$('#oif_location').html(loc_data);
			},
			error: function(e){
				console.log(e);
			}
		});
});

/***
Operating inspection non complaint raido box
***/
$(document).on('change', 'input[name="oif_result"]', function(){
	console.log(this.value);
	if (this.value == 'non_compliant') {
		$('.oif_non_compliant_div').removeAttr('style');
		$('#oif_non_compliant1, #oif_comment').attr('required', 'required');
	}else{
		var style = {
			'right' : '20',
			'display': 'none'
		};
		$('input[name="oif_non_compliant"]').prop('checked', false);
		
		$('.oif_non_compliant_div').css(style);
		$('#oif_non_compliant1, #oif_comment').removeAttr('required');
	}
});

// Operating Inspection observations cookie
$(document).on("submit", "#oif", function(e){
	e.preventDefault();
	var return_data = [];
	var formData = $(this).serializeArray();
	var form_array = {};

    $.map(formData, function(n, i){
        form_array[n['name']] = n['value'];
    });
    // Retrive desction of selected item
    form_array.oif_location_type_desc = $("#oif_location_type option:selected").text();
    form_array.oif_location_desc = $("#oif_location option:selected").text();
    form_array.oif_milepost_desc = $("#oif_milepost option:selected").text();
    form_array.oif_task_desc = $("#oif_task option:selected").text();
    form_array.oif_line_desc = $("#oif_line option:selected").text();
    form_array.oif_rule_code = $("#oif_rule option:selected").text();
    

    form_array.oif_result_value = $("input[name='oif_non_compliant']:checked").val();
	
	if (checkCookie('oif_data')) {
		return_data = getCookie('oif_data');
		return_data = JSON.parse(return_data);
		return_data.push(form_array);
	}else{
		return_data.push(form_array);
	}
	// Here we will get all the oi obsrvation list 
	// loop and show in table and remove duplecates
	//#TODO  check duplicate 
	var ob_row = '';
	$.each(return_data, function(k, ob){
		k = k+1;
		/*var dNow = new Date(ob.oif_date + ' EDT'); // EDT timezone
		var localdate= (dNow.getMonth()+1) + '/' + dNow.getDate() + '/' + dNow.getFullYear() + ' ' + dNow.getHours() + ':' + dNow.getMinutes();
		var oif_date = (dNow.getMonth()+1) + '/' + dNow.getDate() + '/' + dNow.getFullYear() ;
		var oif_time = formatAMPM(dNow); //dNow.getHours() + ':' + dNow.getMinutes();*/
		//console.log(dNow.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true }));
		if (typeof ob.oif_result_value !== "undefined") {
			var oif_result_value = ob.oif_result_value;
		}else{
			var oif_result_value = 'Complaint';
		}


		ob_row += '<tr>'+
      '<td id="ob" scope="row">'+k+'</td>'+
      '<td style="text-align: center;"><a href="#" data-toggle="modal" data-target="#oi_modal"><i class="fas fa-pen"></i></a></td>'+
      '<td style="text-align: center;"><a class="btnDelete" href="#"><i class="far fa-trash-alt"></i></a></td>'+
      '<td>'+ ob.oif_date+'</td>'+
      '<td>'+ ob.oif_time+'</td>'+
      '<td>'+ ob.oif_rule_code+'</td>'+
      '<td>'+ oif_result_value+'</td>'+
	  '</tr>';
		
	});
	$('.operating-inspection tbody').html(ob_row);

	var single_oif_data = JSON.stringify(return_data);
	delete_cookie('oif_data');
	setCookie('oif_data', single_oif_data, 1);
	
	var return_data = getCookie('oif_data');
	return_data = JSON.parse(return_data);
	$('#oi_modal').find('form')[0].reset();
	$('#oi_modal').modal('toggle');
	return true;
});

//Operating inspection filed validation
$(document).on('click', '.add_observation_button', function(e){
	e.preventDefault();
	/*if (
		$('#oi_observed_employee').val() != ''
		//&& $('#oi_rail_road option:selected').value != ''
		&& $('#oi_crew_number').val() != ''
		&& $('#oi_train_number').val() != ''
		&& $('#oi_job_description').val() != ''
		&& $('#oi_department').val() != ''
		) {
		$('#oi_modal').modal('toggle');
	}else{
		alert('Please enter Inspection fields'); // we can customize it later
	}*/
	$('#oi_modal').modal('toggle');
});
var submit_new_oi_inspection = null;
$(document).on('click', '.submit_new_oi_inspection', function(e){
	e.preventDefault();
	window.submit_new_oi_inspection = true;
	$('#oiform').submit();
});

$(document).on('click', '.submit_oi_inspection', function(e){
	e.preventDefault();
	window.submit_new_oi_inspection = null;
	$('#oiform').submit();
});
$(document).on('submit', '#oiform', function(e){
	e.preventDefault();
	var formData = $(this).serializeArray();
	var form_array = {};

    $.map(formData, function(n, i){
        form_array[n['name']] = n['value'];
    });
    

    $.ajax({
			type: 'POST',
			//url: base_url+'/Operating_inspections/create_gi',
			url: base_url+'/OperatingYard_inspections/create_operatingyard_inspection',
			data: form_array,
			success: function(data){
				
				if (typeof data === 'string' || data instanceof String) {
					data.replace(/(^[ \t]*\n)/gm, "")

					if (!String.prototype.trim) {
					  String.prototype.trim = function () {
					    return this.replace(/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g, '');
					  };
					}
					data.trim();

					if (window.submit_new_oi_inspection == true) {				    	
				    	//empty form and table
				    	$('#oiform').find('input[type=text]').val('');
				    	$('#oi_rail_road').val('').trigger('change');

				    	$('.operating-inspection tbody').html('');
				    	$('#oi_bsc_id_show').val($('#oi_bsc_id').val());

				    }else if (data == 'success') {
						window.location.href = base_url+'/dashboards/index';
					}
					console.log(data);
				}else{
					var data = JSON.parse(data);
					console.log(data);
				}
			},
			error: function(e){
				console.log(e);
			}
		});
    
});


//End OperatinYard Inspection//
































}); // end of $(document).ready()

	
	// check duplicates 
	function arrUnique(arr) {
	    var cleaned = [];
	    arr.forEach(function(itm) {
	        var unique = true;
	        cleaned.forEach(function(itm2) {
	            if (_.isEqual(itm, itm2)) unique = false;
	        });
	        if (unique)  cleaned.push(itm);
	    });
	    return cleaned;
	}

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
    var ac_label; // ac -> auto complete
    var ac_value;
    var u = {
    	bscid : '',
    	FIRST_NAME : '',
    	LAST_NAME : '',
    }
    //var u;
    switch (type) {
    	case 'f_bscid':
            fieldValue = 0;
            ac_value = ac_label = 'u.bscid';
            break;
        case 'gi_bsc_id':
            fieldValue = 0;
            ac_value = ac_label = 'u.bscid';
            break;
        case 'ti_bsc_id':
            fieldValue = 0;
            ac_value = ac_label = 'u.bscid';
            break;
        case 'si_bsc_id':
            fieldValue = 0;
            ac_value = ac_label = 'u.bscid';
            break;
        case 'f_first_name':
            fieldValue = 1;
            ac_value = ac_label = 'u.FIRST_NAME';
            break;
        case 'f_last_name':
            fieldValue = 2;
            ac_value = ac_label = 'u.LAST_NAME';
            break;
        case 'f_job_code':
            fieldValue = 3;
            break;
        case 'f_mgmt_ctr_id':
            fieldValue = 4;
            break;
        case 'gi_observed_employee':
            fieldValue = 5;
            ac_value = ac_label = 'u.bscid';
            break;
        case 'ti_observed_employee':
            fieldValue = 5;
            ac_value = ac_label = 'u.bscid';
            break;
        case 'si_observed_employee':
            fieldValue = 5;
            ac_value = ac_label = 'u.bscid';
            break;
        case 'oi_observed_employee':
            fieldValue = 5;
            ac_value = ac_label = 'u.bscid';
            break;
        default:
            break;
    }
    return {"fieldValue": fieldValue, "ac_value" : ac_value, "ac_label" :ac_label};
}


function handleAutocomplete() {
    var type, type1, fieldValue, currentEle; 
    type = $(this).attr('name');

    field = getFieldValue(type);
    fieldValue = field.fieldValue;
    label = field.ac_label;
    value = field.ac_value;

    currentEle = $(this);

    if(typeof fieldValue === 'undefined') {
        return false;
    }

    $(this).autocomplete({
    	maxShowItems:4,	
        minLength:2,
        source: function( data, cb ) {   
            $.ajax({
                url: $('#base_url').text()+'/Api/userFilter',
                method: 'GET',
                dataType: 'json',
                data: {
                    name:  data.term,
                    fieldValue: fieldValue /* send third param i.e page or module or field name(Observed Employee
)*/
                },
                success: function(res){
                    var result;
                    if (res.length) {
                    	//console.log(res);
                        result = $.map(res, function(u, key){
         					
                            //var arr = obj.split("|");
                           // console.log(u);
                           // console.log(key);
                            //console.log(obj.bscid.split('|'));
                            //console.log(fieldValue);
                            switch (fieldValue) {
						    	case 0:
						            label = value = u.bscid;
						            break;
						        case 1:
						            label = value = u.FIRST_NAME;
						            break;
						        case 2:
						            label = value = u.LAST_NAME;
						            break;
						        case 3:
						            label = value = u.JOBCODE;
						            break;
						        case 4:
						            label = value = u.JOBCODE;
						              /*label = value = u.JOBCODE_DESCR;*/
						            break;
						        case 5:
						            label = value = u.bscid;
						            break;
						        
						        
						        default:
						        	label = value = u.bscid;
						            break;
						    }

                           
                            
                            return {
                                label: label,
                                value: value,
                                data : u
                            };
                        });
                    }
                    cb(result);
                }
            });
        },
        select: function( event, ui ) {
        	if(fieldValue == 0){
	        	resArr = ui.item.data.bscid.split(" ");
	        	//console.log(ui.item.data);
	            $('#'+type).val(resArr[0]); // display the selected text
	            return false; 	
        	}
        	if(fieldValue == 5){
	        	resArr = ui.item.data.bscid.split(" ");
	        	//console.log(ui.item.data);
	            $('#'+type).val(resArr[0]); // display the selected text
	            $('#gi_department_id, #ti_department_id, #si_department_id, #oi_department_id').val(ui.item.data.DEPTID); //DEPTID
	            $('#gi_department, #ti_department, #si_department, #oi_department').val(ui.item.data.DEPT_DESCR); //DEPT_DESCR
	            $('#gi_jobcode_id, #ti_jobcode_id, #si_jobcode_id, #oi_jobcode_id ').val(ui.item.data.JOBCODE); //JOBCODE
	            $('#gi_job_description, #ti_job_description, #si_job_description, #oi_job_description').val(ui.item.data.JOBCODE_DESCR); //JOBCODE_DESCR
	            return false; 	
        	}
        }         
    });
}
/***
COOKIE Functions
***/
function setCookie(cname,cvalue,exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires=" + d.toGMTString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function checkCookie(co) {
    var c = getCookie(co);
    if (c != "") {    
        return true;
    } else {
       return false;
    }
}

function delete_cookie(name) {
    document.cookie = name + '=;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
};

/***
Date Time function 
***/
function formatAMPM(date) {
  var hours = date.getHours();
  var minutes = date.getMinutes();
  var ampm = hours >= 12 ? 'PM' : 'AM';
  hours = hours % 12;
  hours = hours ? hours : 12; // the hour '0' should be '12'
  minutes = minutes < 10 ? '0'+minutes : minutes;
  var strTime = hours + ':' + minutes + ' ' + ampm;
  return strTime;
}