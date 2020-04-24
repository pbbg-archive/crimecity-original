<?php

include 'header.php';



if ($user_class->gang != 0) {

    $gang_class = New Gang($user_class->gang);



    if($_POST['deposit'] != ""){

        $amount = $_POST['damount'];

        if ($amount > $user_class->money) {

            echo Message("You do not have that much money.");

        }

        if ($amount < 1){

            echo Message("Please enter a valid amount.");

        }

        if ($amount <= $user_class->money && $amount > 0) {

            echo Message("Money deposited.");

            $newvault = $amount + $gang_class->vault;

            $newmoney = $user_class->money - $amount;

            $result = DB::run("UPDATE `grpgusers` SET `money` = '".$newmoney."' WHERE `id`='".$_SESSION['id']."'");

            $result = DB::run("UPDATE `gangs` SET `vault` = '".$newvault."' WHERE `id`='".$gang_class->id."'");

            $user_class = new User($_SESSION['id']);

            $gang_class = New Gang($user_class->gang);

        }

    }



    if($_POST['withdraw'] != "" && $gang_class->leader == $user_class->username){

        $amount = $_POST['wamount'];

        if ($amount > $gang_class->vault) {

            echo Message("You do not have that much money in the bank.");

        }

        if ($amount < 1){

            echo Message("Please enter a valid amount.");

        }

        if ($amount <= $gang_class->vault && $amount > 0) {

            echo Message("Money withdrawn.");

            $newvault = $gang_class->vault - $amount;

            $newmoney = $user_class->money + $amount;

            $result = DB::run("UPDATE `grpgusers` SET `money` = '".$newmoney."' WHERE `id`='".$_SESSION['id']."'");

            $result = DB::run("UPDATE `gangs` SET `vault` = '".$newvault."' WHERE `id`='".$gang_class->id."'");

            $user_class = new User($_SESSION['
			']);

            $gang_class = New Gang($user_class->gang);

        }

    }



    echo "<tr><td class='contenthead'>[".$gang_class->tag."]".$gang_class->name." Vault</td></tr><tr><td class='contentcontent'>";

    ?>

    Welcome to the gang vault. There is currently  $<?php echo $gang_class->vault ?> in the gang vault.<br><br>

    <?php

    if ($gang_class->leader == $user_class->username){

        ?>

        <form method='post'><input type='text' name='wamount' value='<?php echo $gang_class->vault ?>' size='10' maxlength='20'> &nbsp;

            <input type='submit' name='withdraw' value='Withdraw'></form><br><br>

        <?php

    }

    ?>

    <form method='post'><input type='text' name='damount' value='<?php echo $user_class->money ?>' size='10' maxlength='20'> &nbsp;

        <input type='submit' name='deposit' value='Deposit'></form>

    </td></tr>

    <?php

    echo "<td><tr>";

} else {


    echo Message("You aren't in a gang.");

}

include 'footer.php';

?>