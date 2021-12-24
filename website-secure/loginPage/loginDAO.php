<?php
    require_once '../common/config.php';

    if(isset($_POST['phpFunction'])) {
        if($_POST['phpFunction'] == 'login') {
            login();
        }
    }

    function login() {
        include '../common/config.php';
        $email = $_POST['email'];
        $pWord = md5($_POST['password']);
        $token = $_POST["g-recaptcha-response"];
        $secret_key = "6LcHXREdAAAAAM5kLz2-J86JUmY-dbXoIL-syn1F";
        $url =  "https://www.google.com/recaptcha/api/siteverify?secret=".$secret_key."&response=".$token;

        $request = file_get_contents($url);
        $response = json_decode($request);
        if($response->success) {
            if (!($st = $con->prepare("SELECT `firstname`, `lastname` FROM `users` WHERE email = :email AND password = :pword"))) {
                die( "Can't prepare the statement :(" );
            }
            $st->execute([ ':email' => $email, ':pword' => $pWord ] );

            $res = $st->fetch(PDO::FETCH_ASSOC);

            if($res) {
                echo json_encode($res);
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