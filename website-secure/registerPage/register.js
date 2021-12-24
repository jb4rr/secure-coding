//Event handler for registration form submit
$('#register_form').submit(function(event){
	formData = $('#register_form').serialize();
    // cancels the form submission
    event.preventDefault();
    if  (document.getElementById("validate").value == "true") {
        $.ajax({
            type: "POST",
            url: "registerDAO.php",
            data: formData+"&phpfunction=createUser",
            success: function(echoedMsg){
                alert(echoedMsg)
                if ($.trim(echoedMsg)==='true') {
                    window.location.href="../loginPage/login.html";

                };

            },
            error: function(msg){
                console.log(msg);
            }
        });
    } else {
        alert("Please Enter Valid Password");
    }
});

function passwordChanged() {
    var length = document.getElementById('length');
    var special = document.getElementById('special');
    var number = document.getElementById('number');

    var numberRegex = new RegExp("(?=.*[0-9])", "g");
    var specialRegex = new RegExp("(?=.*[!@#$%^&*?])", "g");

    var pwd = document.getElementById("password");

    if (pwd.value.length >= 8) {
       length.innerHTML = '<span id="length" style="color:green">8 or more characters</span>';
    }
    if (specialRegex.test(pwd.value)) {
       special.innerHTML  = '<span id= "special" style="color:green">Contain a Special Character</span>';
    }
    if (numberRegex.test(pwd.value)) {
       number.innerHTML  = '<span id= "number" style="color:green">Contain a Number</span>';
    }
    if (false == (pwd.value.length >= 8)){
       length.innerHTML  = '<span id="length" style="color:red">8 or more characters</span>';
    }
    if (false == specialRegex.test(pwd.value)) {
       special.innerHTML = '<span id= "special" style="color:red">Contain a Special Character</span>';
    }
    if (false == numberRegex.test(pwd.value)) {
       number.innerHTML = '<span id= "number" style="color:red">Contain a Number</span>';
    }
    if ((pwd.value.length >= 8) && (specialRegex.test(pwd.value)) && (numberRegex.test(pwd.value))) {
        document.getElementById("validate").value = "true";
    } else {
        document.getElementById("validate").value = "false";
    }
}
