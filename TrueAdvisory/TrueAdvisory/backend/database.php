<?php
    $dsn = 'mysql:host=localhost;dbname=trueadvisorydb'; //$dsn = 'mysql:host=141.215.80.154;dbname=group5_db';
    $username = 'root'; //$username = 'group5';
    $password = ''; //$password = 'iROUJ@qm6Mz';
    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        //print("data_connection_error:".$error_message);
        //include('error.php');
        exit();
    }
?> 
