<?php
require_once '../vendor/autoload.php';

$result = DB::run("SELECT * FROM `inventory` ORDER BY `userid` DESC");
$howmanytotal = $result->rowCount();

while($line = $result->fetch(PDO::FETCH_ASSOC)) {

	$result2 = DB::run("SELECT * FROM `inventory` WHERE `userid` = '".$line['userid']."' AND `itemid` = '".$line['itemid']."'");
	$howmanyrows = $result2->rowCount();
	$worked2 = $result2->fetch(PDO::FETCH_ASSOC);
	if ($howmanyrows>0) {
		$result3= DB::run("INSERT INTO `newinventory` (userid, itemid, quantity)"."VALUES ('".$line['userid']."', '".$line['itemid']."', '".$howmanyrows."')");
		$result4 = DB::run("DELETE FROM `inventory` WHERE `userid` = '".$line['userid']."' AND `itemid` = '".$line['itemid']."'");
		
	}

}

?>