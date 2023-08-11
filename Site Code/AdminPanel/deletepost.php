<?php
session_start();
if($_SESSION["username"] != "Admin"){
    header("Location:  ../AccountSettings/AccountSettings.php");
    exit;
}
if (isset($_GET["postId"])) {
    $posted = $_GET["postId"];

    $servername = "localhost";
    $username = "88827654";
    $password = "88827654";
    $dbname = "db_88827654";
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    $sql2 = "DELETE FROM Comment WHERE postId = ?";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bind_param("s", $posted);
    $stmt2->execute();

    $sql2 = "DELETE FROM Post WHERE postId = ?";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bind_param("s", $posted);
    $stmt2->execute();

    header("Location: search.php");
    exit;
}
?>