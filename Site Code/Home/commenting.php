<?php

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../Login/Login.php");
    exit;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["comment-content"])) {


        $idlocal = $_SESSION['commentId'];


        $content = $_POST['comment-content'];
        $userId = $_SESSION['userId'];

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


        $stmt = mysqli_prepare($conn, "INSERT INTO Comment(postId, userId, commentContent) VALUES (?, ?, ?)");

        mysqli_stmt_bind_param($stmt, "iis", $idlocal, $userId, $content);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        header("Location: ../Home/comment.php?id=$idlocal");
        exit;



    }
}

?>
