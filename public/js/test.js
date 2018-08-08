 $(document).ready(function(){
       
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


 }); 