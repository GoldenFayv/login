<?php
session_start();

$mydb = new mysqli('localhost', 'root', 'Phpmyadmin@2002', 'perfectcup');

if($mydb->connect_error){
    die("Connection failed: $mydb ->connect_error");
}
$email = $_POST["email"];
$pword = $_POST["password"];

$query = "SELECT * FROM members WHERE email = '$email'";
$result = mysqli_query($mydb, $query) or die(mysqli_error());
$num_row = mysqli_num_rows($result);
$row = mysqli_fetch_array($result);

if($num_row == 1){

    if(password_verify($pword, $row['password'])){
        $_SESSION['login'] = $row['id'];
        $_SESSION['fname'] = $row['fname'];
        $_SESSION['lname'] = $row['lname'];
        echo 'true';
    }
    else{
        echo 'false';
    }
}
else{
    echo 'false';
}
// ?>