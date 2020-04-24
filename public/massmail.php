<?php
include 'header.php';
if($user_class->admin == 0){
    echo "You are not authorized to be here...";
    include 'footer.php';
    die();
}
$result = DB::run("SELECT * from `grpgusers` ORDER BY `id` DESC");

while ($row = $result->fetch(PDO::FETCH_LAZY)){
    if ($_POST['newmessage'] != ""){
        $to = $row['username'];
        $from = $user_class->id;
        $timesent = time();
        $subject = strip_tags($_POST['subject']);
        $msgtext = $_POST['msgtext'];

        $checkuser = DB::run("SELECT `username` FROM `grpgusers` WHERE `username`='".$to."'");
        $username_exist = $checkuser->rowCount();
        if($username_exist > 0){
            $result5= DB::run("INSERT INTO `pms` (`to`, `from`, `timesent`, `subject`, `msgtext`)".
                "VALUES ('$to', '$from', '$timesent', '$subject', '$msgtext')");
            echo "Message successfully sent to $to";
        } else {
            echo 'I am sorry but the Username you specified does not exist...';
        }

    }
}
?>
    <tr><td class="contenthead">Mass Mail</td></tr>
    <tr><td class="contentcontent">Here you can send a mass mail to every player in the game.</td></tr>
    <tr><td class="contenthead">New Message</td></tr>
    <tr><td class="contentcontent">
            <table width='100%'>
                <form method='post'>
                    <tr>

                        <td width='15%'>Subject:</td>
                        <td width='85%'><input type='text' name='subject' size='70' maxlength='75' value="MASS MAIL"></td>
                    </tr>
                    <tr>
                        <td width='15%'>Message:</td>
                        <td width='85%' colspan='3'><textarea name='msgtext' cols='53' rows='7'></textarea></td>
                    </tr>

                    <tr>
                        <td width='100%' colspan='4' align='center'><input type='submit' name='newmessage' value='Send'></td>
                    </tr>
                </form>
            </table>
        </td></td></tr>

<?php

include 'footer.php';
?>