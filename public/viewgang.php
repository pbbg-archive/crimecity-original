<?php
include 'header.php';
$gang_class = New Gang($_GET['id']);

if($_GET['id'] != ""){ // if there is an ID for the gang
    //display that gangs stuff
    $gang_class = New Gang($_GET['id']);
    if($gang_class->id == ""){
        echo Message("Non existant gang.");
        include 'footer.php';
        die();
    }
    ?>
    <tr>
        <td class="contenthead"><?php echo "[". $gang_class->tag . "]" . $gang_class->name; ?></td>
    </tr>
    <tr><td class="contentcontent">
            <table width='100%'>
                <tr>
                    <td>Rank</td>
                    <td>Mobster</td>
                    <td>Level</td>
                    <td>Money</td>
                    <td>Online</td>
                </tr>
                <?php
                $result = DB::run("SELECT * FROM `grpgusers` WHERE `gang` = '".$_GET['id']."' ORDER BY `exp` DESC");
                $rank = 0;

                while ($line = $result->fetch(PDO::FETCH_LAZY))
                {
                $gang_member = new User($line['id']);
                $rank = $rank +1;
                ?>
                <tr>
                    <td><?= $rank; ?></td>
                    <td><?= $gang_member->formattedname; ?></td>
                    <td><?= $gang_member->level; ?></td>
                    <td>$<?= $gang_member->money; ?></td>
                    <td><?= $gang_member->formattedonline; ?></td>
                    <?php
                    }
                    ?>
            </table>
        <td></tr>
    <?php
    echo '<tr><td class="contenthead">Invited Mobsters</td></tr>';
    $result = DB::run("SELECT * FROM `ganginvites` WHERE `gangid` = ",$_GET['id']);
    echo "<tr><td class='contentcontent'>";

    while ($line = $result->fetch(PDO::FETCH_LAZY))

    {
        echo "<div>".$line['username']."</div>";
    }
    echo "</td></tr>";
} else {
    echo Message("No gang selected.");
    include 'footer.php';
    die();

}
include 'footer.php';
?>