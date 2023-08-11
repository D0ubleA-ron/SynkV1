<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../Login/Login.php");
}
else{
    $username2 = $_SESSION['username'];
}
$usernamereset = $_POST['usernamereset'];


$servername = "cosc360.ok.ubc.ca";
$username = "88827654";
$password = "88827654";
$dbname = "db_88827654";


$conn = mysqli_connect($servername, $username, $password, $dbname);

$stmt = $conn->prepare("SELECT EXISTS(SELECT * FROM user WHERE user=?)");
$stmt->bind_param("s", $usernamereset);
$stmt->execute();
$stmt->bind_result($exists);
$stmt->fetch();
$stmt->close();
if(!$exists)
{
    $sql = "UPDATE user SET user='" . $usernamereset . "' WHERE user='" . $username2 . "'";
    $result = mysqli_query($conn, $sql);
    $_SESSION['username'] = $usernamereset;
    header("Location: AccountSettings.php");
    exit;
}
else{
    echo '<script>alert("Username Taken. Please try again.");</script>';
    header("refresh:0; url=../AccountSettings/AccountSettings.php");
    exit;
}

?>
