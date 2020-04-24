<?php
include 'header.php';

if ($_GET['go'] != "") {
    $error = ($user_class->jail > 0) ? "You can't get on a bus if you are in jail." : $error;
    $error = ($user_class->hospital > 0) ? "You can't get on a bus if you are in the hospital." : $error;
    $error = ($_GET['go'] == $user_class->city) ? "You are already there." : $error;

    $result = DB::run("SELECT * FROM `cities` WHERE `id`='".$_GET['go']."'");
    $worked = $result->fetch();

    $error = ($worked['name'] == "") ? "That city doesn't exist." : $error;
    $error = ($user_class->level < $worked['levelreq']) ? "You are not a high enough level to go there." : $error;
    $error = ($user_class->money < 500) ? "You can't afford a bus ticket." : $error;

    if (!isset($error)){
        $newmoney = $user_class->money - 500;
        $result = DB::run("UPDATE `grpgusers` SET `city` = '".$_GET['go']."', `money` = '".$newmoney."' WHERE `id` = '".$user_class->id."'");
        $user_class = new User($_SESSION['
		']);
        echo Message("You successfully paid $500 and arrived at your destination.");
    } else {
        echo Message($error);
    }

}
?>
    <tr><td class="contenthead">Bus Station</td></tr>
    <tr><td class="contentcontent">Tired of <?= $user_class->cityname ?>? For $500 bucks you can get a bus ticket to anywhere you want to go.

        </td></tr>
<?php
$result = DB::run("SELECT * FROM `cities` ORDER BY `levelreq` ASC");
echo '<tr><td class="contentcontent">';


while ($line = $result->fetch(PDO::FETCH_LAZY))

{
    echo "<div class='bus-section'>".$line['name'] . " Lvl Req:".$line['levelreq']." <a href='bus.php?go=".$line['id']."'>Buy Ticket</a></div>";
}
echo '</td></tr>';

include 'footer.php';
?>