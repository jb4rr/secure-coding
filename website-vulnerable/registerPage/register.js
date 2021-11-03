//Event handler for registration form submit
$('#register_form').submit(function(event){
	formData = $('#register_form').serialize();
    // cancels the form submission
    event.preventDefault();

	$.ajax({
		type: "POST",
		url: "registerDAO.php",
		data: formData+"&phpfunction=createUser",
	    success: function(echoedMsg){
	        if ($.trim(echoedMsg)==='true') {
	            window.location="../loginPage/login.html";
	        };

	    },
		error: function(msg){
			console.log(msg);
	    }
	});
});