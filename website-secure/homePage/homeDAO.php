<?php

    if(isset($_POST['phpfunction'])) {
         if($_POST['phpfunction'] == 'uploadMessage') {
            uploadMessage();
        };
        if($_POST['phpfunction'] == 'load_posts') {
            load_posts();
        };
    }

	function uploadMessage() {
        $firstname =  $_POST['name'];;
        $message = $_POST['message'];

        include "../common/config.php";


        if (!($st = $con->prepare("INSERT INTO `posts` values (:name,:message,NOW())"))) {
                die( "Can't prepare the statement :(" );
            }
        $st->execute([':name' => $firstname,':message' => $message]);
        $res = $st->fetch(PDO::FETCH_ASSOC);

        if (!$res) {
			echo "true";
		}

		return;
	};

	function load_posts() {
	include '../common/config.php';

	if (!($st = $con->prepare("SELECT * FROM `posts`"))) {
                die( "Can't prepare the statement :(" );
            }
        $st->execute();
        $res = $st->fetchAll();

        echo "<table style= 'margin-left: auto; margin-right: auto; width:500px;'>";
        echo "<tr><td>NAME</td><td>MESSAGE</td><td>DATE</td></tr>";
        foreach($res as $row) {

            echo "<tr><td>" . htmlentities($row[0], ENT_QUOTES, 'UTF-8') .
                "</td><td>" . htmlentities($row[1], ENT_QUOTES, 'UTF-8') .
                "</td><td>" . htmlentities($row[2], ENT_QUOTES, 'UTF-8') . "</td></tr>";
        }
        echo "</table>";

        return;
	}

?>

