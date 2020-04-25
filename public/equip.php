<?php
include 'header.php';

if (isset($_GET['unequip']) && $_GET['unequip'] == "weapon" && $user_class->eqweapon != 0) {
	Give_Item($user_class->eqweapon, $user_class->id);
	$result = DB::run("UPDATE `grpgusers` SET `eqweapon` = '0' WHERE `id`='".$_SESSION['id']."'");
	echo Message("You have unequipped your weapon.");
	mrefresh("inventory.php");
	include 'footer.php';
	die();
}

if (isset($_GET['unequip']) && $_GET['unequip'] == "armor" && $user_class->eqarmor != 0) {
	Give_Item($user_class->eqarmor, $user_class->id);
	$result = DB::run("UPDATE `grpgusers` SET `eqarmor` = '0' WHERE `id`='".$_SESSION['id']."'");
	echo Message("You have unequipped your armor.");
	mrefresh("inventory.php");
	include 'footer.php';
	die();
}	

if (isset($_GET['id']) && $_GET['id'] == "") {
	echo Message("No item picked.");
	include 'footer.php';
	die();
}

//check how many they have
$howmany = Check_Item($_GET['id'], $user_class->id);

$result2 = DB::run("SELECT * FROM `items` WHERE `id`= ?", [$_GET['id']]);
$worked = $result2->fetch();

$error = ($howmany == 0) ? "You don't have any of those." : null;
$error = ($worked['level'] > $user_class->level) ? "You aren't high enough level to use this." : $error;
	
	
if (isset($error)) {
    echo Message($error);
    include 'footer.php';
    die();
}
	
Take_Item($_GET['id'], $user_class->id);

if (isset($_GET['eq']) && $_GET['eq'] == "weapon") {
	if($user_class->eqweapon != 0) {
		Give_Item($user_class->eqweapon, $user_class->id);
	}
	$result = DB::run("UPDATE `grpgusers` SET `eqweapon` = ? WHERE `id` = ?", [$_GET['id'], $_SESSION['id']]);
	echo Message("You have succesfully equipped a weapon.");
	mrefresh("inventory.php");
}
if (isset($_GET['eq']) && $_GET['eq'] == "armor") {
	if($user_class->eqarmor != 0) {
		Give_Item($user_class->eqarmor, $user_class->id);
	}
	$result = DB::run("UPDATE `grpgusers` SET `eqarmor` = ? WHERE `id` = ?", [$_GET['id'], $_SESSION['id']]);
	echo Message("You have succesfully equipped armor.");
	mrefresh("inventory.php");
}

include 'footer.php';
?>