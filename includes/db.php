<?php

require_once __DIR__ . '/env.php';
$connection = null;
try{
    $connection = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e){
    echo "Connection failed: " . $e->getMessage();
    exit();
}
