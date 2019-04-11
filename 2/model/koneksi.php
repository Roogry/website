<?php
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db_name = 'inventa';

    $conn = new PDO("mysql:host=$host;dbname=$db_name", $user, $pass);
?>