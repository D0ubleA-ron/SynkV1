<?php
header("Location: AccountSettings.php");
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../Login/Login.php");
}
else{
    $username2 = $_SESSION['username'];
}
$passwordreset = $_POST['passwordreset'];
$passwordreset = md5($passwordreset);


$servername = "cosc360.ok.ubc.ca";
$username = "88827654";
$password = "88827654";
$dbname = "db_88827654";

$conn = mysqli_connect($servername, $username, $password, $dbname);
    echo $passwordreset;
$sql = "UPDATE user SET password='" . $passwordreset . "' WHERE user='" . $username2 . "'";
$result = mysqli_query($conn, $sql);
exit;

?>