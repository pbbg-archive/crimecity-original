<?php
include 'header.php';
          }

                                            if ($user_class->admin> 0) {
                                                echo "You are not allowed here dickhead!";

                                                die();
                                            }
                                            ?>
     <!DOCTYPE html>
<html lang="en">
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- Required meta tags -->
    
     <!--responsive-meta-here-->
    <meta charset="utf-8" />
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
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
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
       <div class="headbox">Control Panel</div>
			<font color="black">  <a class="leftmenu" href="control.php" style="font-size:13px">Marquee/Maintenance</a>
			 <font color="black"> <a class="leftmenu" href="control.php?page=rmoptions" style="font-size:13px">RM Options</a></font>
			<font color="black">  <a class="leftmenu" href="control.php?page=setplayerstatus" style="font-size:13px">Player Options</a></font>
			<font color="black">  <a class="leftmenu" href="massmail.php" style="font-size:13px">Mass Mail</a></font>
			<font color="black">  <a class="leftmenu" href="control.php?page=referrals" style="font-size:13px">Manage Referrals</a></font>
			<font color="black">  <a class="leftmenu" href="control.php?page=crimes" style="font-size:13px">Manage Crimes</a></font>
			 <font color="black"> <a class="leftmenu" href="control.php?page=cities" style="font-size:13px">Manage Cities</a></font>
			<font color="black">  <a class="leftmenu" href="control.php?page=jobs" style="font-size:13px">Manage Jobs</a></font>
			<font color="black">  <a class="leftmenu" href="control.php?page=playeritems" style="font-size:13px">Manage Items</a></font>
		  </div></div>
</body>
</html>
?>                                 	