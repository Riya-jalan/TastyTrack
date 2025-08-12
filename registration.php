<?php
session_start();
error_reporting(0);
include("connection/connect.php");
if(isset($_POST['submit'])) {
    if(empty($_POST['firstname']) || empty($_POST['lastname']) || empty($_POST['email']) ||
       empty($_POST['phone']) || empty($_POST['password']) || empty($_POST['cpassword'])) {
        $message = "All fields must be Required!";
    } else {
        $check_username = mysqli_query($db, "SELECT username FROM users WHERE username = '".$_POST['username']."' ");
        $check_email = mysqli_query($db, "SELECT email FROM users WHERE email = '".$_POST['email']."' ");

        if($_POST['password'] != $_POST['cpassword']) {
            echo "<script>alert('Password not match');</script>";
        } elseif(strlen($_POST['password']) < 6) {
            echo "<script>alert('Password Must be >=6');</script>";
        } elseif(strlen($_POST['phone']) < 10) {
            echo "<script>alert('Invalid phone number!');</script>";
        } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            echo "<script>alert('Invalid email address please type a valid email!');</script>";
        } elseif(mysqli_num_rows($check_username) > 0) {
            echo "<script>alert('Username Already exists!');</script>";
        } elseif(mysqli_num_rows($check_email) > 0) {
            echo "<script>alert('Email Already exists!');</script>";
        } else {
            $mql = "INSERT INTO users(username,f_name,l_name,email,phone,password,address)
                    VALUES('".$_POST['username']."','".$_POST['firstname']."','".$_POST['lastname']."',
                           '".$_POST['email']."','".$_POST['phone']."','".md5($_POST['password'])."',
                           '".$_POST['address']."')";
            mysqli_query($db, $mql);
            header("refresh:0.1;url=login.php");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Registration</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
    
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    
    <style type="text/css">
        #buttn {
            color: #fff;
            background-color: #5c4ac7;
        }
        .form-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 40px;
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            color: #ff8e8e;
            margin-bottom: 8px;
            display: block;
            font-weight: 500;
        }
        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 8px;
            background: rgba(255,255,255,0.9);
            font-size: 14px;
            transition: all 0.3s ease;
            color: #333;
        }
        .form-control:focus {
            border-color: #5c4ac7;
            box-shadow: 0 0 0 0.2rem rgba(92, 74, 199, 0.25);
        }
        .btn-register {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background: linear-gradient(45deg, #5c4ac7, #8a7ad4);
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .btn-register:hover {
            background: linear-gradient(45deg, #4a3aa5, #6d5fd1);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(92, 74, 199, 0.3);
        }
        .login-link {
            color: rgba(255,255,255,0.8);
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }
        .login-link a {
            color: #8a7ad4;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .login-link a:hover {
            color: #5c4ac7;
            text-decoration: underline;
        }
        .password-wrapper {
            position: relative;
        }
        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #666;
            cursor: pointer;
        }
        .error-message {
            color: #ff6b6b;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>

    <!-- small helpers to align the eye inside the input -->
    <style>
        /* wrapper around the single input + icon */
        .password-wrapper {
            position: relative;
            display: block; /* takes full width of form-group column */
        }

        /* make room for the eye icon inside the input */
        .password-wrapper .form-control {
            padding-right: 44px;
        }

        /* the toggle button (eye) */
        .password-toggle {
            position: absolute;
            top: 50%;
            right: 12px;                /* tweak this to move horizontally */
            transform: translateY(-50%);
            border: none;
            background: transparent;
            padding: 0;
            margin: 0;
            cursor: pointer;
            z-index: 4;
            color: #777;
            font-size: 18px;           /* icon size */
        }

        .password-toggle:focus {
            outline: none;
        }

        /* optional: change color when active (visible) */
        .password-toggle.active {
            color: #333;
        }

        /* small tweak for very small screens */
        @media (max-width: 480px) {
            .password-wrapper .form-control { padding-right: 40px; }
            .password-toggle { right: 10px; font-size: 17px; }
        }
    </style>
</head>
<body>
    <header id="header" class="header-scroll top-header headrom">
        <nav class="navbar navbar-dark">
            <div class="container">
                <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
                <a class="navbar-brand" href="index.php">
                    <img class="img-rounded" src="images/logo.jpg" alt="" width="18%">
                </a>
                <div class="collapse navbar-toggleable-md float-lg-right" id="mainNavbarCollapse">
                    <ul class="nav navbar-nav">
                        <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link active" href="restaurants.php">Restaurants</a></li>
                        <?php
                        if(empty($_SESSION["user_id"])) {
                            echo '<li class="nav-item"><a href="login.php" class="nav-link active">Login</a></li>
                                  <li class="nav-item"><a href="registration.php" class="nav-link active">Register</a></li>';
                        } else {
                            echo '<li class="nav-item"><a href="your_orders.php" class="nav-link active">My Orders</a></li>
                                  <li class="nav-item"><a href="logout.php" class="nav-link active">Logout</a></li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div style="background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.7)), url('images/back.jpg') no-repeat center center fixed; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; min-height: 100vh; padding-top: 60px;">
        <div style="padding: 30px 0; display: flex; flex-direction: column; justify-content: center; align-items: center; min-height: calc(100vh - 60px);">
            <div class="form-container">
            <h2 style="color: #fff; text-align: center; margin-bottom: 30px; font-size: 28px; font-weight: 600; text-shadow: 0 2px 4px rgba(0,0,0,0.3);">Create an Account</h2>
            
            <?php if(isset($message)) { echo '<div class="error-message">'.$message.'</div>'; } ?>
            
            <form action="" method="post">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label>First Name</label>
                        <input type="text" name="firstname" class="form-control" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Last Name</label>
                        <input type="text" name="lastname" class="form-control" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Phone Number</label>
                        <input type="tel" name="phone" class="form-control" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Password</label>
                        <div class="password-wrapper">
                            <input type="password" name="password" id="password" class="form-control" required>
                            <button type="button" class="password-toggle" onclick="togglePassword('password')">
                                <i class="fa fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Confirm Password</label>
                        <div class="password-wrapper">
                            <input type="password" name="cpassword" id="cpassword" class="form-control" required>
                            <button type="button" class="password-toggle" onclick="togglePassword('cpassword')">
                                <i class="fa fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                        <label>Delivery Address</label>
                        <textarea name="address" rows="3" class="form-control" required></textarea>
                    </div>

                    <div class="col-12">
                        <button type="submit" name="submit" style="width: 100%; padding: 12px; border: none; border-radius: 8px; background: linear-gradient(45deg, #ff6b6b, #ff8e8e); color: white; font-size: 16px; font-weight: 600; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(255, 107, 107, 0.3);">
                            Create Account
                        </button>
                    </div>

                    <div class="col-12">
                        <p class="login-link">
                            Already have an account? <a href="login.php">Sign In</a>
                        </p>
                    </div>
                </div>
            </form>

            </div>
        </div>
    </div>

    <!-- scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/animsition.min.js"></script>
    <script>
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const icon = field.nextElementSibling.querySelector('i');
            
            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                field.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
