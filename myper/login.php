<?php 
    session_start();

    require'dbh.php';
    require'function.php';

    if($_SERVER['REQUEST_METHOD'] == "POST"){ 
        $email = filter_input(INPUT_POST, 'email');
        $passwd = filter_input(INPUT_POST, 'password');


    
        if(empty($email)){
            $email_err = "Please, enter in your email";
        }
        elseif(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
            $email_err = "Wrong email format";
        }
    
        if(empty($passwd)){
            $passwd_err = "Please, enter in your password";
        }
        elseif(strlen($passwd) < 6){
            $passwd_err ="Your password should have a minimum of 6 characters";
        }

        
            // Read from the db
        elseif(empty($email_err) && empty($passwd_err)){
            $query = "SELECT * FROM members WHERE email = '$email'";
            $results = mysqli_query($conn, $query);
            $num_row = mysqli_num_rows($results);

            if($results){
                if($results && $num_row > 0){
                    $user_data = mysqli_fetch_assoc($results);
                    if($user_data['password'] === $passwd){

                        $_SESSION['fname'] = $user_data['fname'];
                        $_SESSION['lname'] = $user_data['lname'];
                        header("Location: blog.php");
                        die;
                    }
                    else{
                        $login_err = "Wrong Email/Password";
                        // header("Location: login.php?login=success");
                    }
                }
            }

        }
        else{
            $login_err = "Wrong Data";
        }


    }
?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>The Perfect Cub - Register</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/business-casual.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="js/jquery.js"></script>

</head>

<body>

    <div class="brand">The Perfect Cup</div>
    <div class="address-bar">3481 Melrose Place | Beverly Hills, CA 90210 | 123.456.7890</div>

    <!-- Navigation -->
    <?php require_once 'nav.php'; ?>


    <div class="container">

        <!-- <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Contact
                        <strong>business casual</strong>
                    </h2>
                    <hr>
                </div>
                <div class="col-md-8">
                     Embedded Google Map using an iframe - to select your location find it on Google maps and paste the link as the iframe src. If you want to use the Google Maps API instead then have at it! 
                    <iframe width="100%" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?hl=en&amp;ie=UTF8&amp;ll=37.0625,-95.677068&amp;spn=56.506174,79.013672&amp;t=m&amp;z=4&amp;output=embed"></iframe>
                </div>
                <div class="col-md-4">
                    <p>Phone:
                        <strong>123.456.7890</strong>
                    </p>
                    <p>Email:
                        <strong><a href="mailto:name@example.com">name@example.com</a></strong>
                    </p>
                    <p>Address:
                        <strong>3481 Melrose Place
                            <br>Beverly Hills, CA 90210</strong>
                    </p>
                </div>
                <div class="clearfix"></div>
            </div>
        </div> -->

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <div class="alert alert-danger">
                        <strong>You must be logged in to view the blog</strong>
                    </div>
                    <hr>
                    <h2 class="intro-text text-center"><strong>LOGIN</strong></h2>
                    <hr>
                    <div id="add_err2"></div><br>
                    <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat, vitae, distinctio, possimus repudiandae cupiditate ipsum excepturi dicta neque eaque voluptates tempora veniam esse earum sapiente optio deleniti consequuntur eos voluptatem.</p> -->


                    <form role="form" method="post">
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label>Email Address</label>
                                <input type="email" id="email" name="email" maxlength="25" class="form-control">
                                <span style="color: red;">
                                        <?php
                                            if(isset($email_err)){
                                                echo $email_err;
                                            }
                                        ?>
                                    </span>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group col-lg-4">
                                <label>Password</label>
                                <input type="password" id="password" name="password" maxlength="10" class="form-control">
                                <span style="color: red;">
                                    <?php
                                        if(isset($passwd_err)){
                                            echo $passwd_err;
                                        }
                                    ?>
                                </span>
                            </div>
                            <div class="form-group col-lg-12">
                                <!-- <input type="hidden" name="save" value="contact"> -->
                                <button type="submit" class="btn btn-default" name="login" id="login">Login</button>
                                <span style="color: red;">
                                        <?php
                                            if(isset($login_err)){
                                                echo $login_err;
                                            }
                                        ?>
                                    </span>
                            </div>
                        </div>
                    </form>
                    <div class="form-group col-lg-12">
                        <a href="register2.php"><button type="submit" class="btn btn-default">Not a Member? Register here</button></a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container -->

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <!-- <script src="js/jquery.js"></script> -->

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
