<?php
include 'header.php';

$result = DB::run("SELECT * FROM `grpgusers` ORDER BY `id` ASC");
$totalmobsters = $result->rowCount();
$result2 = DB::run("SELECT * FROM `grpgusers` WHERE `rmdays`!='0'");
$totalrm = $result2->rowCount();

?>


<tr><td class="content">World Stats (more will be added soon)</td></tr>
<tr><td class="content">

        <table width='100%' cellpadding='4' cellspacing='0'>
            <tr>
                <td class='textl' width='15%'>Mobsters:</td>
                <td class='textr' width='35%'><?php $totalmobsters ?></td>
                <td class='textl'>Respected Mobsters:</td>
                <td class='textr'><?php $totalrm ?></td>
            </tr>
        </table>
    </td></tr>


<!---->
<?php
include 'footer.php';
?>


