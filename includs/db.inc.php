<?php

$servername = "localhost";
$user = "root";
$pass = "";
$db = "movies";

try{
    $conn = new PDO("mysql:host=$servername; dbname=$db", $user, $pass);

    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return "Connected successfully";
    }catch(PDOException $e) {
        return "Connection failed: " . $e->getMessage();
    }
    