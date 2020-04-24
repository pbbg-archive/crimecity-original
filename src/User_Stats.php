<?php

declare(strict_types=1);

// is this class even used?
class User_Stats
{
    public int $playersloggedin = 0;
    public int $playersonlineinlastday = 0;
    public int $playerstotal;

    function __construct($wutever)
    {
        $result = DB::run("SELECT * FROM `grpgusers` ORDER BY `username` ASC");

        while($line = $result->fetch(PDO::FETCH_LAZY)) {

            $secondsago = time() - $line['lastactive'];

            if ($secondsago <= 300) {
                $this->playersloggedin++;
            }
        }

        $result3 = DB::run("SELECT * FROM `grpgusers` ORDER BY `username` ASC");

        while($line3 = $result3->fetch(PDO::FETCH_ASSOC)) {

            $secondsago = time() - $line3['lastactive'];

            if ($secondsago <= 86400) {
                $this->playersonlineinlastday++;
            }
        }

        $result2 = DB::run("SELECT * FROM `grpgusers`");
        $this->playerstotal = $result2->rowCount();
    }
}
