<?php
session_start();
$ip =  $_SERVER['REMOTE_ADDR'];
$url =  $_SERVER['REQUEST_URI'];
$ip = md5($url);
if (isset($_SESSION['username']) && isset($_SESSION['userId']))
{
    $user =  $_SESSION['username'];
    $userid =  $_SESSION['userId'];
}
else{
    $user = '';
    $userid = '';
}

$date = new DateTime('now', new DateTimeZone('America/Vancouver'));
$date_str = $date->format('Y-m-d H:i:s');

$servername = "localhost";
$username = "88827654";
$password = "88827654";
$dbname = "db_88827654";
$conn = mysqli_connect($servername, $username, $password, $dbname);

$sql2 = "INSERT INTO Tracking(ip_address,link, user, userid, date)  VALUES (?,?,?,?,?)";
$stmt2 = $conn->prepare($sql2);
$stmt2->bind_param("sssis", $ip, $url,$user, $userid, $date_str);
$stmt2->execute();
?>
