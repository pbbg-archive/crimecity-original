<?php
error_reporting(E_ALL);
require_once '../vendor/autoload.php';

session_start();

if (!isset($_SESSION['id'])) {
    include('home.php');
    die();
}

include 'classes.php';

include 'updates.php';


if (isset($_GET['action']) && $_GET['action'] == "logout") {

    session_destroy();

    die('You have been logged out.<meta http-equiv="refresh" content="0;url=index.php">');

}


function microtime_float()

{

    $time = microtime();

    return (double)substr($time, 11) + (double)substr($time, 0, 8);

}


microtime_float();

$starttime = microtime_float();


if (Is_User_Banned($_SESSION['id']) == 1) {

    echo "<h1>" . Why_Is_User_Banned($_SESSION['id']) . "</h1>";

    die();

}

$user_class = new User($_SESSION['id']);

// get style info
$cresult = DB::run("SELECT `value` FROM `styles` WHERE `style`='" . $user_class->style . "'");
$i = 0;
while ($line = $cresult->fetch(PDO::FETCH_LAZY)) {
    $color[$i] = $line['value'];
    $i++;
}
//get style info

$worked = DB::run("SELECT * FROM `serverconfig`")->fetch();
if ($worked['serverdown'] != "" && $user_class->admin != 1) {
    die("<h1><font color='red'>SERVER DOWN<br><br>" . $worked['serverdown'] . "</font></h1>");
}

$time = date('F d, Y g:i:sa', time());

$result = DB::run("UPDATE `grpgusers` SET `lastactive` = '" . time() . "', `ip` = '" . $_SERVER['REMOTE_ADDR'] . "' WHERE `id`='" . $_SESSION['id'] . "'");


function callback($buffer)
{
    $user_class = new User($_SESSION['id']);

    $checkhosp = DB::run("SELECT * FROM `grpgusers` WHERE `hospital`!='0'");
    $nummsgs = $checkhosp->rowCount();
    $hospital = "[" . $nummsgs . "]";

    $checkjail = DB::run("SELECT * FROM `grpgusers` WHERE `jail`!='0'");
    $nummsgs = $checkjail->rowCount();
    $jail = "[" . $nummsgs . "]";

    $checkmail = DB::run("SELECT * FROM `pms` WHERE `to`='$user_class->username' and `viewed`='1'");
    $nummsgs = $checkmail->rowCount();
    $mail = "[" . $nummsgs . "]";

    $checkmail = DB::run("SELECT * FROM `events` WHERE `to`='$user_class->id' and `viewed` = '1'");
    $numevents = $checkmail->rowCount();
    $events = "[" . $numevents . "]";

    $result = DB::run("SELECT * from `effects` WHERE `userid`='" . $user_class->id . "'");
    if ($result->rowCount() != 0) {
        $effects = '<div class="headbox">Current Effects</div>';
        while ($line = $result->fetch()) {
            $effects .= '<a class="leftmenu" href="effects.php?view=' . $line['effect'] . '">' . $line['effect'] . " (" . floor($line['timeleft']) . ")" . '</a></ul><br />';
        }
    }

    $out = $buffer;
    $out = str_replace("<!_-id-_!>", $user_class->id, $out);
    $out = str_replace("<!_-money-_!>", $user_class->money, $out);
    $out = str_replace("<!_-credits-_!>", $user_class->credits, $out);
    $out = str_replace("<!_-avatar-_!>", $user_class->avatar, $out);
    $out = str_replace("<!_-formhp-_!>", $user_class->formattedhp, $out);
    $out = str_replace("<!_-hpperc-_!>", $user_class->hppercent, $out);
    $out = str_replace("<!_-formenergy-_!>", $user_class->formattedenergy, $out);
    $out = str_replace("<!_-energyperc-_!>", $user_class->energypercent, $out);
    $out = str_replace("<!_-expperc-_!>", $user_class->exppercent, $out);
    $out = str_replace("<!_-formawake-_!>", $user_class->formattedawake, $out);
    $out = str_replace("<!_-awakeperc-_!>", $user_class->awakepercent, $out);
    $out = str_replace("<!_-formnerve-_!>", $user_class->formattednerve, $out);
    $out = str_replace("<!_-nerveperc-_!>", $user_class->nervepercent, $out);
    $out = str_replace("<!_-points-_!>", $user_class->points, $out);
    $out = str_replace("<!_-level-_!>", $user_class->level, $out);
    $out = str_replace("<!_-hospital-_!>", $hospital, $out);
    $out = str_replace("<!_-jail-_!>", $jail, $out);
    $out = str_replace("<!_-mail-_!>", $mail, $out);
    $out = str_replace("<!_-events-_!>", $events, $out);
    $out = str_replace("<!_-effects-_!>", $effects, $out);
    $out = str_replace("<!_-cityname-_!>", $user_class->cityname, $out);
    $out = str_replace("<!_-hookers-_!>", $user_class->hookers, $out);
    $out = str_replace("<!_-username-_!>", $user_class->formattedname, $out);

    return $out;
}

ob_start("callback");


?>
<!DOCTYPE html>
<html lang="en">
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- Required meta tags -->
    
     <!--responsive-meta-here-->
    
    <meta name="viewport" content="minimum-scale=1.0, maximum-scale=1.0,width=device-width, user-scalable=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <!--responsive-meta-end-->
	<title>CRIME CITY</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="icon" href="images/fav.png">
    <link rel="stylesheet" type="text/css" href="css/mystyle.css">
   <link rel="stylesheet" type="text/css" href="css/my-responsive.css"> 
    <link href="css/googlefonts.css" rel="stylesheet">
<style type="text/css">
.content { width: 100%;

	padding: 0px; }



.contenthead { background-color: <?= $color[4] ?>;

	border: 1px solid <?= $color[2] ?>;

	padding: 5px;

	color: <?= $color[1] ?>;

	font-weight: bold;

	font-size: 12px; }



.contentcontent { background-color: <?= $color[0] ?>;

	border: 1px solid <?= $color[2] ?>;

	padding: 3px;

	color: <?= $color[1] ?>;

	font-size: 11px; }
/*Strip the ul of padding and list styling */

ul {
    list-style-type: none; 
    margin: 0; 
    padding: 0;
    position: absolute;
}

/* Creates a horizontal list with spacing*/

li {
  display: inline-block;
  float: left;
  margin-right: 1px;
}

/*Style for menu links */

li a {
  display: block;
  min-width: 142px;
  height: 50px;
  text-align: center;
  line-height: 50px;
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
  color: #fff;
  background: #961919;
  text-decoration: none; 
  
}

/* Hover State for top level links*/

li:hover a {
  background: #19c589;
}

/* Style for dropdown links*/

li:hover ul a {
  background: #f3f3f3;
  color: #2f3036;
  height: 40px;
  line-height: 40px;
}

/* Hover state for dropdown links */ 
li:hover ul a:hover {
  background: #19c589;
  color: #fff;
}

/*Hide dropdown links until they are need */
li ul {
  display: none;
}

/*Make dropdown links vertical */

li ul li {
  display: block; 
  float: none; 
}

/*Prevent text wrapping */
li ul li a {
  width: auto; 
  min-width: 100px; 
  padding: 0 20px; 
}

/*Display the dropdown on hover */
ul li a:hover + .hidden, .hidden:hover {
  display: block; 
}

</style>
  </head>
  <body class="inner_bg">
  	
	<div class="container inner-container">
		
    	<div class="inner_header">
        	<div class="row">
        	
            	<div class="col-md-4 header-top-1">
                	<div class="row">
                    	<div class="col-md-6">
                        	 <div class="text_btn">
                        	 <p>Cash in hand</p>
                             <h4>$<!_-money-_!></h4>
                             <a href="bank.php" class="small_btn">DEPOSIT</a>
                             </div><!--text_btn-->
                        </div><!--col-md-6-->
                        <div class="col-md-6">
                        	 <div class="text_btn">
                        	 <p>Banked cash</p>
                             <h4>$<?php echo $user_class->bank; /*money_format('%(#10n', $user_class->bank);*/ ?></h4>
                             <a href="bank.php" class="small_btn">WITHDRAW</a>
                             </div><!--text_btn-->
                        </div><!--col-md-6-->
                    </div><!--row-->
                </div><!--col-md-3-->
                <div class="col-md-4 header-top-2">
                	<div class="row">
                    	
                        <div class="col-md-12">
                        	                         <center>	<div class="inner_header_logo"><a href="index.php" valign="center"><center><img src="images/logo.png"></center></a></div></center><!--inner_header_logo-->
                        	<div class="inner_mascot">
                        	
                            	                <br>	<div class="no_avatar">
                            	
                                        	<center><img src="images/no-avtar.png"></center>
                                        
                                     
                                    <div class="col-md-6">
                                    	<div class="no_avatar_text">
                                        </div><!--no_avatar_text-->
                                    </div><!--col-md-6-->
                                </div><!--row-->
                                <p class="NewRPG"><?= ($user_class->rmdays >0) ? ' <img src="images/username/'.$user_class->id.'.png" style="height:20px" style="width:22px">' : '<a href="profiles.php?id="'. $_SESSION['id'] ."'>". $user_class->formattedname ."</a>" ?></b></font></a></br>
                                <b>ID: <!_-id-_!> |  Level: <!_-level-_!></b><br>
                               <b> <a href="pms.php"><font color="white">Mailbox</font> <span class="orange_text"><b><!_-mail-_!></b></span></a> | <a href="events.php"><font color="white">Events </font><span class="orange_text"><b><!_-events-_!></b></span></a></b>
                            </div>
                            </div><!--inner_mascot-->
                        </div><!--col-md-6-->
                    </div><!--row-->
					 <div class="col-md-4 header-top-1">
                	<div class="row">
                    	<div class="col-md-6">
                        	 <div class="text_btn">
                        	 <p>Your Points</p>
                             <h4><!_-points-_!></h4>
                             <a href="spendpoints.php" class="small_btn">USE</a>
                             <a href="rmstore.php" class="small_btn">BUY</a>
                             </div><!--text_btn-->
                        </div><!--col-md-6-->
                        <div class="col-md-6">
                        	 <div class="text_btn">
                        	 <p>Your Credits</p>
                             <h4><!_-credits-_!></h4>
                             <a href="spendcredits.php" class="small_btn">USE</a>
                              <a href="rmstore.php" class="small_btn">BUY</a>
                             
                             </div><!--text_btn-->
                        </div><!--col-md-6-->
                    </div><!--row-->
                </div><!--col-md-3-->
                </div><!--col-md-4-->
           
               
            </div><!--row-->
        </div><!--inner_header-->
        <div class="health_energy_bar">
        	<div class="row">
            	<div class="col-md-4">
                	<div class="row">
                    	<div class="col-md-6">
                        	<p>Health: <?php echo $user_class->formattedhp; ?></p>
    <div class="progress">
                 <div class="progress-bar progress-bar-striped bg-danger" style="width:<!_-hpperc-_!>%;" title="<!_-formhp-_!>%;">
                     
                       
                    </div></div></div>
    	<!--col-md-6-->
    <div class="col-md-6">
                        	<p>Energy: <?php echo $user_class->formattedenergy; ?></p>
    <div class="progress">
<div class="progress-bar progress-bar-striped bg-danger" style="width:<!_-energyperc-_!>%;" title="<!_-formenergy-_!>%;" ></div>
                       
              </div>
                    
    </div>
 <!--col-md-6-->
                    </div><!--row-->
                </div><!--col-md-4-->
                <div class="col-md-4">
					<p class="text-center">EXP: <?php echo $user_class->formattedexp; ?></p>
                    <div class="progress">
                       <div class="progress-bar progress-bar-striped bg-info" style="width:<!_-expperc-_!>%;" title="<!_-formexp-_!>">&nbsp</div>
                    </div>
                </div><!--col-md-4-->
                <div class="col-md-4">
                	<div class="row">
                	<div class="col-md-6">
                        	<p>Awake: <?php echo $user_class->formattedawake; ?></p>
    <div class="progress">
                 <div class="progress-bar progress-bar-striped bg-danger" style="width:<!_-awakeperc-_!>%;" title="<!_-formawake-_!>%;">
                     
                       
                    </div></div></div>
                    	<!--col-md-6-->
                    	<div class="col-md-6">
                        	<p>Nerve: <?php echo $user_class->formattednerve; ?></p>
    <div class="progress">
                 <div class="progress-bar progress-bar-striped bg-danger" style="width:<!_-nerveperc-_!>%;" title="<!_-formnerve-_!>%;">
                     
                       
                    </div></div></div>
<!--col-md-6-->
                    </div><!--row-->
                </div><!--col-md-4-->
            </div><!--row-->
        </div><!--health_energy_bar-->
        <div class="inner_blackbody">
            
            <center><ul id="menu">
    <li><a href="index.php">Home</a></li>
    <li>
        <a href="city.php"><!_-cityname-_!> </a>
        <ul class="hidden">
          <li><a href="<?php echo ($user_class->gang == 0) ? "creategang.php" : "gang.php"; ?>"">Your Gang</a></li>
          <li><a href="classifieds.php">Ads</a></li>
<li><a href="rmstore.php">RM Store</a></li>
        </ul>
            <li><a href="inventory.php">Inventory</a></li>
    </li>
       <li><a href="gym.php">Gym</a></li>
    <li>
      <a href="crime.php">Crime</a>
    </li>
    <li>
    <a href="jail.php">Jail <!_-jail-_!></a>
    <li>
        <a href="hospital.php">Hospital <!_-hospital-_!> </a>
    </li>
    
    <li>
<a href="index.php?action=logout">Logout</a>
</li>
   
    
  </ul></center>
            <br><br></br>
        	<p class="assassination"><?= ($user_class->admin == 1) ? '
		 <a href="control.php">Staff Panel</a></p> ' : 'Assassination Bar : Coming Soon*'?>
            <div class="row user-home-table">
            	<div class="col-md-4 footer-table">
                	
              
               
                <div class="col-md-8 footer-table" style="width:555px">
                <div class="col-md-8 footer-table" style="width:555px">
                	<div class="black_dv"style="width:1260px">
                    	<div class="black_bordered_dv inner_body">
                    	  
                        
                        	 <center> <font color="white"><table class="content" style="font-color:white">
                                        <?php
                                        if ($user_class->admin == 1 || $user_class->rmdays > 0){
                                        } else {
                                        ?>

                                            <center></center></center></font>


                                            <?php
                                            }

                                            //echo ($user_class->admin == 1) ? "Admin Toolbar<br>"."<a href='" . "http://bourbanlegends.com/grpg" . $_SERVER['PHP_SELF']."?hackthegibson=iamgayandwantfullhealth'>Full Health</a>"." | <a href='" . "http://bourbanlegends.com/grpg" . $_SERVER['PHP_SELF']."?hackthegibson=iamgayandwantfullnerve'>Full Nerve</a>" . " | <a href='" . "http://bourbanlegends.com/grpg" . $_SERVER['PHP_SELF']."?hackthegibson=iamgayandwantoutofthehospital'>Get Out Of Hospital</a>" . " | <a href='" . "http://bourbanlegends.com/grpg" . $_SERVER['PHP_SELF']."?hackthegibson=iamgayandwantfullenergy'>Full Energy</a>" : "";


                                            //echo ($user_class->admin > 0) ? "<tr><td class='contenthead'>DJ Toolbar</td></tr><tr><td class='contentcontent' align='center'><a href='staff.php?radio=on'>Turn Radio On</a> | <a href='staff.php?radio=off'>Turn Radio Off</a> | <a href='staff.php?random=person'>Pick A Random Player</a></td></tr>" : "";

                                            $result = DB::run("SELECT * FROM `ganginvites` WHERE `username` = '$user_class->username'");
                                            //$invites_exist = mysql_num_rows($result);

                                            if ($result->rowCount() > 0) {
                                                $invite_class = New Gang($line['gangid']);
                                                echo "<tr><td class='contentcontent'>You have new gang invitatations <a href='ganginvites.php'>View Gang Invites</a></td></tr>";

                                            }

                                            if ($user_class->jail > 0) {
                                                echo "<tr><td class='contenthead'>Jail</td></tr><tr><td class='contentcontent' align='center'>You are currenty in jail for " . floor($user_class->jail / 60) . " more minutes.</td></tr>";

                                                die();
                                            }
                                            if ($user_class->hospital > 0) {
                                                echo "<tr><td class='contenthead'>Hospital</td></tr><tr><td class='contentcontent' align='center'>You are in the hospital for " . floor($user_class->hospital / 60) . " more minutes.</td></tr>";

                                                die();
                                            }

                                            ?>
                                            	
                        </div><!--black_bordered_dv-->
                    </div><!--black_dv-->
                </div><!--col-md-8-->                
            </div><!--row-->
        </div><!--inner_blackbody-->
    </div><!--container-->
	</table>

    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
  </body>
</html>