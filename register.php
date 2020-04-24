<?php
include 'nliheader.php';

if (isset($_POST['submit'])) {

    $username = strip_tags($_POST["newname"]);
    $signuptime = time();
    $password = $_POST["newpass"];
    $password2 = $_POST["newpassagain"];
    $email = $_POST["email"];
    $checkuser = DB::run("SELECT * FROM `grpgusers` WHERE `username`='$username'");

    $username_exist = $checkuser->rowCount();

    $message = null;

    if($username_exist > 0){
        $message .= "<div>I'm sorry but the username you chose has already been taken.  Please pick another one.</div>";
    }
    if(strlen($username) < 4 or strlen($username) > 20){
        $message .= "<div>The username you chose has " . strlen($username) . " characters. You need to have between 4 and 20 characters.</div>";
    }
    if(strlen($password) < 4 or strlen($username) > 20){
        $message .= "<div>The password you chose has " . strlen($password) . " characters. You need to have between 4 and 20 characters.</div>";
    }
    if($password != $password2){
        $message .= "<div>Your passwords don't match. Please try again.</div>";
    }
//    if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)) {
//        $message .= "<div>The e-mail address you entered was invalid.</div>";
//    }

    //insert the values
    if (!isset($message)){
        $result= DB::run("INSERT INTO `grpgusers` (ip, username, password, email, signuptime, lastactive)".
            "VALUES ('".$_SERVER['REMOTE_ADDR']."', '$username', '$password', '$email', '$signuptime', '$signuptime')");
        echo Message('Your account has been created successfully! Redirecting to login page in 5 seconds. <meta http-equiv="refresh" content="5;url=index.php">');

        if ($_POST['referer'] != ""){
            $result= DB::run("INSERT INTO `referrals` (`when`, `referrer`, `referred`)".
                "VALUES ('$signuptime', '".$_POST['referer']."', '".$username."')");
        }

        die();
    }
}
?>
<?php
if (isset($message)) {
    echo Message($message);
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
      <li class="nav-item">
        <a class="nav-link" href="home.php">Home</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="register.php">SIGNUP<span class="sr-only">(current)</span></a>
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
          <li>Members Online <span>[9]</span></li>
          <li>Total Members <span>[12]</span></li>
        </ul>
    </div><!--members_dv-->
  </div>
</nav>
	<div class="container-fluid">
    	<div class="main_logo"><a href="home.php"><img src="images/mobile-logo.png"></a></div><!--main_logo-->
        <div class="row">
        	<div class="col-md-6">
            	<div class="login_box">
                	<h4>CRIMECITY <span>SIGNUP</span></h4>
                    
                    <form name='register' method='post' action='register.php'>
                    <div class="login_field">
                    	<input type="text" id="newname"  name="newname" class="form-control" placeholder="Username">
                    </div><!--login_field-->
                    <div class="login_field">
                    	<input type="password" id="newpass" name="newpass" class="form-control" placeholder="Password">
                    </div>
<div class="login_field">
                    	<input type="password" id="newpassagain" name="newpassagain" class="form-control" placeholder="Retype Password">
                    </div>
                    <div class="login_field">
                    	<input type="text" id="email" name="email" class="form-control" placeholder="Email">
                    </div><!--login_field-->
                    <div class="login_field_btn">
       
                    	<button type="submit" value="register" id="submit" name="submit">Register</button>
                    </div></form>
                    
            <!--login_field-->
                    
        
                
            
                
    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
  </body>
</html>

