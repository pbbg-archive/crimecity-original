<?php
include (dirname(__file__) .'/header.php');
$result = DB::run("SELECT * FROM `cities` WHERE `id`='".$user_class->city."'");
$worked = $result->fetch();
$checkMail = DB::run("SELECT * FROM `pms` WHERE `to`='$user_class->username' and `viewed`='1'");
$numMsgs = $checkMail->rowCount();
$checkEvents = DB::run("SELECT * FROM `events` WHERE `to`='$user_class->id' and `viewed` = '1'");
$numEvents = $checkEvents->rowCount();
?>
<tr>
<center><td class="contenthead"><center><?php echo $user_class->cityname; ?></center></td></center>
</tr>
<tr>
<td class="contentcontent"><font color="black"><center><?= $worked['description'] ?></center></font></td>
</tr>
<tr>
<td class="contenthead"><center><font color="white">Places To Go</font></center></td>
</tr>

<tr>
<td class="contentcontent">
	<table width='100%' border='2px' border-radius="3px">
		<tr>
		<th width='33.3%'><u><center><font color="white">Shops</font></center></u></th>
		<th width='33.3%'><u><center><font color="white">Town Hall</font></center></u></th>
		<th width='33.3%'><u><center><font color="white">Casino</font></center></u></th>
		</tr>
		<tr>
			<td width='33.3%' align=center>
				<br><a href="astore.php">Armor Emporium</a>

				<br><a href="store.php">Weapon Sales</a>

				<br><a href="itemmarket.php">Item Market</a>

				<br><a href="pointmarket.php">Points Market</a>

				<br><a href="spendpoints.php">Point Shop</a>

				<br><a href="pharmacy.php">Pharmacy</a>

				<br><a href='carlot.php'>Big Bobs Used Car Lot</a>
               
			</td>
			<td width='33.3%' align=center>
				<a href="halloffame.php">Hall Of Fame</a>

				<a href='worldstats.php'>World Stats</a>

				<a href="viewstaff.php">Town Hall</a>

				<a href='search.php'>Mobster Search</a>

				<a href="citizens.php">Mobsters List</a>

				<a href="online.php">Mobsters Online</a>

			</td>
			<td width='33.3%' align=center>
				<a href="lottery.php">Lottery</a>

				<a href="slots.php">Slot Machine</a>

				<a href='5050game.php'>50/50 Game</a>

			</td>
		</tr>
		<tr>
			<th width='33.3%'><u>Your Home</u></th>
			<th width='33.3%'><u>Travel</u></th>
			<th width='33.3%'><u>DownTown</u></th>
		</tr>
		<tr>
			<td width='33.3%' align=center>
				<a href="pms.php">Mailbox</a>

				<a href="events.php">Events</a>

				<a href="spylog.php">Spy Log</a>

				<a href="inventory.php">Inventory</a>

				<a href="refer.php">Referrals</a>

				<a href="house.php">Move House</a>

				<a href="fields.php">Manage Land</a>
			</td>
			<td width='33.3%' align=center>
				<a href='bus.php'>Bus Station</a>

				<a href='drive.php'>Drive</a>

			</td>
			<td width='33.3%' align=center>
				<a href="buydrugs.php">Shady-Looking Stranger</a>

				<a href="downtown.php">Search Downtown</a>

				<a href="jobs.php">Job Center</a>

				<a href = "gang_list.php">Gang List</a>

				<a href="gang.php">Your Gang</a>

				<a href="bank.php">Bank</a>

				<a href="realestate.php">Real Estate Agency</a>
			</td>
		</tr>
		<tr>
			<th colspan=3><u>Mafia Streets</u></th>
		</tr>
		<tr>
			<td colspan=3 align=center>
				<a href='viewstocks.php'>View Stock Market</a>

				<a href='brokerage.php'>Brokerage Firm</a>

				<a href='portfolio.php'>View Portfolio</a>
			</td>
		</tr>
		<tr>
			<td colspan='3'>
</td>
		</tr>
	</table>
</td>
</tr> 
<?php include (dirname(__file__) .'/footer.php'); ?>