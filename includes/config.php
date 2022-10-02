<?php
ob_start(); // Turns on output buffering
session_start();

date_default_timezone_set("Europe/London");

try {
    $con = new PDO("mysql:dbname=album;host=localhost", "root", "");
    
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    
    // if($con){
    //     echo "connection succefull";
    // }else{
    //     echo "not working";
    // }
}
catch (PDOException $e) {
    exit("Connection failed: " . $e->getMessage());
}
?>