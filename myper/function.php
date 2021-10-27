<?php
function check_login($conn){
    if(isset($_SESSION['fname'])){
        $fname = $_SESSION['fname'];
        $query = "SELECT * FROM members WHERE fname = '$fname'";

        $result = mysqli_query($conn, $query);
        if($result && mysqli_num_rows($result) > 0){
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }
    // redirect to login
    header("Location: login.php");
    die;
}