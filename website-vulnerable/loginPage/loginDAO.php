<?php
require_once '../common/config.php';

if(isset($_POST['phpFunction'])) {
    if($_POST['phpFunction'] == 'login') {
        login();
    }
}

function login() {

	session_start();
	$email = $_POST['email'];
	$pWord = md5($_POST['password']);

	$sql = "SELECT `firstname`, `lastname` FROM `users` WHERE email='".$email."' AND password='".$pWord."'";

    include '../common/config.php';

	$res = mysqli_query($con, $sql);
	$num_row = mysqli_num_rows($res);
	$row=mysqli_fetch_assoc($res);
	if( $num_row == 1 ) {
		echo json_encode($row);
	}
	else {
		echo 'false';
	}
}

?>