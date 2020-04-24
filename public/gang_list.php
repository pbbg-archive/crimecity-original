<?php
include 'header.php';
?>
    <tr><td class="contenthead">Gang List</td></tr>
    <tr><td class="contentcontent">
            <table width='100%'>
                <tr>
                    <td>Rank</td>
                    <td>Gang</td>
                    <td>Members</td>
                    <td>Leader</td>
                    <td>Level</td>
                </tr>
                <?php
                $result = DB::run("SELECT * FROM `gangs` ORDER BY `exp` DESC");
                $rank = 1;

                while ($line = $result->fetch(PDO::FETCH_LAZY))
                {
                    $result2 = DB::run("SELECT * FROM `grpgusers` WHERE `username`='".$line['leader']."'");
                    $worked2 = $result2->fetch();
                    $gang = New Gang($line['id']);
                    $gang_leader = new User($worked2['id']);

                    echo "
		<tr>
		<td>".$rank."</td>
		<td>".$gang->formattedname."</td>
		<td>".$gang->members."</td>
		<td>".$gang_leader->formattedname."</td>
		<td>".$gang->level."</td>
		</tr>
		";

                    $rank++;
                }
                ?>
            </table>
        </td></tr>
<?php
include 'footer.php';
?>