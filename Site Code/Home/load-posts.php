<?php

session_start();
include "../dbh.php";
$term = $_GET['content'];
$type = $_GET['type'];
$serverUser = '88827654';
$serverPass = '88827654';

$database = 'db_88827654';

$serverName = 'localhost';

$mysqli = new mysqli($serverName, $serverUser, $serverPass, $database);
$conn = mysqli_connect($serverName, $serverUser, $serverPass, $database);

if ($mysqli->connect_error) {
    die('Connect Error (' .
        $mysqli->connect_errno . ') ' .
        $mysqli->connect_error);
}

if ($type == "hotpost"){
    $stmt2 = $mysqli -> prepare("SELECT Post.postId, user.user AS userName, Post.postTitle, Post.postContent, COUNT(upvote.postId) AS total_upvotes FROM Post LEFT JOIN upvote ON Post.postId = upvote.postId LEFT JOIN user ON Post.userId = user.userId WHERE (postTitle LIKE CONCAT('%', ?, '%') OR postContent LIKE CONCAT('%', ?, '%')) AND user.active = 0 GROUP BY Post.postId ORDER BY total_upvotes DESC;");
    $stmt2->bind_param("ss", $term, $term);
    $stmt2->execute();
    $result2 = $stmt2->get_result();
} else {
    $stmt2 = $mysqli->prepare("SELECT postId, postTitle, user.user AS userName, postContent FROM Post JOIN user ON Post.userId = user.userId AND user.active = 0 WHERE postTitle LIKE CONCAT('%', ?, '%') OR postContent LIKE CONCAT('%', ?, '%') ORDER BY time DESC;");
    $stmt2->bind_param("ss", $term, $term);
    $stmt2->execute();
    $result2 = $stmt2->get_result();
}

if (mysqli_num_rows($result2) > 0){

    $posts = array();
    while ($row = $result2->fetch_assoc()) {
        $posts[] = $row;
    }

    echo json_encode($posts);
} else {
    echo '<p> There are no posts </p>';
}
$mysqli->close();

?>