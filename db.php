<?php
    $user = 'root';
    $pass = '1234';
    $dbname = 'esports';
    $host = 'localhost';
    $dsn = "mysql:host=$host;dbname=$dbname";

    $db = new PDO($dsn,$user,$pass);
    $db->exec('set names utf8');

    
?>