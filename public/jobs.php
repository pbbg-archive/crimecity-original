<?php

include 'header.php';



if($_GET['action']=="quit"){

    $result = DB::run("UPDATE `grpgusers` SET `job` = '0' WHERE `id`='".$_SESSION['id']."'");

    $user_class = new User($_SESSION['id']);

}

if($_GET['take'] != ''){

    $worked = DB::run("SELECT * FROM `jobs` WHERE `id`='".$_GET['take']."'")->fetch();



    if(($worked['level'] > $user_class->level)||($worked['strength'] > $user_class->strength)||($worked['defense'] > $user_class->defense)||($worked['speed'] > $user_class->speed)) {

        $error = "You don't have the needed skills or level to take this job.<br>";

    }

    if ($worked['name'] == ""){

        $error = "That's not a real job.";

    }

    if($error == "") {

        $result = DB::run("UPDATE `grpgusers` SET `job` = '".$_GET['take']."' WHERE `id`='".$_SESSION['id']."'");

        $user_class = new User($_SESSION['id']);

    } else {

        echo Message($error);

    }

}

if ($user_class->job != 0){

    $worked = DB::run("SELECT * FROM `jobs` WHERE `id`='".$user_class->job."' ORDER BY `money`")->fetch();



    echo "<tr><td class='contenthead'>Current Job</td></tr><tr><td class='contentcontent'>You are currently a ".$worked['name']."<br>You make $".$worked['money']." a day.<br><br><a href='jobs.php?action=quit'>Quit Job</a></td></tr>";

}

?>



    <tr><td class="contenthead">Job Center</td></tr>

    <tr><td class="contentcontent">

            <table width='100%'>

                <tr>



                    <td>Job</td>

                    <td>Requirements</td>

                    <td>Daily Payment</td>

                    <td>Apply For Job</td>


                </tr>



                <?php

                $result = DB::run("SELECT * FROM `jobs` ORDER BY `money` ASC");


                while ($line = $result->fetch(PDO::FETCH_LAZY))
                {

                    echo "

			<tr>

				<td width='25%'>".$line['name']."</td>



				<td width='35%'>

					Strength: ".$line['strength']."

					Defense:  ".$line['defense']."

					Speed:  ".$line['speed']."
					
					Level:  ".$line['level']."

				</td>

				<td width='20%'>$".$line['money']."</td>

				<td>

			";

                    if($line['id'] > $user_class->job){

                        echo "<a href='jobs.php?take=".$line['id']."'>Take Job</a>";

                    }

                    echo "</td></tr>";



                }

                ?>

            </table></div>

        </td></tr>

<?php

include 'footer.php';

?>