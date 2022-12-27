
$("#login-form").submit(function(e){
	e.preventDefault()

	$.ajax({
		url: 'Action/login_action.php',
		method: 'POST',
		data: $("#login-form").serialize(),
		beforeSend: function(){
			$("#loginBtn").addClass("waitResponse")
		}
	})
	.done(function(funcResponse){
		$("#loginBtn").removeClass("waitResponse");
		getResponse(JSON.parse(funcResponse))
	})

})
	

function getResponse(response){

	if(response['Status'] == 'failed'){
		$("#login-error-container").html(`<p style='color:red;'>${response['Error']['client-input-erro']}</p>`)
	}else if(response['Status'] == 'sucess'){
		window.location.href = "home.php"
	}
		
}