
$("#cadastro-1").submit(function(e){
	e.preventDefault()

	$.ajax({
		url: 'Action/cadastro_action.php',
		type: 'post',
		data: $("#cadastro-1").serialize()
	})
	.done(function(funcResponse){
		getResponse(JSON.parse(funcResponse));
	})

})

function getResponse(response){
		
	if(response['Status'] == 'failed'){
		if(response['Error']['client-input-erro']){
			$("#cadastro-input-message").html(`<small style="color:red">${response['Error']['client-input-erro']}</small>`)
		}else if(response['Error']['client-email-erro']){
			$("cadastro-input-message").html("")
			$("#cadastro-email-message").html(`<small style="color:red">${response['Error']['client-email-erro']}</small>`)
		}else if(response['Error']['client-user-erro']){
			$("#cadastro-input-message").html("")
			$("#cadastro-user-message").html(`<small style="color:red">${response['Error']['client-user-erro']}</small>`)
		}
	}else if(response['Status'] == 'sucess'){
		window.location.href = response['Page']
	}

}