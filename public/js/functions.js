/***
Functions
****/

function getBscIdUser(bscid){
	var data;
	if (bscid != null) {
		let input_data = {
			bscid : bscid
		};

		$.ajax({
			type: 'GET',
			url: base_url+'/api/getBscIdUser',
			data: input_data,
			cache: false,
			success: function(data){
				window.data = JSON.parse(data);
			}
		})
	}
	return window.data;
}