<?php
include 'dbcon.php';

$result = DB::run("SELECT * FROM `stocks`");
while($line = $result->fetch(PDO::FETCH_ASSOC)) {
	$amount = rand (strlen($line['cost']) * -1, strlen($line['cost']));
	$newamount = $line['cost'] + $amount;
	if ($newamount < 1){
		$newamount = 1;
	}
	$result2 = DB::run("UPDATE `stocks` SET `cost`='".$newamount."' WHERE `id`='".$line['id']."'");
}

?>