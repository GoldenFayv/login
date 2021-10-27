<?php
    // $fname = $_POST['fname'];
    // $lname = $_POST['lname'];
    // $email = $_POST['email'];
    // $passswd = $_POST['password'];
    $fname = filter_input(INPUT_POST, 'fname');
    $lname = filter_input(INPUT_POST, 'lname');
    $email = filter_input(INPUT_POST, 'email');
    $passswd = filter_input(INPUT_POST, 'password');


    if(empty($fname)){
        $fname_err = "First name";
    }
    elseif(strlen($fname) < 3){
        $fname_err ="Your first name has to have a minimum of 3 characters";
    }

    elseif(empty($lname)){
        $lname_err = "Last name";
    }
    elseif(strlen($lname) < 3){
        $lname_err ="Your last name has to have a minimum of 3 characters";
    }

    elseif(empty($email)){
        $email_err = "Email";
    }
    elseif(filter_var($email, FILTER_VALIDATE_EMAIL)=== false){
        $email_err = "Wrong email format";
    }

    elseif(empty($passswd)){
        $passwd_err = "Password";
    }
    elseif(strlen($passswd) < 6){
        $passwd_err ="Your password has to have a minimum of 6 characters";
    }

    elseif(empty($fname_err) && empty($lname_err) && empty($email_err) && empty($passwd_err)){


        $result = mysqli_query("SELECT * FROM members WHERE email = '$email'");
        $num_row = mysqli_num_rows($result) or die(mysqli_error());
        $row = mysqli_fetch_array($result);


        if($num_row < 1){
            $insert_row = $mydb->query("INSERT INTO members(fname, lname, email, password)VALUES('$fname', '$lname', '$email', '$password')");
            if($insert_row){
                $_SESSION['login'] = $mydb->insert_id;
                $_SESSION['fname'] = $fname;
                $_SESSION['lname'] = $lname;

            // echo "true";
            }

        }

        // include('blog.php');
    }

    
    // include('register.php');








    // if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //     if(empty($_POST['lname'])){
    //         $lname_err = "Please enter your last name";
    //     }
    //     if(empty($_POST['fname'])){
    //         $fname_err = "Please enter your first name";
    //     }
    //     if(empty($_POST['email'])){
    //         $email_err = "Please enter your email";
    //     }
    //     if(empty($_POST['password'])){
    //         $password_err = "Please enter your password";
    //     }
    //     else if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
    //         $eformat_err = "Wrong email format";
    //     }
    //     else{
    //         $passWord = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));
        
        
    //         $result = mysqli_query($mydb, "SELECT * FROM members WHERE email = '$email'");
    //         $num_row = mysqli_num_rows($result) or die(mysqli_error());
    //         $row = mysqli_fetch_array($result);
        
        
    //         if($num_row < 1){
    //             $insert_row = $mydb->query("INSERT INTO members(fname, lname, email, password)VALUES('$fname', '$lname', '$email', '$password')");
    //             if($insert_row){
    //                 $_SESSION['login'] = $mydb->insert_id;
    //                 $_SESSION['fname'] = $fname;
    //                 $_SESSION['lname'] = $lname;
        
    //                 echo "true";
    //             }
        
    //         }
    //         else{
    //             echo "false";
    //         }
    //     }
    // }

?>