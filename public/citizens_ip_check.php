<?php
include 'header.php';
echo '<tr><td class="contenthead">Total Users</td></tr>';
echo '<tr><td class="contentcontent">';
$result = DB::run("SELECT * FROM `grpgusers` ORDER BY `ip` ASC");

	while($line = $result->fetch(PDO::FETCH_ASSOC)) {
		$result1 = DB::run("SELECT * FROM `grpgusers` WHERE `ip`='".$line['ip']."'");
			if ($result1->rowCount() > 1){
				$user_online = new User($line['id']);
				echo "<div>".$user_online->ip.".)".$user_online->formattedname."</div>";
			}
	}
echo "</td></tr>";
include 'footer.php'
?>