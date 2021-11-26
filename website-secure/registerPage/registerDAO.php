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

        if (!($st = $con->prepare("SELECT * FROM `users` WHERE email = :email"))) {
                die( "Can't prepare the statement :(" );
            }
        $st->execute([ ':email' => $email]);
        $res = $st->fetch(PDO::FETCH_ASSOC);

        if($res) {
            echo "This email already registered.";
            return;
        } else {
            if (($st = $con->prepare("INSERT INTO `users` values (:firstname,:lastname,:email,:pass,:id, NOW())"))) {
                $st->execute([':firstname' => $firstname,':lastname' => $lastname, ':email' => $email, ':pass' => $pass, ':id' => $id]);
                echo "Success Registered"
            } else {
                echo "error";
            }
        }
	};
?>