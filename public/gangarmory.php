<?php
include 'header.php';

if ($user_class->gang != 0) {
    $gang_class = New Gang($user_class->gang);

    if ($_GET['buy']){
        $result = DB::run("SELECT * FROM `gangarmory` WHERE `id`='".$_GET['buy']."'");
        $worked = $result->fetch();

        $result2 = DB::run("SELECT * FROM `items` WHERE `id`='".$worked['itemid']."'");
        $worked2 = $result2->fetch();

        $user_item = new User($worked['userid']);

        if ($gang_class->leader != $user_class->username){
            echo Message("You are not the leader of this gang.");
        } else {
            echo Message("You have taken a ".$worked2['itemname'].".");
            $result = DB::run("DELETE FROM `gangarmory` WHERE `id`='".$_GET['buy']."' LIMIT 1");
            Give_Item($worked2['id'], $user_class->id);//give them the item out of the armory
        }
    }


    echo "<tr><td class='contenthead'>[".$gang_class->tag."]".$gang_class->name." Vault</td></tr><tr><td class='contentcontent'>Pleasenote that only the gang leader can take items out of the gang armory.</td></tr><tr><td class='contenthead'>Items In Vault</td></tr><tr><t class='contentcontent'>";

    $result = DB::run("SELECT * FROM `gangarmory` ORDER BY `id` ASC");

    while ($line = $result->fetch(PDO::FETCH_LAZY))
    {
        $user_item = new User($line['userid']);
        $result2 = DB::run("SELECT * FROM `items` WHERE `id`='".$line['itemid']."'");
        $worked =$result2->fetch();

        if ($gang_class->leader == $user_class->username){
            $submittext = "<a href='gangarmory.php?buy=".$line['id']."'>Take</a>";
        }
        echo $submittext." ".$worked['itemname']."<br>";
    }
    ?>
    </td></tr>
    <tr><td class='contenthead'>Add Items To Vault</td></tr>
    <tr><td class='contentcontent'>
            <?php
            $result = DB::run("SELECT * FROM `inventory` WHERE `userid` = '".$user_class->id."' ORDER BY `userid` DESC");

            while ($line = $result->fetch(PDO::FETCH_LAZY))
            {
                $result2 = DB::run("SELECT * FROM `items` WHERE `id`='".$line['itemid']."' ORDER BY `id` ASC");
                $worked2 =$result2->fetch();
                echo $worked2['itemname']." [".$line['quantity']."] <a href='addtoarmory.php?id=".$worked2['id']."'>[Add]</a><br>";
            }
            ?>
        </td></tr>
    <?php
    echo "<td><tr>";
} else {
    echo Message("You aren't in a gang.");
}
include 'footer.php';
?>