<?php
$user = "root";
//$pass = "click_shop123";
$pass = "";
$host = "localhost";
$port = "3307";
$dbname = "click_shop";
$dsn = "mysql:host=" . $host . ";port=" . $port . ";dbname=" . $dbname;
try {
   $db = new PDO($dsn, $user, $pass);
} catch (Exception $e){
    echo "Erreur " . $e->getMessage();
    die();
}
