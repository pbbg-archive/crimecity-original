Images as your username
* Mccodes version 2.*
* Created by sniko
* Paid system £20 // NOW A FREE RELEASE BY SNIKO.
* 1 License only.
* This README was adjusted by Reecey12345 of MWG for easier tutorial.
* chmod images/username to 777, if it's not already
* Create new directory "images/username"
* Open phpmyadmin



CREATE TABLE IF NOT EXISTS `user_imageusername` 
(

   `userid` int(11) NOT NULL,

   `imagepath` varchar(50) NOT NULL COMMENT 'exclude the directory names.',

    PRIMARY KEY (`userid`)

) 
ENGINE=MyISAM 
DEFAULT CHARSET=latin1 
COMMENT='PAID SYSTEM BY sniko';

* Open header.php & find:

if($ir['donatordays']) { $u = "<font color=red>{$ir['username']}</font>";$d="<img src='donator.gif' alt='Donator: {$ir['donatordays']} Days Left' title='Donator: {$ir['donatordays']} Days Left' />"; }

* Add below:

/* See if their username is an image. - sniko */
$get = $db->query("SELECT `imagepath` FROM `user_imageusername` WHERE `userid`={$_SESSION['userid']}");
if( $db->num_rows($get) ) {
  $r_image = $db->fetch_row($get);
  $txt_username = $ir['username'];
  $ir['username'] = "<img src=\"images/username/{$r_image['imagepath']}\" alt=\"{$txt_username}\" />";
}

* Open viewuser.php & find:

if($r['donatordays']) { $r['username'] = "<font color=red>{$r['username']}</font>";$d="<img src='donator.gif' alt='Donator: {$r['donatordays']} Days Left' title='Donator: {$r['donatordays']} Days Left' />"; }
if($r['laston'] >= time()-15*60) { $on="<font color=green><b>Online</b></font>"; } else { $on="<font color=red><b>Offline</b></font>"; 
}

* Add below:

/* See if their username is an image. - sniko */
$get = $db->query("SELECT `imagepath` FROM `user_imageusername` WHERE `userid`={$_GET['u']}");
if( $db->num_rows($get) ) {
  $r_image = $db->fetch_row($get);
  $txt_username = $r['username'];
  $r['username'] = "<img src=\"images/username/{$r_image['imagepath']}\" alt=\"{$txt_username}\" />";
}

* Open userlist.php & find:

if($r['donatordays']) { $r['username'] = "<font color=red>{$r['username']}</font>";$d="<img src='donator.gif' alt='Donator: {$r['donatordays']} Days Left' title='Donator: {$r['donatordays']} Days Left' />"; 
}

* Add below:

/* See if their username is an image. - sniko */
$get = $db->query("SELECT `imagepath` FROM `user_imageusername` WHERE `userid`={$r['userid']}");
if( $db->num_rows($get) ) {
  $r_image = $db->fetch_row($get);
  $txt_username = $r['username'];
  $r['username'] = "<img src=\"images/username/{$r_image['imagepath']}\" alt=\"{$txt_username}\" />";
}

* IM NOT SURE WHERE THIS GOES? I DIDN'T ADD THIS PART TO MY GAmE AND WORKS PERFECTLY WITHOUT IT *

function username($userid) {
global $db;
$ori = $db->query("SELECT `username` FROM `users` WHERE `userid`={$userid}");
$get = $db->query("SELECT `imagepath` FROM `user_imageusername` WHERE `userid`={$userid}");
if( $db->num_rows($get) ) {
   $r_image = $db->fetch_row($get);
   $txt_username = $db->fetch_single($ori);
   return "<img src=\"images/username/{$r_image['imagepath']}\" alt=\"{$txt_username}\" />";
} else {
   return $db->fetch_single($ori);
}
}