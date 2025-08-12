<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
error_reporting(0);
session_start();
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>Restaurants</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.9)), url('images/back.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Roboto', sans-serif;
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }
        .restaurant-entry {
            margin: 0 auto 30px;
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
            display: flex;
            flex-direction: column;
            color: #fff;
            position: relative;
            height: 100%;
            max-width: 800px;
            width: 100%;
        }
        .restaurant-entry:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.12);
        }
        .entry-logo {
            padding: 25px 25px 15px;
            text-align: center;
            background: rgba(255, 255, 255, 0.1);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            flex-shrink: 0;
        }
        .entry-logo img {
            width: 100%;
            max-width: 160px;
            height: 120px;
            object-fit: cover;
            border-radius: 8px;
            margin: 0 auto;
            display: block;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
            border: 1px solid rgba(255,255,255,0.1);
        }
        .restaurant-entry:hover .entry-logo img {
            transform: scale(1.03);
        }
        .entry-dscr {
            padding: 20px 25px 25px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        .entry-dscr h5 {
            margin: 0 0 10px 0;
        }
        .entry-dscr h5 a {
            color: #fff;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 1.2rem;
            text-shadow: 0 1px 2px rgba(0,0,0,0.2);
        }
        .entry-dscr h5 a:hover {
            color: #e74c3c;
        }
        .entry-dscr span {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.95em;
            margin-bottom: 15px;
            line-height: 1.5;
            text-shadow: 0 1px 1px rgba(0,0,0,0.2);
        }
        .right-content {
            padding: 0 !important;
            text-align: center;
            margin: 0;
            background: transparent !important;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            min-height: 120px;
        }
        .btn-purple {
            background: linear-gradient(45deg, #ff6b6b, #ff8e8e) !important;
            border: none !important;
            border-radius: 8px !important;
            padding: 12px 25px !important;
            color: white !important;
            font-weight: 600 !important;
            text-transform: uppercase !important;
            letter-spacing: 1px !important;
            transition: all 0.3s ease !important;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2) !important;
            width: 100% !important;
            max-width: 180px !important;
            margin: 0 auto !important;
            font-size: 0.85rem !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            position: relative !important;
            overflow: hidden !important;
            z-index: 1 !important;
        }
        
        .btn-purple:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, #ff8e8e, #ff6b6b);
            z-index: -1;
            opacity: 0;
            transition: all 0.3s ease;
        }
        
        .btn-purple:hover:before {
            opacity: 1;
        }
        
        .btn-purple i {
            margin-left: 8px;
            transition: transform 0.3s ease;
        }
        
        .btn-purple:hover i {
            transform: translateX(3px);
        }
        .btn-purple:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(231, 76, 60, 0.35);
            color: white;
            background: linear-gradient(45deg, #ff5e5e, #ff7b7b);
        }
        .inner-page-hero {
            background: none;
            padding: 100px 0 60px;
            position: relative;
            margin-bottom: 10px;
            text-align: center;
        }
        
        .inner-page-hero h1 {
            font-size: 3rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 15px;
            text-shadow: 0 2px 10px rgba(0,0,0,0.3);
            letter-spacing: 0.5px;
        }
        
        .inner-page-hero p {
            color: rgba(255,255,255,0.9);
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.6;
        }
        .inner-page-hero:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(44, 62, 80, 0.9) 0%, rgba(0, 0, 0, 0.7) 100%);
        }
        .top-links {
            background: rgba(0, 0, 0, 0.5);
            padding: 15px 0;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 30px;
        }
        .top-links .link-item {
            color: #ecf0f1;
            text-align: center;
            padding: 15px 0;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            position: relative;
        }
        .top-links .link-item:not(:last-child):after {
            content: '›';
            position: absolute;
            right: -15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            font-size: 1.2rem;
        }
        .top-links .link-item span {
            display: block;
            width: 36px;
            height: 36px;
            background: linear-gradient(45deg, #ff6b6b, #ff8e8e);
            border-radius: 50%;
            margin: 0 auto 8px;
            line-height: 36px;
            color: white;
            font-weight: 600;
            font-size: 0.9rem;
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }
        .top-links .link-item.active {
            color: #ff6b6b;
            font-weight: 600;
        }
        .restaurants-page {
            padding: 20px 0 80px;
        }
        
        .restaurants-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
            margin: 30px 0;
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
            padding: 0 15px;
        }
        
        .restaurant-entry {
            margin: 0;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
            display: flex;
            flex-direction: column;
            color: #fff;
            position: relative;
            height: 100%;
        }
        
        .entry-logo {
            padding: 20px 20px 15px;
            text-align: center;
            background: rgba(255, 255, 255, 0.1);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .entry-logo img {
            width: 100%;
            max-width: 180px;
            height: 140px;
            object-fit: cover;
            border-radius: 8px;
            margin: 0 auto;
            display: block;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            border: 1px solid rgba(255,255,255,0.1);
        }
        
        .entry-dscr {
            padding: 20px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        
        .right-content {
            padding: 0 20px 25px;
            text-align: center;
            margin-top: auto;
        }
        
        @media (max-width: 992px) {
            .restaurants-grid {
                grid-template-columns: 1fr;
                max-width: 500px;
                gap: 20px;
            }
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }
        
        .bg-gray {
            background: transparent !important;
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 40px;
            position: relative;
        }
        
        .section-title h2 {
            color: #fff;
            font-weight: 600;
            font-size: 2.5rem;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            position: relative;
            display: inline-block;
            padding-bottom: 15px;
        }
        
        .section-title h2:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: linear-gradient(45deg, #ff6b6b, #ff8e8e);
            border-radius: 3px;
        }
        
        .section-title p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1.1rem;
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.6;
        }
        
        .section-title h2:after {
            background: linear-gradient(45deg, #ff6b6b, #ff8e8e);
            height: 2px;
            width: 100px;
            margin: 15px auto 0;
        }
        .section-title {
            text-align: center;
            margin-bottom: 40px;
            position: relative;
        }
        .section-title h2 {
            font-weight: 700;
            color: #2c3e50;
            position: relative;
            display: inline-block;
            padding-bottom: 15px;
        }
        .section-title h2:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: linear-gradient(45deg, #ff6b6b, #ff8e8e);
            border-radius: 3px;
        }
    </style>
</head>

<body>

    <header id="header" class="header-scroll top-header headrom">
        <nav class="navbar navbar-dark">
            <div class="container">
                <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
                <a class="navbar-brand" href="index.php" style="margin-right: 15px;">
                    <img class="img-fluid" src="images/logo.jpg" alt="FoodPicky" style="max-height: 60px; width: auto; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.3)); transition: all 0.3s ease;">
                </a>
                <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
                    <ul class="nav navbar-nav">
                        <li class="nav-item"> <a class="nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a> </li>
                        <li class="nav-item"> <a class="nav-link active" href="restaurants.php">Restaurants <span class="sr-only"></span></a> </li>

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
    <div class="page-wrapper">
        <div class="top-links">
            <div class="container">
                <ul class="row links">
                    <li class="col-xs-12 col-sm-4 link-item">
                        <span>1</span>
                        <a href="#">Choose Location</a>
                    </li>
                    <li class="col-xs-12 col-sm-4 link-item active">
                        <span>2</span>
                        <a href="#">Choose Restaurant</a>
                    </li>
                    <li class="col-xs-12 col-sm-4 link-item">
                        <span>3</span>
                        <a href="#">Pick Your food</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="container m-t-30">
            <div class="row">
                <div class="col-12">
                    <div class="inner-page-hero text-center">
                        <h1 class="display-4 text-white mb-3">Our Partner Restaurants</h1>
                        <p class="lead text-white-50">Discover amazing food from top-rated restaurants</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="result-show">
            <div class="container">
                <div class="row">
                </div>
            </div>
        </div>
        
        <section class="restaurants-page">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="restaurants-grid">
                    <?php $ress= mysqli_query($db,"select * from restaurant");
									      while($rows=mysqli_fetch_array($ress))
										  {
													
						
													 echo' <div class="col-sm-12 col-md-12 col-lg-8 text-xs-center text-sm-left">
															<div class="entry-logo">
																<a href="dishes.php?res_id='.$rows['rs_id'].'" >
																	<img src="admin/Res_img/'.$rows['image'].'" alt="'.$rows['title'].'" class="img-fluid">
																</a>
															</div>
															<!-- end:Logo -->
															<div class="entry-dscr">
																<h5><a href="dishes.php?res_id='.$rows['rs_id'].'" >'.$rows['title'].'</a></h5> <span>'.$rows['address'].'</span>
																
															</div>
															<!-- end:Entry description -->
														</div>
														
														 <div class="col-sm-12 col-md-12 col-lg-4 text-xs-center">
																<div class="right-content bg-white">
																	<div class="right-review">
																		
																		<a href="dishes.php?res_id='.$rows['rs_id'].'" class="btn btn-purple">View Menu</a> </div>
																</div>
																<!-- end:right info -->
															</div>';
										  }
						
						
						?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
            </div>
    </div>
    </section>

    <?php include "include/footer.php" ?>

    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/animsition.min.js"></script>
    <script src="js/bootstrap-slider.min.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/headroom.js"></script>
    <script src="js/foodpicky.min.js"></script>
</body>

</html>