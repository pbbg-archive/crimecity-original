<?php

include 'header.php';

if (!isset($_GET['id']) || isset($_GET['id']) && $_GET['id'] == "") {
    echo Message("No item picked.");
    include 'footer.php';
    die();
}
// check how many they have
$howmany = Check_Item($_GET['id'], $user_class->id);
$worked = DB::run("SELECT * FROM `items` WHERE `id` = ?", [$_GET['id']])->fetch();

// if they are trying to put something up
if (isset($_POST['price'])) {
    $error = ($_POST['price'] < 1) ? "Please enter a valid amount of money." : null;
    $error = ($howmany == 0) ? "You don't have any of those." : $error;

    if (isset($error)) {
        echo Message($error);
        include 'footer.php';
        die();
    }

    echo Message("You have added a ".$worked['itemname']." to the market at a price of $".$_POST['price'].".");
    $result= DB::run("INSERT INTO `itemmarket` (itemid, userid, cost)"."VALUES (?, ?, ?)", [$_GET['id'], $user_class->id, $_POST['price']]);
    //take away item
    Take_Item($_GET['id'], $user_class->id);
    die();
}
?>
    <tr><td class="contenthead">Put An Item On The Market</td></tr>
    <tr><td class="contentcontent" align="center">
    You are selling <?= $worked['itemname'] ?><br><br>
    <form method='post' action='putonmarket.php?id=<?= $_GET['id']?>'>
        Cost $<input type='text' name='price' size='10' maxlength='10'><br>
        <input type='submit' name='market' value='Add'>
    </form>
    <br><br>
<a href="../inventory.php">Back</a>
<br>
</td></tr>
<?php
include 'footer.php';
?>