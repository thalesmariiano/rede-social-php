
var btnPass = document.getElementById("seePass")
var inputPass = document.getElementById("pass")

btnPass.addEventListener("click", function(){
	if(inputPass.getAttribute("type") == "password"){
		inputPass.setAttribute("type", "text")
		btnPass.innerHTML = '<span class="material-icons">visibility</span>'
	}else if(inputPass.getAttribute("type") == "text"){
		inputPass.setAttribute("type", "password")
		btnPass.innerHTML = '<span class="material-icons">visibility_off</span>'
	}
})

inputPass.addEventListener("input", function(){
	document.getElementById("seePass").style.display = "initial"
})