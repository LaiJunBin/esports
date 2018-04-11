<?php
    $user = 'root';
    $pass = '';
    $dbname = 'esports';
    $host = 'localhost';
    $dsn = "mysql:host=$host;dbname=$dbname";

    $db = new PDO($dsn,$user,$pass);


    
?>