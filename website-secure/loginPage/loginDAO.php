<?php
require_once '../common/config.php';

if(isset($_POST['phpFunction'])) {
    /*if($_POST['phpFunction'] == 'checkLogin') {
        checkLogin();
    } else*/if($_POST['phpFunction'] == 'login') {
        login();
    }
}

function login() {
	$email = $_POST['email'];
	$pWord = md5($_POST['password']);
	$token = $_POST["g-recaptcha-response"];
	$secret_key = "6LcHXREdAAAAAM5kLz2-J86JUmY-dbXoIL-syn1F";
    $url =  "https://www.google.com/recaptcha/api/siteverify?secret=".$secret_key."&response=".$token;

    $request = file_get_contents($url);
    $response = json_decode($request);
    if($response->success) {

        $sql = "SELECT `firstname`, `lastname` FROM `users` WHERE email='".$email."' AND password='".$pWord."'";

        include '../common/config.php';

        $res = mysqli_query($con, $sql);
        $num_row = mysqli_num_rows($res);
        $row=mysqli_fetch_assoc($res);
        if( $num_row == 1 ) {
            echo json_encode($row);
        }
        else {
            // Incorrect Username and Password
            echo 'false';
        }
	} else {
	    // Failed reCAPTCHAv3
	    echo "unauthorized";
    	}
}

?>