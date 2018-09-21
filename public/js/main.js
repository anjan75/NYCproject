
$(document).ready(function(){
	var base_url = document.getElementById('base_url').innerHTML;
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
					
					if (user.BSC_EMPLID > 0) {
						$('#newTestingOfficerModal #name').val(user.FIRST_NAME+" "+user.LAST_NAME);
						$('#newTestingOfficerModal #department').val(user.DEPTID);
						$('#newTestingOfficerModal #business_unit').val(user.BUSINESS_UNIT);
						$('#newTestingOfficerModal #status_validity').val(user.STATUS_VALIDITY);
						$('#newTestingOfficerModal #status').val(user.STATUS);
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
					                    '<input class="form-check-input" type="radio" name="me_yes_roles[]" id="me_yes_role_'+role.ROLE_ID+'" value="'+role.ROLE_ID+'">'+
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

	/***
	ADD NEW Location type
	***/
	$("form#newLocationTypeForm").on("submit", function(e){
		e.preventDefault();
		var formData = $(this).serialize();
		$.ajax({
				type: 'POST',
				url: base_url+'/location_types/create_location_type',
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
	create railroad
	***/
	$("form#newRailroadForm").on("submit", function(e){
		e.preventDefault();
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

	$(".updateRailRoadModal").on("click", function(e){
		e.preventDefault();
		$('#updateRailroadForm .status_message_div').html();
		
		var railroad_id = $(this).find('.hidden_railroad_id').val();
		var description = $(this).next().text();
		var html = ' <input type="hidden" name="railroad_id" value="'+railroad_id+'" />';

		
		$('#updateRailroadForm #description').val(description);
		$('#updateRailroadForm .status_message_div').append(html);
		
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



	

	$("#newToReset").on("click", function(e){
		e.preventDefault();
		resetTestingOfficerForm();
	});
	
	$(document).on('keyup keypress', 'form input[type="text"]', function(e) {
	  if(e.keyCode == 13) {
	    e.preventDefault();
	    return false;
	  }
	});

	$(".updateTestingOfficerModal").on("click", function(e){
		e.preventDefault();
		//console.log($(this).next().html());
		var bscid = $(this).next().html();
		$('#newTestingOfficerModal').modal('show'); 
		$('#newTestingOfficerModal #bscid').val(bscid).keyup();
		//$(selector).keyup() 
	});




	/***
	DATA TABLE
	***/
	//$('.users-data-users').DataTable();
	 var table = $('.users-data-users').DataTable({
			          	responsive:true,
					    "rowCallback": function (row, data, index) {
					      //check to see if row is expanded
					    if(!$(row).attr('role') || $(row).attr('role') != 'row' || $(row).hasClass('parent')){
					        return;
					    }
					      //add class to expand row
					      $(row).addClass('parent');
					    }
			    });



}); 
	
	function resetTestingOfficerForm(){
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