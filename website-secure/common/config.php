<?php      
    $host = "localhost";  
    $user = "root";  
    $password = '';  
    $db_name = "website_db";  
    try {
        $con = new PDO('mysql:dbname=website_db;host=localhost','root','');
    } catch (PDOException $e) {
        die ("Can't connect: ".$e->getMessage());
    }
?> 