//<?php
    $dsn = 'mysql:host=localhost;dbname=trueadvisorydb';
    $username = 'root';
    $password = '';

    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        //print("data_connection_error:".$error_message);
        //include('error.php');
        exit();
    }
?> 