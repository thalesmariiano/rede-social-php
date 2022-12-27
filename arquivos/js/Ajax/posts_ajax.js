

$("#textArea").on("input", function(){
	$("#sendPost-btn").removeClass("blockBtn");
		
	if($("textArea").val() == ""){
		$("#sendPost-btn").addClass("blockBtn");
	}
});

////////////////////////////////////////////////

function getPosts(){
	$.ajax({
		url: 'Action/readPosts_action.php',
		method: 'POST',
		beforeSend: function(){
			$(".spinner-container").css("display", "flex");
		}
	})
	.done(function(funcResponse){
		getResponse(JSON.parse(funcResponse));
	});
}
getPosts();

function getResponse(response){

	if(response['Status'] == 'failed'){
		$("#post-container").html(`<p id="no-posts-message" style="text-align:center; margin:10px">${response['Error']['empty']}</p>`)
	}else if(response['Status'] == 'sucess'){
		$("#post-container").html("");
		for(let p=0; p < response['Data'].length; p++){
			var post = response['Data'][p];

			$("#post-container").prepend(`<div class="post">
					<div class="post-header">
						<p>@${post["p-user"]}</p>
						<div style="display:flex;align-items:center" id="left">
 							<span style="margin-right:5px">${post["p-time"]}</span>
 							<button class="delete-post"style="cursor:pointer" onClick="deletePost(${post['id']})"><span class="material-icons">delete</span></button>
 						</div>
 					</div>
 					<p style="padding:5px">${post["p-content"]}</p>
 					<div class="post-interact">
 						<div class="interact-item" id="like-interact">
							<span class="material-icons">favorite_border</span>
							<span>${post["p-like"]}</span>
 						</div>
 						<div class="interact-item" id="comment-interact">
 							<span style="cursor: not-allowed" class="material-icons">mode_comment</span>
 							<span>${post["p-comment"]}</span>
 						</div>
 						<div style="cursor: not-allowed" class="interact-item" id="share-interact">
 							<span class="material-icons">share</span>
 							<span>${post["p-shares"]}</span>
 						</div>
 					</div>
				</div>`);
		}
	}
}

//////////////////////////////////////////////

$("#post-form").submit(function(e){
	e.preventDefault();

	$.ajax({
		url: 'Action/createPost_action.php',
		method: 'post',
		data: $("#post-form").serialize(),
		beforeSend: function(){
			$(".spinner-container").css("display", "flex");
			$("#sendPost-btn").addClass("blockBtn");
		}
	})
	.done(function(funcResponse){
		$("#textArea").val("");
		$("#no-posts-message").remove();
		getPosts();
	});
});

////////////////////////////////////////////////

function deletePost(pId){
	
	$.ajax({
		url: 'Action/deletePost_action.php',
		method: 'POST',
		data: {
			id: pId
		}
	})
	.done(function(funcResponse){
		console.log(JSON.parse(funcResponse));
		getPosts();
	})

}