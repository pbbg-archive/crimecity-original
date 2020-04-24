<?php
include 'header.php';

echo '<tr><td class="contenthead">Users Online In The Last 5 Minutes</td></tr>';
$result = DB::run("SELECT * FROM `grpgusers` ORDER BY `lastactive` DESC");
echo '<tr><td class="contentcontent">';

while ($line = $result->fetch(PDO::FETCH_LAZY))

{
    $secondsago = time()-$line['lastactive'];
    if ($secondsago<=300) {
        $user_online = new User($line['id']);
        echo "<div>".$user_online->formattedname . " ". howlongago($user_online->lastactive)."</div>";
    }
}
echo '</td></tr>';

include 'footer.php'
?>