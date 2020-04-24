<?php

include 'header.php';



if ($_GET['id'] == ""){

	echo Message("No item picked.");

	include 'footer.php';

	die();

}	



$howmany = Check_Item($_GET['id'], $user_class->id);



$result3 = DB::run("SELECT * FROM `grpgusers` WHERE `id`='".$_POST['theirid']."'");

$userexist = $result3->rowCount();



$result2 = DB::run("SELECT * FROM `items` WHERE `id`='".$_GET['id']."'");

$worked = $result2->fetch();



if ($_POST['submit'] != ""){ //if they confirm they want to sell it

	$error = ($howmany == 0) ? "You don't have any of those." : $error;

	$error = ($userexist == 0) ? "That User ID is invalid." : $error;

	

	if (isset($error)){

		echo Message($error);

		include 'footer.php';

		die();

	}
	
	Give_Item($_GET['id'], $_POST['theirid']);
	Take_Item($_GET['id'], $user_class->id);

	echo Message("You have sent a ".$worked['itemname'].".");

	include 'footer.php';

	die();

}

?>

<tr><td class="contenthead">Send Item</td></tr>

<tr><td class="contentcontent">

<form method='post'>

  <table border='0' cellpadding='0' cellspacing='0'>

	<tr>

      <td colspan='2' height='27'>Send a <?= $worked['itemname']; ?></td>

    </tr>

	<tr>

      <td width='35%' height='27'>User ID</td>

      <td width='65%'>

        <input name='theirid' type='text' size='22' value='<?php echo $_GET['person'] ?>'>

    	</td>

    </tr>

    <tr>

      <td>&nbsp;</td>

      <td>

        <input type='submit' name='submit' value='Send Item'>

        </td>

    </tr>

  </table>

</form>

</td></tr>

<?php

include 'footer.php';

?>