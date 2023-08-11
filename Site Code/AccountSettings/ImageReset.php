<?php

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../Login/Login.php");
}
else{
    $username2 = $_SESSION['username'];
}

$servername = "cosc360.ok.ubc.ca";
$username = "88827654";
$password = "88827654";
$dbname = "db_88827654";

$conn = mysqli_connect($servername, $username, $password, $dbname);
$fileName = basename($_FILES["image"]["name"]);
$fileType = pathinfo($fileName, PATHINFO_EXTENSION);
if ($_FILES["image"]["size"] > 500000) {
    echo '<script>alert("File Too Large, Select File Under 500kB.");</script>';
    header("refresh:0; url=../CreateAccount/createAccount.php");
    exit;
}

// Allow certain file formats
$allowTypes = array('jpg', 'png', 'jpeg', 'gif');
if (in_array($fileType, $allowTypes)) {
    $image = $_FILES['image']['tmp_name'];
    $imgContent = addslashes(file_get_contents($image));


    // Insert image content into database
    $insert = $conn->query("UPDATE user SET image = '$imgContent' WHERE user = '$username2';");


    $result = $conn->query("SELECT image FROM user WHERE user = '$username2'");
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $_SESSION['image'] = $row['image'];
        }
    }
    header("Location: AccountSettings.php");
    exit;
}
else {
    echo '<script>alert("Incorrect File Type. Please try again.");</script>';
    header("refresh:0; url=../AccountSettings/AccountSettings.php");
    exit;
}

?>