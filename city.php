<?php
include (dirname(__file__) .'/header.php');
$result = DB::run("SELECT * FROM `cities` WHERE `id`='".$user_class->city."'");
$worked = $result->fetch();
$checkMail = DB::run("SELECT * FROM `pms` WHERE `to`='$user_class->username' and `viewed`='1'");
$numMsgs = $checkMail->rowCount();
$checkEvents = DB::run("SELECT * FROM `events` WHERE `to`='$user_class->id' and `viewed` = '1'");
$numEvents = $checkEvents->rowCount();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>CRIME CITY</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="icon" href="images/fav.png">
    <link rel="stylesheet" type="text/css" href="css/mystyle.css">
    <link rel="stylesheet" type="text/css" href="css/my-responsive.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
  </head>
  
                
                	
                    
                        	 <h3 class="welcome_heading">Welcome to <span><!_-cityname-_!></span> - Population : 1, 283t</h3>
                             <div class="row">
                             	<div class="col-md-4 inr_col">
                                	<h3><!_-cityname-_!> Top Level</h3>
                                      <p>1. [<span class="red_text">~LF</span>] <span class="green_text">Wayne1</span></p>
                                      <p>2. [<span class="blue_text">C</span><span class="orange_text">O</span><span class="green_text">F</span>] <span class="blue_text">ewok</span></p>
                                      <p>3. [FF] <span class="yellow_text">FnVy TM</span>v</p>
                                      
                                </div><!--col-md-4-->
                                <div class="col-md-4 inr_col">
                                	<h3>THRONE HOLDER</h3>
                                    <p><center><img src="images/scl-icon.png"></center></p>
                                      <p>1. [<span class="red_text">~LF</span>] <span class="green_text">Wayne1</span></p>
                                      <p>Challenge The Throne</p>
                                      
                                </div><!--col-md-4-->
                                <div class="col-md-4 inr_col">
                                	<h3><!_-cityname-_!> Top Stats</h3>
                                      <p>1. [<span class="red_text">~LF</span>] <span class="green_text">Wayne1</span></p>
                                      <p>2. [<span class="blue_text">C</span><span class="orange_text">O</span><span class="green_text">F</span>] <span class="blue_text">ewok</span></p>
                                      <p>33. [FF] notvalid</p>
                                      
                                </div><!--col-md-4-->
                             </div><!--row-->
                             
                             
                             <div class="row">
                             	<div class="col-md-4">
                                  <div class="buttons_dv">
                                    <h4>Shops</h4>
                                    <ul>
                                    	<li><a href="astore.php">Armour Store</a></li>
                                        <li><a href="store.php">Weapon Store</a></li>
                                        <li><a href="itemmarket.php">Item Market</a></li>
                                        <li><a href="pointmarket.php">Point Market</a></li>
                                        <li><a href="spendpoints.php">Point Store</a></li>
                                        <li><a href="pharmacy.php">Drug Store</a></li>
                                        <li><a href="carlot.php">Car Store</a></li>
                                    </ul>
                                  </div><!--buttons_dv-->
                                </div><!--col-md-4-->
                                <div class="col-md-4">
                                  <div class="buttons_dv">
                                    <h4>City Hall</h4>
                                    <ul>
                                    	<li><a href="halloffame.php">Hall of Fame</a></li>
                                        <li><a href="worldstats.php">World Stats</a></li>
                                        <li><a href="viewstaff.php">Staff List</a></li>
                                        <li><a href="search.php">Mobster Search</a></li>
                                        <li><a href="citizens.php">Mobster List</a></li>
                                        <li><a href="online.php">Mobsters Online</a></li>
                                       
                                    </ul>
                                  </div><!--buttons_dv-->
                                </div><!--col-md-4-->
                                <div class="col-md-4">
                                  <div class="buttons_dv">
                                    <h4>Casino</h4>
                                    <ul>
                                    	<li><a href="lottery.php">Daily Lottory</a></li>
                                        <li><a href="slots.php">Slot Machine</a></li>
                                        <li><a href="5050game.php">50/50 Game</a></li>
                                        
                                    </ul>
                                  </div><!--buttons_dv-->
                                </div><!--col-md-4-->
                             </div><!--row-->
                             
                             <div class="row">
                             	<div class="col-md-4">
                                  <div class="buttons_dv">
                                    <h4>Your Life</h4>
                                    <ul>
                                    	<li><a href="pms.php">Mailbox</a></li>
                                        <li><a href="events.php">Events</a></li>
                                        <li><a href="spylog.php">Spy Log</a></li>
                                        <li><a href="inventory.php">Inventory</a></li>
                                        <li><a href="refer.php">Referrals</a></li>
                                        <li><a href="house.php">Move House</a></li>
                                        <li><a href="fields.php">Manage Land</a></li>
                                    </ul>
                                  </div><!--buttons_dv-->
                                </div><!--col-md-4-->
                                <div class="col-md-4">
                                  <div class="buttons_dv">
                                    <h4>Travel</h4>
                                    <ul>
                                    	<li><a href="bus.php">Bus Station</a></li>
                                        <li><a href="drive.php">Drive</a></li>
                                    </ul>
                                  </div><!--buttons_dv-->
                                </div><!--col-md-4-->
                                <div class="col-md-4">
                                  <div class="buttons_dv">
                                    <h4>Downtown</h4>
                                    <ul>
                                    	<li><a href="buydrugs.php">Drug Dealer</a></li>
                                        <li><a href="downtown.php">Search Downtown</a></li>
                                        <li><a href="jobs.php">Job Centre</a></li>
                                        <li><a href="gang_list.php">Gang List</a></li>
                                        <li><a href="gang.php">Your Gang</a></li>
                                        <li><a href="bank.php">Bank</a></li>
                                        <li><a href="realestate.php">Buy Land</a></li>
                                    </ul>
                                  </div><!--buttons_dv-->
                                </div><!--col-md-4-->
                                	                                <div class="col-md-4">
                                  <div class="buttons_dv">
                                    <h4>Trade Centre</h4>
                                    <ul>
                                    	<li><a href="viewstocks.php">Stock Market</a></li>
                                        <li><a href="brokerage.php">Brokerage Firm</a></li>
                                        <li><a href="portfolio.php">View Portfolio</a></li>
                                    </ul>
                                  </div><!--buttons_dv-->
                                </div><!--col-md-4-->
                             </div><!--row-->
                        </div><!--black_bordered_dv-->
                    </div><!--black_dv-->
                </div><!--col-md-8-->                
            </div><!--row-->
        </div><!--inner_blackbody-->
    </div><!--container-->
	

    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
  </body>
</html>
<?php include (dirname(__file__) .'/footer.php'); ?>