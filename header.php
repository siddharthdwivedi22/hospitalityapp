
<?php
ob_start();
session_start();
require_once 'dbconnect.php'

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Brighton-Hove Accommodations </title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
    <link rel="stylesheet" href="style.css" type="text/css" />
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="assets/owl-carousel/owl.carousel.css"/>
    <link rel="stylesheet" href="assets/owl-carousel/owl.theme.css"/>
    <link rel="stylesheet" type="text/css" href="assets/slitslider/css/style.css" />
    <link rel="stylesheet" type="text/css" href="assets/slitslider/css/custom.css" />
    <script type="text/javascript" src="assets/jquery-1.11.3-jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="script.js"></script>
    <script type="text/javascript" src="assets/script.js"></script>
    <script type="text/javascript" src="assets/slitslider/js/modernizr.custom.79639.js"></script>
    <script type="text/javascript" src="assets/slitslider/js/jquery.ba-cond.min.js"></script>
    <script type="text/javascript" src="assets/slitslider/js/jquery.slitslider.js"></script>
    <script type="text/javascript" src="assets/owl-carousel/owl.carousel.js"></script>
</head>

<body>
<div class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="home.php">Home</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <?php if(empty($_SESSION['user'])) { ?>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Sign Up</a></li>
                <?php } ?>
                <li><a href="accommodation.php">Become a Host</a></li>
                <li><a href="properties.php">My Properties</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php if(!empty($_SESSION['user'])) { ?>
                    <li><a href="#" ><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['username']; ?></a></li>
                    <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a>  </li>
                <?php } ?>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
    </div>
<div id="wrapper">
<div class="jumbotron" >
    <div class="container">
        <h1 style="color: black">Brighton-Hove Accommodations</h1>
    </div>
    </div>
</div>


