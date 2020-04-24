<?php

include 'header.php';



if ($_GET['delete'] != ""){

  $deletemsg = $_GET['delete'];

  $result = DB::run("DELETE FROM `pms` WHERE `id`='".$deletemsg."'");

  echo Message("Message Deleted!");

}



if ($_GET['deleteall'] == "true"){

  $result = DB::run("DELETE FROM `pms` WHERE `to`='".$user_class->username."'");

  echo Message("Message Deleted!");

}





if ($_POST['newmessage'] != ""){

  $to = $_POST['to'];

  $from = $user_class->id;

  $timesent = time();

  $subject = strip_tags($_POST['subject']);

  $msgtext = strip_tags($_POST['msgtext']);



  $checkuser = DB::run("SELECT `username` FROM `grpgusers` WHERE `username`='".$to."'");

  $username_exist = $checkuser->rowCount();

    if($username_exist > 0){

      $result= DB::run("INSERT INTO `pms` (`to`, `from`, `timesent`, `subject`, `msgtext`)".

      "VALUES ('$to', '$from', '$timesent', '$subject', '$msgtext')");

      echo Message("Message successfully sent to $to");

    } else {

      echo Message('I am sorry but the Username you specified does not exist...');

    }



}

?>

<tr><td class="contenthead">Mailbox</td></tr>
<tr><td class="contentcontent">

<table width='100%'>

						<tr>

							<td colspan='25%'>Time Recieved</td>

							<td width='25%'>Subject</td>

							<td width='25%'>From</td>
							
							<td width='25%'>Viewed</td>

							<td>Delete</td>

						</tr>

<?php

$result = DB::run("SELECT * from `pms` ORDER BY `timesent` DESC");

while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

    if (strtoupper($row['to']) == strtoupper($user_class->username)) {

     $from_user_class = new User($row['from']);

	 $subject = ($row['subject'] == "") ? "No Subject" : $row['subject'];
	 
	 if ($row['viewed']=="1"){
		 $viewed="No";
	 }else{
		 $viewed="Yes";
	 }

    echo "

						<tr>

							<td colspan='25%'>".date(F." ".d.", ".Y." ".g.":".i.":".sa,$row['timesent'])."</td>

							<td width='25%'><a href='viewpm.php?id=".$row['id']."'>".$subject."</a></td>

							<td width='25%'>".$from_user_class->formattedname."</td>
							
							<td width='25%'>".$viewed."</td>

							<td><a href='pms.php?delete=".$row['id']."'>Delete</a></td>
						</tr>
                        
	

";
}

}

if ($_GET['reply'] != ""){

	$result2 = DB::run("SELECT * from `pms` WHERE `id`='".$_GET['reply']."'");

	$worked2 = $result20->fetch();

	$from_user_class = new User($worked2['from']);

}

?>

<br /><center><a href='pms.php?deleteall=true'>Delete All PMs In Your Inbox</a></center>

</table>

</td></tr>

<tr><td class="contenthead">New Message</td></tr>

<tr><td class="contentcontent">

			<table width='100%' class="pms-table">

				<form method='post'>

				<tr>



					<td width='15%'>Send To:</td>

					<td width='85%'><input type='text' name='to' value='<?php echo $_GET['to'] . $from_user_class->username; ?>' size='10' maxlength='75'> [username]

				</tr>

				<tr>



					<td width='15%'>Subject:</td>

					<td width='85%'><input type='text' name='subject' size='70' maxlength='75' value='<?php echo ($_GET['reply'] != "") ? "Re: ".$worked2['subject'] : "";  ?>'></td>

				</tr>

				<tr>

					<td width='15%'>Message:</td>

					<td width='85%' colspan='3'><textarea name='msgtext' cols='53' rows='7'><?php echo ($_GET['reply'] != "") ? " \n -------- \n ".$worked2['msgtext'] : "";  ?></textarea></td>

				</tr>



				<tr>

					<td width='100%' colspan='4' align='center'><input type='submit' name='newmessage' value='Send'></td>

				</tr>

				</form>

			</table>
<div class="row" style="height:10px;"></div>
<table class="content">
</td></tr>

<?php



include 'footer.php';

?>