
<?php
session_start();
if(!isset($_SESSION['username']))
{
    header("Location: ../Login/Login.php");
    exit;
}
include '../tracker.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Playlists</title>
    <link rel="stylesheet" href="MyPlaylists.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Mono">

</head>
<body>

<ul>

    <li><a href="../Home/home.php"><div class = "textnav">Home</div></a></li>
    <li><a href="../My Playlists/MyPlaylists.php"><div class="textnav">My Playlists</div></a></li>
    <li style="float:right"><a class="active" href="../AccountSettings/AccountSettings.php"><img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($_SESSION['image']); ?>" style="height: 2em"/></a></li>
    <li><div class = "synklogo">Synk</div></li>

</ul>

<div id = rectangle>
    <p style="margin-right: 75em; margin-top: 2em">My Playlists</p>
    <?php

    session_start();
    if(isset($_SESSION['userId']))
    {
        $userid = $_SESSION['userId'];
    }
    $servername = "localhost";
    $username = "88827654";
    $password = "88827654";
    $dbname = "db_88827654";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $sql2 = "SELECT postTitle, postContent, postId FROM Post WHERE userId = ?";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bind_param("s", $userid );
    $stmt2->execute();
    $result2 = $stmt2->get_result();
    echo "<div style='margin-left: 5em; margin-top: 5em'>";
    echo "<table border = 1  style='background-color: #313131; color: #F7F6C5; border-color: #F7F6C5'; text-align: center;'>";
    echo "<tr><th>Post Title</th><th>Post Description</th><th>View Analytics</th></tr>";
    while ($row = $result2->fetch_assoc()) {

        echo "<tr>";
        echo "<td>" . $row['postTitle'] . "</td>";
        echo "<td>" . $row['postContent'] . "</td>";
        echo "<td><a style='color: #F7F6C5' href=\"PlaylistAnalytics.php?postId=" . $row['postId'] ."&postTitle=".$row['postTitle'] ."\">View Analytics</a></td>";

        echo "</tr>";
    }
    echo "</table>";
    echo "</div>"

    ?>
</div>
</body>

</html>