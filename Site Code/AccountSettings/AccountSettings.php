<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../Login/Login.php");
    exit;
}
$servername = "localhost";
$username = "88827654";
$password = "88827654";
$dbname = "db_88827654";


$conn = mysqli_connect($servername, $username, $password, $dbname);
$sql3 = "SELECT COUNT(*) FROM (SELECT * FROM Post WHERE time > (SELECT MAX(date) FROM Tracking WHERE userid = ? && link LIKE '%home.php%')) AS subquery;";
$stmt3 = $conn->prepare($sql3);
$stmt3->bind_param("s", $_SESSION['userId']);
$stmt3->execute();
$result3 = $stmt3->get_result();
if ($result3->num_rows > 0) {
    while ($row3 = $result3->fetch_assoc()) {
        $visit = $row3['COUNT(*)'];
    }
}
?>
<!DOCTYPE html>
<?php include '../tracker.php'; ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Account Settings</title>
    <link rel="stylesheet" href="AccountSettings.css">
    <script src="pfpUpload.js"></script>
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
    <p style="margin-left: 2rem; margin-top: 2rem; font-size: 3rem; position: absolute"> Hi, <?php echo $_SESSION['username']; ?>... There are <?php echo $visit?> new posts since your last visit! </p>

    <form action="UsernameReset.php" method="post" id = "form6"  style="margin-top: 9rem; margin-left: 2rem;">

        <input type="text" name="usernamereset" id="usernamereset" placeholder="Reset Username" required>
        <button type = "Submit" style="margin-left: 10rem; margin-top: -15em; text-decoration: none; color: #F7F6C5; ">Reset Username</button>
    </form>

    <form action="PasswordReset.php" method="post" style="text-decoration: none; color: #F7F6C5; "id = "form3" style="margin-top: 4em; margin-left: 2rem">
        <input style="margin-top: 2rem; margin-left: 2rem; " type="text" name="passwordreset" id="passwordreset" placeholder="Reset Password" required>
        <button style="margin-left: 10rem; margin-top:-5.5rem; text-decoration: #F7F6C5; color: #F7F6C5;" type = "Submit" >Reset Password</button>
    </form>

    <form action="ImageReset.php" method="post" id = "form5" enctype="multipart/form-data" style="margin-top: 7em; margin-left: -65rem">
        <button style="text-decoration: none; color: #F7F6C5;margin-left: 10em; margin-top: 4em" type = "Submit" >Reset Image</button>
        <input type="file"  name="image" id="file" onchange="loadFile(event)" style="display: none" >
        <label for="file">
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($_SESSION['image']); ?>" class = "upload-icon" id="createimage" style="width: 7em; height: 7em; margin-right: 6em; margin-top: -4em" >
        </label>
    </form>
    <?php

    if (isset($_SESSION['username']) && $_SESSION['username'] == "Admin") {
        echo '<a href="../AdminPanel/search.php" style="text-decoration: none; color: #F7F6C5; margin-left: 70em;margin-top: -2em; position: absolute"><p style="margin-top: 3rem; font-size: 3rem; margin-right: 70rem;">Admin Panel</p></a>';
    }
    ?>



    <a href="../UserComments/viewComments.php" style="text-decoration: none; color: #F7F6C5;">
        <p style="margin-top: 3rem; font-size: 3rem; margin-right: 0rem;">My Comments</p>
    </a>
    <a href="Logout.php"  style="text-decoration: none; color: #F7F6C5;"><p style="margin-top: -5rem; font-size: 3rem; margin-right: 70rem;">Logout</p></a>



</div>

</body>

</html>
