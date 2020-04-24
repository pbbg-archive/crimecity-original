<?php
include 'header.php';
?>
<tr><td class="contenthead">Hall Of Fame [<a href="http://bourbanlegends.com/forum/viewtopic.php?pid=1240">?</a>]</td></tr>
<tr><td class="contentcontent"><center><a href="halloffame.php?view=exp">Level</a> | <a href="halloffame.php?view=strength">Strength</a> | <a href="halloffame.php?view=defense">Defense</a> | <a href="halloffame.php?view=speed">Speed</a> | <a href="halloffame.php?view=money">Money</a> | <a href="halloffame.php?view=points">Points</a></center></td></tr>
<tr><td class="contentcontent">
<table width='100%'>
<tr>
	<td>Rank</td>
	<td>Mobster</td>
	<td>Level</td>
	<td>Money</td>
	<td>Gang</td>

	<td align='center'>Online</td>
</tr>
<?php
$view = ($_GET['view'] != "") ? $_GET['view'] : 'exp';


$result = DB::run("SELECT * FROM `grpgusers` ORDER BY `".$view."` DESC LIMIT 50");
$rank = 0;
while($line = $result->fetch(PDO::FETCH_ASSOC)) {
	$rank++;
	$user_hall = new User($line['id']);
	?>
	<tr>
			<td><?= $rank ?></td>
			<td><?= ($user_class->rmdays >0) ? ' <a href="profiles.php?id='.$user_hall->id.'"><img src="images/username/'.$user_hall->id.'.png" style="height:15px" style="width:15px"></a>' : '<a href="profiles.php?id="'. $_SESSION['id'] ."'>". $user_hall->formattedname ."</a><br/>" ?></td>
			<td><?= $user_hall->level ?></td>
			<td>$<?= $user_hall->money ?></td>
			<td><?= $user_hall->formattedgang ?></td>
			<td><?= $user_hall->formattedonline ?></td>
	</tr>
	<?php
}
?>

<!--</td></tr>-->
</table>
<?php
include 'footer.php';
?>