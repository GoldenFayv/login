<?php

$serverName = "localhost";
$dbUsername = "root";
$dbPassword ="Phpmyadmin@2002";
$dbName = "perfectcup";

$conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);
if(!$conn){
    die("Connection failed: ".mysqli_connect_error());
}