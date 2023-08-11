<?php
session_start();
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
$postId = $_GET['id'];
$userId = $_SESSION['userId'];

$stmt = $mysqli->prepare("INSERT IGNORE INTO upvote (postId, userId) VALUES (?,?);");
$stmt->bind_param("ii", $postId, $userId);
if ($stmt->execute()) {
    echo "Upvote recorded successfully.";
} else {
    echo "Error recording upvote: " . $stmt->error;
}
?>
