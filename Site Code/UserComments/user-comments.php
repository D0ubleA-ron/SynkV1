<?php

session_start();
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
$id = $_SESSION['userId'];
$stmt2 = $mysqli->prepare("SELECT `commentContent`, user.user AS userName FROM `Comment` JOIN user ON Comment.userId = user.userId WHERE Comment.userId = ?;");

$stmt2->bind_param("i", $id);
$stmt2->execute();
$result2 = $stmt2->get_result();

if (mysqli_num_rows($result2) > 0){

    $comments = array();
    while ($row = $result2->fetch_assoc()) {
        $comments[] = $row;
    }

    echo json_encode($comments);
} else {
    echo '<p> There are no Comments </p>';
}
$mysqli->close();

?>