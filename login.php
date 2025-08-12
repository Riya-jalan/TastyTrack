<!--  Author Name: MH RONY.
     Modified: Added eye icon toggle for password visibility
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login || Code Camp BD</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

    <link rel='stylesheet prefetch'
        href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
    <link rel='stylesheet prefetch'
        href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

    <link rel="stylesheet" href="css/login.css">

    <style type="text/css">
        #buttn {
            color: #fff;
            background-color: #5c4ac7;
        }
    </style>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body>
    <header id="header" class="header-scroll top-header headrom">
        <nav class="navbar navbar-dark">
            <div class="container">
                <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse"
                    data-target="#mainNavbarCollapse">&#9776;</button>
                <a class="navbar-brand" href="index.php"> <img class="img-rounded" src="images/logo.jpg" alt=""
                        width="18%"> </a>
                <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
                    <ul class="nav navbar-nav">
                        <li class="nav-item"> <a class="nav-link active" href="index.php">Home <span
                                    class="sr-only">(current)</span></a> </li>
                        <li class="nav-item"> <a class="nav-link active" href="restaurants.php">Restaurants <span
                                    class="sr-only"></span></a> </li>

                        <?php
						if(empty($_SESSION["user_id"]))
							{
								echo '<li class="nav-item"><a href="login.php" class="nav-link active">Login</a> </li>
							  <li class="nav-item"><a href="registration.php" class="nav-link active">Register</a> </li>';
							}
						else
							{
								echo  '<li class="nav-item"><a href="your_orders.php" class="nav-link active">My Orders</a> </li>';
								echo  '<li class="nav-item"><a href="logout.php" class="nav-link active">Logout</a> </li>';
							}
						?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div style="background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.7)), url('images/login.jpg') no-repeat center center fixed; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; min-height: 100vh; padding: 40px 0; display: flex; flex-direction: column; justify-content: center; align-items: center;">

        <?php
        include("connection/connect.php"); 
        error_reporting(0); 
        session_start(); 
        if(isset($_POST['submit']))  
        {
            $username = $_POST['username'];  
            $password = $_POST['password'];
            
            if(!empty($_POST["submit"]))   
            {
                $loginquery ="SELECT * FROM users WHERE username='$username' && password='".md5($password)."'"; 
                $result=mysqli_query($db, $loginquery);
                $row=mysqli_fetch_array($result);
                
                if(is_array($row)) 
                {
                    $_SESSION["user_id"] = $row['u_id']; 
                    header("refresh:1;url=index.php"); 
                } 
                else
                {
                    $message = "Invalid Username or Password!"; 
                }
            }
        }
        ?>

        <div class="pen-title"></div>

        <div class="module form-module" style="background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); border-radius: 15px; box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37); border: 1px solid rgba(255, 255, 255, 0.18); width: 100%; max-width: 400px; padding: 40px; margin: 20px;">
            <div class="toggle"></div>
            <div class="form">
                <h2 style="color: #fff; text-align: center; margin-bottom: 30px; font-size: 28px; font-weight: 600; text-shadow: 0 2px 4px rgba(0,0,0,0.3);">Welcome Back!</h2>
                <span style="color:red;"><?php echo $message; ?></span>
                <span style="color:green;"><?php echo $success; ?></span>
                <form action="" method="post">
                    <div class="form-group" style="margin-bottom: 20px;">
                        <input type="text" placeholder="Username" name="username" style="width: 100%; padding: 12px 15px; border: 1px solid rgba(255,255,255,0.2); border-radius: 8px; background: rgba(255,255,255,0.9); font-size: 14px; transition: all 0.3s ease;" />
                    </div>

                    <div class="form-group" style="margin-bottom: 25px; position: relative;">
                        <input type="password" placeholder="Password" name="password" id="password" 
                            style="width: 100%; padding: 12px 40px 12px 15px; border: 1px solid rgba(255,255,255,0.2); border-radius: 8px; background: rgba(255,255,255,0.9); font-size: 14px; transition: all 0.3s ease;" />
                        <span id="togglePassword" 
                            style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #666;"
                            onmouseover="this.style.color='#333'" 
                            onmouseout="this.style.color='#666'"
                            title="Show/Hide Password">
                            <i class="fa fa-eye" id="eyeIcon"></i>
                        </span>
                    </div>

                    <button type="submit" id="buttn" name="submit" style="width: 100%; padding: 12px; border: none; border-radius: 8px; background: linear-gradient(45deg, #ff6b6b, #ff8e8e); color: white; font-size: 16px; font-weight: 600; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(255, 107, 107, 0.3);">
                        Login
                    </button>
                    <p style="text-align: center; margin-top: 25px; color: rgba(255,255,255,0.8); font-size: 14px;">
                        Don't have an account? <a href="registration.php" style="color: #ff8e8e; text-decoration: none; font-weight: 500; transition: all 0.3s ease;" onmouseover="this.style.color='#ff6b6b'" onmouseout="this.style.color='#ff8e8e'">Create one</a>
                    </p>
                </form>
            </div>
        </div>

    </div>

        <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

        <!-- Eye toggle script -->
        <script>
            const togglePassword = document.querySelector("#togglePassword");
            const password = document.querySelector("#password");
            const eyeIcon = document.querySelector("#eyeIcon");

            togglePassword.addEventListener("click", function () {
                const type = password.getAttribute("type") === "password" ? "text" : "password";
                password.setAttribute("type", type);

                if (type === "password") {
                    eyeIcon.classList.remove("fa-eye-slash");
                    eyeIcon.classList.add("fa-eye");
                } else {
                    eyeIcon.classList.remove("fa-eye");
                    eyeIcon.classList.add("fa-eye-slash");
                }
            });
        </script>


        </div>


</body>

</html>
