<?php
include 'header.php';


if ($_POST['buypoints']){

    $worked = DB::run("SELECT * FROM `pointsmarket` WHERE `id`='".$_POST['points_id']."'")->fetch();

    $price = $worked['price'];
    $amount = $worked['amount'];
    $totalcost = $price * $_POST['amount'];
    $newpointsinmarket = $amount - $_POST['amount'];
    $user_points = new User($worked['owner']);

    if ($worked['owner'] == $user_class->id) {
        echo Message("You have taken ".$_POST['amount']." points off the market.");
        $newpoints = $user_class->points + $_POST['amount'];;
        $result = DB::run("UPDATE `grpgusers` SET `points` = '".$newpoints."' WHERE `id`='".$user_class->id."'");
        $user_class = new User($_SESSION['id']);
        if ($newpointsinmarket == 0){
            $result = DB::run("DELETE FROM `pointsmarket` WHERE `id`='".$worked['id']."'");
        } else {
            $result = DB::run("UPDATE `pointsmarket` SET `amount` = '".$newpointsinmarket."' WHERE `id`='".$worked['id']."'");
        }
        include 'footer.php';
        die();
    }
    if($_POST['amount'] > $amount){
        echo Message("They are not selling that many points.");
    }
    if($_POST['amount'] < 1){
        echo Message("Please enter a valid amount of points to buy.");
    }
    if ($totalcost > $user_class->money){
        echo Message("You don't have enough money.");
    }
    if($_POST['amount'] >= 1 && $_POST['amount'] <= $amount && $totalcost <= $user_class->money){
        echo Message("You have bought ".$_POST['amount']." points for $".$totalcost);
        $newpoints = $user_class->points + $_POST['amount'];
        $newmoney = $user_class->money - $totalcost;
        $result = DB::run(("UPDATE `grpgusers` SET `money` = '".$newmoney."', `points` = '".$newpoints."' WHERE `id`='".$user_class->id."'"));
        $newmoney = $user_points->money + $totalcost;
        $result = DB::run(("UPDATE `grpgusers` SET `money` = '".$newmoney."' WHERE `id`='".$user_points->id."'"));
        $user_class = new User($_SESSION['id']);
        if ($newpointsinmarket == 0){
            $result = DB::run("DELETE FROM `pointsmarket` WHERE `id`='".$worked['id']."'");
        } else {
            $result = DB::run("UPDATE `pointsmarket` SET `amount` = '".$newpointsinmarket."' WHERE `id`='".$worked['id']."'");
        }
    }
}

if ($_POST['addpoints']){
    if($_POST['amount'] > $user_class->points){
        echo Message("You don't have that many points.");
    }
    if($_POST['amount'] < 1){
        echo Message("Please enter a valid amount of points.");
    }
    if($_POST['price'] < 1){
        echo Message("Please enter a valid amount of money.");
    }
    if($_POST['amount'] >= 1 && $_POST['amount'] <= $user_class->points && $_POST['price'] >= 1){
        echo Message("You have added ".$_POST['amount']." points to the market a price of $".$_POST['price']." per point.");
        $result= DB::run("INSERT INTO `pointsmarket` (owner, amount, price)"."VALUES ('$user_class->id', '$_POST[amount]', '$_POST[price]')");
        $newpoints = $user_class->points - $_POST['amount'];
        $result = DB::run("UPDATE `grpgusers` SET `points` = '".$newpoints."' WHERE `id`='".$user_class->id."'");
        $user_class = new User($_SESSION['id']);
    }
}

?>
    <tr><td class="contenthead">Point Market</td></tr>
    <tr><td class="contentcontent">
            Use this form to add points to the points market.<br><br>
            <form method='post' class="pointmarket-form">
                <table align="center">
                    <tr>
                        <td>Amount of points</td><td>&nbsp;&nbsp;<input type='text' name='amount' size='10' maxlength='20' value='<?php echo $user_class->points; ?>'></td>
                    </tr>
                    <tr>
                        <td>Price per point</td><td>$<input type='text' name='price' size='10' maxlength='20'></td>
                    <tr><td align="center" colspan="2"><input type='submit' name='addpoints' value='Add Points'></form></td>
    </tr></table>
    </td></tr>
    <tr><td class="contentcontent">
            <?php
            $result = DB::run("SELECT * FROM `pointsmarket` ORDER BY `price` DESC");
            while ($line = $result->fetch(PDO::FETCH_LAZY))

            {
                $user_points = new User($line['owner']);
                if ($user_points->id == $user_class->id){
                    $submittext = "Remove Points";
                } else {
                    $submittext = "Buy";
                }
                echo "<form method='post'>";
                echo $user_points->formattedname." - ".$line['amount']." points for $".$line['price']." per point <input type='text' name='amount' size='3' maxlength='20' value='".$line['amount']."'><input type='hidden' name='points_id' value='".$line['id']."'><input type='submit' name='buypoints' value='".$submittext."'></form><br>";
            }
            ?>
        </td></tr>
<?php
include 'footer.php';
?>