$('#userLogin').submit(function(event){

		formData = $('#userLogin').serialize();

		event.preventDefault();


		$.ajax({
			type: "POST",
			url: "loginDAO.php",

			data: formData+"&phpFunction=login",
			datatype: 'json',
		    success: function(data){
		        console.log(data)
				if($.trim(data)=='false') {
					alert("Wrong Username or Password");
				}
				else {
					dataJson = JSON.parse(data);
					firstName = dataJson['firstname'];
					lastName = dataJson['lastname'];
					sessionStorage.setItem('firstName', firstName);
					sessionStorage.setItem('lastName', lastName);

					window.location="../homePage/home.html";
				}
		    },
		});
		//return false;
});
