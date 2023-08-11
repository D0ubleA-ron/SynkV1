<?php
session_start();
if($_SESSION["username"] != "Admin"){
    header("Location:  ../AccountSettings/AccountSettings.php");
    exit;
}
if (isset($_GET["userId"])) {
    $userid = $_GET["userId"];
    $active = $_GET["active"];
    if($active == 1)
    {
        $active = 0;
    }
    else{
        $active = 1;
    }



    $servername = "localhost";
    $username = "88827654";
    $password = "88827654";
    $dbname = "db_88827654";
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    $sql2 = "UPDATE user SET active = ? WHERE userid = ?";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bind_param("ss", $active, $userid);
    $stmt2->execute();
    header("Location: search.php");
    exit;

}
?>