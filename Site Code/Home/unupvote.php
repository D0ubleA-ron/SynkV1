<?php
$serverUser = '88827654';
$serverPass = '88827654';
$database = 'db_88827654';
$serverName = 'localhost';
$mysqli = new mysqli($serverName, $serverUser, $serverPass, $database);

if ($mysqli->connect_error) {
    die('Connect Error (' .
        $mysqli->connect_errno . ') '.
        $mysqli->connect_error);
}


session_start();
$postId = $_POST['postId'];
$userId = $_SESSION['userId'];


$stmt = $mysqli->prepare("DELETE FROM upvote WHERE postId = ? AND userId = ?;");
$stmt->bind_param("ii", $postId, $userId);
$stmt->execute();
?>