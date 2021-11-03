<?php
    if($_POST['phpfunction'] == 'createUser') {

		createUser();
	}

	function createUser() {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $pass = md5($_POST['password']);

        $id = substr(md5(uniqid(rand(), true)), 16, 16);

        include "../common/config.php";

        $sql = "SELECT * FROM `users` WHERE email='$email'";

        $query = mysqli_query($con, $sql);

        if(mysqli_num_rows($query) > 0){
            echo "This email already registered.";
            return;
        }

        $sql = "INSERT INTO `users`".
               " values ".
               "('$firstname', '$lastname', '$email', '$pass', '$id', NOW())";

        if(mysqli_query($con, $sql)) {
			echo "true";
		} else {
			echo mysqli_error($con);
			return;
		}

		//sendEmail($email, $verificationcode);

		mysqli_close($con);
	};
?>