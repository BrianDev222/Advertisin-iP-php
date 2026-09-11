<?php

$server = 'localhost';
$username = 'root';
$password = 'db123'; // Your database password
$dbname = 'ip-Advertisement'; // Your project database name

try {

    $options = [ PDO:: ATTR_ERRMODE => PDO:: ERRMODE_EXCEPTION, PDO:: ATTR_DEFAULT_FETCH_MODE => PDO:: FETCH_ASSOC ];
    $pdo = new  PDO ( 'mysql:host=' . $server . ';  dbname='. $dbname  ,  $username  ,  $password  ,  $options );

} catch (PDOException $e) {

    echo 'ERROR  '. $e-> getMessage();

    exit();

}

?>