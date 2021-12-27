<?php
date_default_timezone_set('America/Lima');

$user = "root";
$pass = "";

try {
    $conn = new PDO('mysql:host=localhost;dbname=gwhatsapp', $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    print "Error !: " . $e->getMessage() . "<br/>";
    die();
}

?>