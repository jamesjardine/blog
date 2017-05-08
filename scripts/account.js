$(document).ready(function(){
	$('form').submit(function(event){
		event.preventDefault();
		var formData = {
			'action' : 'update',
			'id' : $('input[name=id]').val(),
			'email' : $('input[name=email]').val()
		};
		$.ajax({
			url: 'api/account.php',
			type: 'post',
			data: formData,
			dataType : 'json',
			encode : true,
			success: function(data,status){
				if(data =="ok"){
					$('msg').html('Account Updated');
				}
			},
			error: function(xhr,desc,err){
				console.log(xhr);
				$('msg').html('Update Failed');
			}
		});
	});
});