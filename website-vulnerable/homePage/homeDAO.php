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

        $sql = "INSERT INTO `posts`".
               " values ".
               "('$firstname', '$message', NOW())";

        if(mysqli_query($con, $sql)) {
			echo "true";
		} else {
			echo mysqli_error($con);
			return;
		}

		mysqli_close($con);
	};

	function load_posts() {
        $sql = "SELECT * FROM `posts`";

        include '../common/config.php';

        $res = mysqli_query($con, $sql);
        $num_row = mysqli_num_rows($res);

        echo "<table style= 'margin-left: auto; margin-right: auto; width:500px;'>";
        echo "<tr><td>NAME</td><td>MESSAGE</td><td>DATE</td></tr>";
        while($row = mysqli_fetch_array($res)) {
            echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td></tr>";
        }
        echo "</table>";

        return;
	}

?>

