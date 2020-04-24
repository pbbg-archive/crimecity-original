<?php
function Get_ID($username)
{
    $worked = DB::run("SELECT * FROM `grpgusers` WHERE `username` =?", [$username])->fetch();
    return $worked['id'];
}
function Get_Userbar($honorbar, $username)
{
    if (trim($honorbar) != '' ) {
        return '<div class="honorbar"><img src="'.$honorbar.'" style="height:10px" style="width:10px"><span>'.$username.'</span></div>';
    }

    //Or implement a backup userbar.
    return '<span>No userbar for this user</span>';
}

function mrefresh($url, $time = '1')
{
    echo '<meta http-equiv="refresh" content="'.$time.';url='.$url.'">';
}

function car_popup($text, $id)
{
    return "<a href='#' onclick=\"javascript:window.open( 'cardesc.php?id=".$id."', '60', 'left = 20, top = 20, width = 400, height = 400, toolbar = 0, resizable = 0, scrollbars=1' );\">".$text."</a>";
}

function item_popup($text, $id)
{
    return "<a href='#' onclick=\"javascript:window.open( 'description.php?id=".$id."', '60', 'left = 20, top = 20, width = 400, height = 400, toolbar = 0, resizable = 0, scrollbars=1' );\">".$text."</a>";
}

function prettynum($num,$dollar = "0")
{
// Basic send a number or string to this and it will add commas. If you want a dollar sign added to the
// front and it is a number add a 1 for the 2nd variable.
// Example prettynum(123452838,1)  will return $123,452,838 take out the ,1 and it looses the dollar sign.
    $out=strrev( (string)preg_replace( '/(\d{3})(?=\d)(?!\d*\.)/', '$1,' , strrev( $num ) ) );
    if ($dollar && is_numeric($num)) {
        $out= "$".$out;
    }
    return $out;
}

function Check_Item($itemid, $userid)
{
    $result = DB::run("SELECT * FROM `inventory` WHERE `userid`='$userid' AND `itemid`='$itemid'");
    $worked = $result->fetch(PDO::FETCH_ASSOC);
    return ($worked['quantity'] > 0) ? $worked['quantity'] : 0;
}

function Check_Land($city, $userid)
{
    $result = DB::run("SELECT * FROM `land` WHERE `userid`='".$userid."' AND `city`='".$city."'");
    $worked = $result->fetch(PDO::FETCH_ASSOC);
    return ($worked['quantity'] > 0) ? $worked['quantity'] : 0;
}

//userid	companyid	howmany
function Give_Share($stock, $userid, $quantity = "1")
{
    $result = DB::run("SELECT * FROM `shares` WHERE `userid`='".$userid."' AND `companyid`='".$stock."'");
    $worked = $result->fetch(PDO::FETCH_ASSOC);
    $itemexist = $result->rowCount();

    if ($itemexist == 0) {
        $result= DB::run("INSERT INTO `shares` (`companyid`, `userid`, `amount`) VALUES ('$stock', '$userid', '$quantity')");
    } else {
        $quantity = $quantity + $worked['amount'];
        $result = DB::run("UPDATE `shares` SET `amount` = '".$quantity."' WHERE `userid`='$userid' AND `companyid`='$stock'");
    }
}

function Take_Share($stock, $userid, $quantity = "1")
{
    $result = DB::run("SELECT * FROM `shares` WHERE `userid`='".$userid."' AND `companyid`='".$stock."'");
    $worked = $result->fetch(PDO::FETCH_ASSOC);
    $itemexist = $result->rowCount();

    if ($itemexist != 0) {
        $quantity = $worked['amount'] - $quantity;
        if ($quantity > 0) {
            $result = DB::run("UPDATE `shares` SET `amount` = '".$quantity."' WHERE `userid`='$userid' AND `companyid`='$stock'");
        } else {
            $result = DB::run("DELETE FROM `shares` WHERE `userid`='$userid' AND `companyid`='$stock'");
        }
    }
}

function Check_Share($stock, $userid)
{
    $result = DB::run("SELECT * FROM `shares` WHERE `userid`='".$userid."' AND `companyid`='".$stock."'");
    $worked = $result->fetch(PDO::FETCH_ASSOC);

    return ($worked['amount'] > 0) ? $worked['amount'] : 0;
}

function Give_Land($city, $userid, $quantity = "1")
{
    $result = DB::run("SELECT * FROM `land` WHERE `userid`='".$userid."' AND `city`='".$city."'");
    $worked = $result->fetch(PDO::FETCH_ASSOC);
    $itemexist = $result->rowCount();

    if ($itemexist == 0) {
        $result= DB::run("INSERT INTO `land` (`city`, `userid`, `amount`)"."VALUES ('$city', '$userid', '$quantity')");
    } else {
        $quantity = $quantity + $worked['amount'];
        $result = DB::run("UPDATE `land` SET `amount` = '".$quantity."' WHERE `userid`='$userid' AND `city`='$city'");
    }
}

function Take_Land($city, $userid, $quantity = "1")
{
    $result = DB::run("SELECT * FROM `land` WHERE `userid`='".$userid."' AND `city`='".$city."'");
    $worked = $result->fetch(PDO::FETCH_ASSOC);
    $itemexist = $result->rowCount();

    if ($itemexist != 0) {
        $quantity = $worked['amount'] - $quantity;
        if ($quantity > 0) {
            $result = DB::run("UPDATE `land` SET `amount` = '".$quantity."' WHERE `userid`='$userid' AND `city`='$city'");
        } else {
            $result = DB::run("DELETE FROM `land` WHERE `userid`='$userid' AND `city`='$city'");
        }
    }
}

function Give_Item($itemid, $userid, $quantity = "1")
{
    $result = DB::run("SELECT * FROM `inventory` WHERE `userid`='$userid' AND `itemid`='$itemid'");
    $worked = $result->fetch();
    $itemexist = $result->rowCount();

    if ($itemexist == 0) {
        $result= DB::run("INSERT INTO `inventory` (`itemid`, `userid`, `quantity`)"."VALUES ('$itemid', '$userid', '$quantity')");
    } else {
        $quantity = $quantity + $worked['quantity'];
        $result = DB::run("UPDATE `inventory` SET `quantity` = '".$quantity."' WHERE `userid`='$userid' AND `itemid`='$itemid'");
    }
}

function Take_Item($itemid, $userid, $quantity = "1")
{
    $result = DB::run("SELECT * FROM `inventory` WHERE `userid`='$userid' AND `itemid`='$itemid'");
    $worked = $result->fetch();
    $itemexist = $result->rowCount();

    if ($itemexist != 0) {
        $quantity = $worked['quantity'] - $quantity;
        if ($quantity > 0) {
            $result = DB::run("UPDATE `inventory` SET `quantity` = '".$quantity."' WHERE `userid`='$userid' AND `itemid`='$itemid'");
        } else {
            $result = DB::run("DELETE FROM `inventory` WHERE `userid`='$userid' AND `itemid`='$itemid'");
        }
    }
}

function Message($text)
{
    return '<tr><td class="contenthead">.: Important Message</td></tr><tr><td class="contentcontent">'.$text.'</td></tr>';
}

function Send_Event ($id, $text)
{
    $timesent = time();
    $result= DB::run("INSERT INTO `events` (`to`, `timesent`, `text`) VALUES ('$id', '$timesent', '$text')");
}

function Is_User_Banned($id)
{
    $result = DB::run("SELECT * FROM `bans` WHERE `id`='$id'");
    return $result->rowCount();
}

function Why_Is_User_Banned($id)
{
    $result = DB::run("SELECT * FROM `bans` WHERE `id`='$id'");
    $worked = $result->fetch();
    return $worked['reason'];
}

function Radio_Status()
{
    $result = DB::run("SELECT * FROM `serverconfig`");
    $worked = $result->fetch();
    return $worked['radio'];
}

function howlongago($ts)
{
    $ts = time() - $ts;
    if ($ts < 1)
        return " NOW";
	elseif ($ts == 1)
        return $ts." second";
	elseif ($ts < 60)
        return $ts." seconds";
	elseif ($ts < 120)
        return "1 minute";
	elseif ($ts < 60 * 60)
        return floor($ts / 60)." minutes";
	elseif ($ts < 60 * 60 * 2)
        return "1 hour";
	elseif ($ts < 60 * 60 * 24)
        return floor($ts / (60 * 60))." hours";
	elseif ($ts < 60 * 60 * 24 * 2)
        return "1 day";
	elseif ($ts < (60 * 60 * 24 * 7))
        return floor($ts / (60 * 60 * 24))." days";
	elseif ($ts < 60 * 60 * 24 * 30.5)
        return floor($ts / (60 * 60 * 24 * 7))." weeks";
	elseif ($ts < 60 * 60 * 24 * 365)
        return floor($ts / (60 * 60 * 24 * 30.5))." months";
    else
        return floor($ts / (60 * 60 * 24 * 365))." years";
};

function howlongtil($ts) {
    $ts = $ts - time();
    if ($ts < 1)
        return " NOW";
    elseif ($ts == 1)
        return $ts." second";
    elseif ($ts < 60)
        return $ts." seconds";
    elseif ($ts < 120)
        return "1 minute";
    elseif ($ts < 60 * 60)
        return floor($ts / 60)." minutes";
    elseif ($ts < 60 * 60 * 2)
        return "1 hour";
    elseif ($ts < 60 * 60 * 24)
        return floor($ts / (60 * 60))." hours";
    elseif ($ts < 60 * 60 * 24 * 2)
        return "1 day";
    elseif ($ts < (60 * 60 * 24 * 7))
        return floor($ts / (60 * 60 * 24))." days";
    elseif ($ts < 60 * 60 * 24 * 30.5)
        return floor($ts / (60 * 60 * 24 * 7))." weeks";
    elseif ($ts < 60 * 60 * 24 * 365)
        return floor($ts / (60 * 60 * 24 * 30.5))." months";
    else
        return floor($ts / (60 * 60 * 24 * 365))." years";
};

function experience($L)
{
    $a = 0;
    $end = 0;

    for($x = 1; $x < $L; $x++) {
        $a += floor($x + 1500 * pow(4, ($x / 7)));
    }

    return floor($a/4);
}

function Get_The_Level($exp)
{
    $a = 0;
    $end = 0;

    for($x = 1; $x < 100; $x++) {
        $a += floor($x + 1500 * pow(4, ($x / 7)));
        if ($exp >= floor($a / 4)) {

        } else {
            return $x;
        }
    }
}
