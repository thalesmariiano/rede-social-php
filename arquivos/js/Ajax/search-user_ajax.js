
$("#search-input").on("input", function(){

	if($("#search-input").val() !== ""){
		$.ajax({
			url: 'Action/search-user_action.php',
			method: 'POST',
			data: $("#search-input").serialize()
		})
		.done(function(response){
			$("#list-ul").html(response);
		});
	}else{
		$("#list-ul").html("");
	}
		
});
