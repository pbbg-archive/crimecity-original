<?php
include 'header.php';
if ($_GET['spend'] == "energy"){
	if($user_class->credits > 9) {
	 $newpoints = $user_class->credits - 10;
	  $result = DB::run("UPDATE `grpgusers` SET `energy` = '".$user_class->maxenergy."', `credits`='".$newpoints."' WHERE `id`='".$_SESSION['id']."'");
	  echo Message("You spent 10 credits and refilled your energy.");
	} else {
		echo Message("You don't have enough points, silly buns.");
	}
}
if ($_GET['spend'] == "nerve"){
	if($user_class->credits > 9) {
	 $newpoints = $user_class->credits - 10;
	  $result = DB::run("UPDATE `grpgusers` SET `nerve` = '".$user_class->maxnerve."', `credits`='".$newpoints."' WHERE `id`='".$_SESSION['id']."'");
	  echo Message("You spent 10 credits and refilled your nerve.");
	} else {
		echo Message("You don't have enough points, silly buns.");
	}
}
?>
<tr><td class="contenthead">Credit Shop</td></tr>
<tr><td class="contentcontent">
Welcome to the Credit Shop, here you can spend your credits on various things.</td></tr>
<tr><td class="contentcontent">
<table>
		<tr>
			<td><a href='spendcredits.php?spend=energy'>Refill Energy</a></td>
			<td> - 10 Credits</td>

		</tr>
		<tr>
			<td><a href='spendcredits.php?spend=nerve'>Refill Nerve</a></td>
			<td> - 10 Credits</td>
		</tr>
</table>
</td></tr>
<?php
include 'footer.php';
?>