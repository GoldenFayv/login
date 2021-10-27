<?php
    require 'dbh.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $fname = mysqli_real_escape_string($conn, $_POST['fname']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);

        $email_msg = "favour.e2002@gmail.com";
        $subject = "Test Message";

        if(empty($fname)){
            $fname_err = "Please, enter your full name";
        }
        elseif(strlen($fname) < 3){
            $fname_err ="Your first name should have a minimum of 3 characters";
        }

        if(empty($email)){
            $email_err = "Please, enter in your email";
        }
        elseif(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
            $email_err = "Wrong email format";
        }

        if(empty($message)){
            $msg_err = "Please, enter in your message";
        }
        elseif(strlen($message) < 6){
            $msg_err ="Your message is too short";
        }
        elseif(empty($fname_err) && empty($email_err) && empty($msg_err)){
            require "phpmailer/PHPMailerAutoload.php";

            $mail = new PHPMailer;

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = "favour.e2002@gmail.com";
            $mail->password = 'Galaxy200';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->AddReplyTo($email);
            $mail->From = $email_msg;
            $mail->FromName = $fname;
            $mail->addAddress('"favour.e2002@gmail.com"', 'Admin');

            $mail->isHTML(true);

            $mail->Subject = $subject;
            $mail->Body = $message;
            $mail->AltBody = 'This is the body in plain text for non-HTML main clientele';

            if(!$mail->send()){
                $msg = 'Message could not be sent';
                $notSent_err = 'Mailer Error: '. $mail->ErrorInfo;
            }
            else{
                $msg = 'Message successfully sent';
            }
        }

    }
?>    