<?php
error_reporting(E_ALL);
include 'nliheader.php';


if(isset($_POST['submit'])){


    $username = $_POST["username"];

    $password = $_POST["password"];

    $result = DB::run("SELECT * FROM `grpgusers` WHERE `username`='$username'");// or die ("Name and password not found or not matched");
    $worked = $result->fetch();

    $user_class = new User($worked['id']);

    if($worked['password'] == $password){

        if($user_class->rmdays > 0){

            echo '<meta http-equiv="refresh" content="0;url=index.php">';

        } else {

            ?>
echo '<meta http-equiv="refresh" content="0;url=index.php">';

            
            <?php

        }

        $_SESSION["id"] = $worked['id'];

        die();

    } else {

        echo Message('Sorry, your username and password combination are invalid.');

    }

}

?>
<!DOCTYPE html>
<html lang="en">
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- Required meta tags -->
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>CRIME CITY</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="icon" href="images/fav.png">
    <link rel="stylesheet" type="text/css" href="css/mystyle.css">
    <link rel="stylesheet" type="text/css" href="css/my-responsive.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
  </head>
  <body class="main_bg">
  <nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse navigation">
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="#"><img src="images/mobile-logo.png"></a>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="story.php">STORY</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="blog.php">BLOG</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="register.php">SIGNUP</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="guide.php">HOW TO PLAY</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="forum.php">FORUMS</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="chat.php">CHAT</a>
      </li>
    </ul>
    <div class="members_dv">
        <ul class="menu_right">
          <li>Members Only <span>[0]</span></li>
          <li>Total Members <span>[12]</span></li>
        </ul>
    </div><!--members_dv-->
  </div>
</nav>
	<div class="container-fluid">
    	<div class="main_logo"><a href="home.php"><img src="images/logo.png"></a></div><!--main_logo-->
        <div class="row">
        	<div class="col-md-6">
            	<div class="login_box">
                	<h4>EXISTING USER ? <span>LOGIN BELOW</span></h4>
                     <form name='login' method='post' action='home.php' >
                    <div class="login_field">
                    	<input type="text" id="username"  name="username" class="form-control" placeholder="Username">
                    </div><!--login_field-->
                    <div class="login_field">
                    	<input type="password" id="password" name="password" class="form-control" placeholder="Password">
                    </div><!--login_field-->
                    <div class="login_field_btn">
                    	<button type="submit" value="submit" id="submit" name="submit">Login</button>
                    </div></form><!--login_field-->
                    
                    <div class="row">
                	<div class="col-md-6">
                    	<div class="checkbox_dv remember_me">
                    	 <input type="checkbox" name="1" id="pay1"> 
 						 <label for="pay1">Remember me</label>
                         </div><!--remember_me-->
                    </div><!--col-md-6-->
                    <div class="col-md-6">
                    	<div class="forgot_Password"><a href="forgot.php">Forgot Password</a></div><!--Forgot Password-->
                    </div><!--col-md-6-->
                </div><!--row-->
                </div><!--login_box-->
                <div class="clearfix"></div>
                <div class="welcome_dv">
                	<h3>Welcome to Crime City</h3>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, </p>
                    <h4>New User</h4>
                    <a href="#" class="register_free">REGISTER FOR FREE</a>
                </div><!--Welcome dv -->
            </div><!--col-md-6-->
            <div class="col-md-6">
            	<div class="mascot_dv">
                	<img src="images/mascot-2.png">
                </div><!--mascot_dv-->
            </div><!--col-md-6-->
        </div><!--row-->
    </div><!--container-fluid-->
    <div class="bottom_panel">
    	<div class="container-fluid">
        	<div class="row">
            	<div class="col-md-6">
                	<h4><span>GAME</span> SCREENSHOTS</h4>
                    <ul class="game-screenshots">
                    	<li><img src="images/game-screenshot-1.png"></li>
                        <li><img src="images/game-screenshot-2.png"></li>
                        <li><img src="images/game-screenshot-3.png"></li>
                    </ul>
                </div><!--col-md-6-->
                <div class="col-md-6">
                	<h4><span>RECENT</span> IN GAME ITEMS</h4>
                    <ul class="recent-items">
                    	<li><img src="images/recent-game-item-1.png"></li>
                        <li><img src="images/recent-game-item-2.png"></li>
                        <li><img src="images/recent-game-item-3.png"></li>
                        <li><img src="images/recent-game-item-4.png"></li>
                        <li><img src="images/recent-game-item-5.png"></li>
                    </ul>
                </div><!--col-md-6-->
            </div><!--row-->
            <p class="last_line">The game is currently in the closed beta stage so registration will not work.</p>
        </div><!--container-fluid-->
    </div><!--bottom_panel-->

    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
  </body>
</html>