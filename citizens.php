<?php
include 'header.php';
echo '<tr><td class="contenthead">Total Users</td></tr>';
echo '<tr><td class="contentcontent">'; 
$result = DB::run("SELECT * FROM `grpgusers` ORDER BY `id` ASC");

	while($line = $result->fetch(PDO::FETCH_ASSOC)) {
    $data = $result->fetch(); echo Get_Userbar($data['honorbar'], $data['username']);
		$secondsago = time()-$line['lastactive'];
			$user_online = new User($line['id']);
          echo "<div> </div>";
}
      echo "</td></tr>";
include 'footer.php'
?>