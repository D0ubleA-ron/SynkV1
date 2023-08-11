<?php
session_start();
if($_SESSION["username"] != "Admin"){
    header("Location:  ../AccountSettings/AccountSettings.php");
    exit;
}


if (isset($_GET["commentId"])) {
    $comentid = $_GET["commentId"];

    $servername = "localhost";
    $username = "88827654";
    $password = "88827654";
    $dbname = "db_88827654";
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    $sql2 = "DELETE FROM Comment WHERE commentId = ?";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bind_param("s", $comentid);
    $stmt2->execute();
    header("Location: search.php");
    exit;
}
?>
