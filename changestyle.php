<?php
include 'header.php';
if ($_GET['change'] == "yes"){
	echo Message("Your color scheme has been changed.");
}
if (isset($_GET['style'])) {
    $result= DB::run("UPDATE `grpgusers` SET `style`='".$_GET['style']."' WHERE `id`='".$user_class->id."'");
	echo Message("Please wait while your changes are being made...");
    mrefresh("changestyle.php?change=yes", 0);
}
?>
<tr><td class="contenthead">
Change Color Scheme
</td></tr>
<tr><td class="contentcontent">
Current Scheme: <?= $user_class->style; ?>
<?php
$cresult = DB::run("SELECT DISTINCT `style` FROM `styles`");
while($line = $cresult->fetch(PDO::FETCH_ASSOC)) {
	echo "<div><a href='changestyle.php?style=".$line['style']."'>Switch to theme #".$line['style']."</a></div>";
		// get style info
		$result = DB::run("SELECT * FROM `styles` WHERE `style`='".$line['style']."'");
		$i = 0;
		echo "<table><tr>";
		while($line2 = $result->fetch(PDO::FETCH_ASSOC)) {
			$color[$i] = $line2['value'];
			echo '<td style="background-color:'.$color[$i].'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
			$i++;
		}
		echo "</tr></table>";
		//get style info
}
?>

</td></tr>
<?php
include 'footer.php';
?>