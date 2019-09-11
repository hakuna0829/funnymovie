<?php
// Initialize the session
session_start();
if(isset($_GET['logout'])){
    
    unset($_SESSION['loggedin']);
    session_destroy();
    // header("location: index.php");
    // exit;
}
// echo $_SERVER['REQUEST_URI'];exit;
// Check if the user is already logged in, if yes then redirect him to welcome page

if( !isset($_SESSION["loggedin"]) && $_SERVER['REQUEST_URI'] == '/share.php' )  {
    header("location: index.php");
    exit;
}


require_once('config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Registeration | PHP</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/custom.css">
</head>
<body>
<!-- <header> -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="welcome.php"><img src="img/logo_.png" width=150 alt=""></a>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li><h1>Funny Movie</h1></li>
            </ul>
            <?php 
            
            if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
            ?>
                <div class="form-inline my-2 my-lg-0">
                    <span>Welcome <?php echo $_SESSION["user_name"].' ('.$_SESSION["user_email"].')' ?></span>&ensp;
                    <a class="btn btn-outline-primary my-2 my-sm-0" href="share.php">Share Movie</a>&ensp;
                    <a class="btn btn-outline-primary my-2 my-sm-0" href="index.php">Home</a>&ensp;
                    <a class="btn btn-outline-dark my-2 my-sm-0" href="?logout">Log out</a>
                </div>
            <?php }
            else{
            ?>
                <form class="form-inline my-2 my-lg-0" id="signinForm">
                    <input class="form-control mr-sm-2" type="email" id="loginEmail" name="loginEmail" placeholder="Email" aria-label="Email" required>
                    <input class="form-control mr-sm-2" type="password" id="loginPassword"  name="loginPassword" placeholder="Password" aria-label="Password" required>
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit" id="btn_login" name="btn_login">Login</button>&ensp;
                    <?php 
                    if($_SERVER['REQUEST_URI'] != '/signup.php'){ 
                    ?>
                        <a class="btn btn-outline-primary my-2 my-sm-0" href="signup.php">Sign up</a>
                    <?php
                    }else{
                    ?>
                        <a class="btn btn-outline-primary my-2 my-sm-0" href="index.php">Home</a>
                    <?php
                    }
                    ?>
                    
                </form>
            <?php 
            }
            ?>
        </div>
    </nav>
<!-- </header> -->