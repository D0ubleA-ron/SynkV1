<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["post-title"]) && isset($_POST["post-content"])){
        $title = $_POST['post-title'];
        $content = $_POST['post-content'];
        $userId = $_SESSION['userId'];

        $servername = "localhost";
        $username = "88827654";
        $password = "88827654";
        $dbname = "db_88827654";

        $conn = mysqli_connect($servername, $username, $password, $dbname);

        $stmt = mysqli_prepare($conn, "INSERT INTO Post(userId, postTitle, postContent) VALUES (?, ?, ?)");

        mysqli_stmt_bind_param($stmt, "iss", $userId, $title, $content);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        header("Location: ../Home/home.php");
        exit;
    }
}





?>