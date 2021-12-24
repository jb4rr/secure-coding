var loggedIn = sessionStorage.getItem('firstName')
if ( loggedIn ) {
    firstname = sessionStorage.getItem("firstName")
    lastname = sessionStorage.getItem("lastName")
    document.getElementById("welcome-message").innerText = 'Welcome ' + firstname + ' ' + lastname
} else {
    window.location.href = "../loginPage/login.html"
};

window.onload = function() {
  document.getElementById('message').value = '';
  }

//Event handler for registration form submit
$('#message_form').submit(function(event){
	formData = $('#message_form').serialize();
	formData = formData + '&name=' + sessionStorage.getItem("firstName")
    event.preventDefault();

	$.ajax({
		type: "POST",
		url: "homeDAO.php",
		data: formData+"&phpfunction=uploadMessage",
	    success: function(echoedMsg){
	        if ($.trim(echoedMsg)==='true') {
	            alert("Success");
                location.reload();
	        };
	    },
		error: function(msg){
			console.log(msg);
	    }
	});
});

