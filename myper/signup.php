<?php
    if(isset($_POST['register'])){

        require 'dbh.php';

        $firstname = $_POST['fname'];
        $lastname = $_POST['lname'];
        $email = $_POST['email'];
        $pwd = $_POST['password'];
        $cpwd = $_POST['cpassword'];

        if(empty($firstname) || empty($lastname) || empty($email) || empty($pwd)){
            header("location:register.php?error=emptyfields&fname=".$firstname."&lname=".$lastname."&email=".$email);
            exit();
        }
        elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            header("location:register.php?error=invalidemail&fname=".$firstname."&lname=".$lastname);
            exit();
        }
        // elseif(!preg_match("/^[a-zA-Z0-9]*$/", $firstname) || !preg_match("/^[a-zA-Z0-9]*$/", $lastname)){
        //     header("location:register.php?error=invalidlastandfirstname=".$email);
        //     exit();
        // }
        else if($pwd != $cpwd){
            header("location:register.php?error=passwordcheck&fname=".$firstname."&lname=".$lastname."&email=".$email);
            exit();
        }
        
        else{
            $sql = "SELECT email FROM users WHERE email = ?";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("location:register.php?error=sqlerror");
                exit();
            }
            else{
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $resultCheck = mysqli_stmt_num_rows($stmt);
                if($resultCheck > 0){
                    header("location:register.php?error=exactdetailstaken");
                    exit();
                }
                else{
                    $sql = "INSERT INTO users(fname, lname, email, password)VALUES(?, ?, ?, ?)";
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt, $sql)){
                        header("location:register.php?error=sqlerror");
                        exit();
                    }
                    else{
                        $pwdHash = password_hash($pwd, PASSWORD_DEFAULT);

                        mysqli_stmt_bind_param($stmt, "ssss", $firstname, $lastname, $email, $pwd);
                        mysqli_stmt_execute($stmt);
                        header("Location:register.php?signup-success");
                        exit();
                    }
                }
            }
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);

    }
    else{
        header("Location:signup.php");
        exit();
    }