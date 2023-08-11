<?php
    /*
    $serverUser = '88827654';
    $serverPass = '88827654';

    $database = 'db_88827654';

    $serverName = 'cosc360.ok.ubc.ca';
    */

    $serverUser = '88827654';
    $serverPass = '88827654';

    $database = 'db_88827654';

    $serverName = 'localhost';

    $mysqli = new mysqli($serverName, $serverUser, $serverPass, $database);
    $conn = mysqli_connect($serverName, $serverUser, $serverPass, $database);

    if ($mysqli->connect_error) {
        die('Connect Error (' .
            $mysqli->connect_errno . ') '.
            $mysqli->connect_error);
    }


?>