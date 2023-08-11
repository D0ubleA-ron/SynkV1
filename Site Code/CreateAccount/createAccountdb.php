<?php
if (isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["username"])) {
    $email = $_POST['email'];
    $passworduser = $_POST['password'];
    $passworduser = md5($passworduser);
    $usernameuser = $_POST['username'];


    $servername = "localhost";
    $username = "88827654";
    $password = "88827654";
    $dbname = "db_88827654";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    $stmt = $conn->prepare("SELECT EXISTS(SELECT * FROM user WHERE email=? OR user=?)");
    $stmt->bind_param("ss", $email, $usernameuser);
    $stmt->execute();
    $stmt->bind_result($exists);
    $stmt->fetch();
    $stmt->close();
    if(!$exists) {
        $fileName = basename($_FILES["image"]["name"]);
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

        // Allow certain file formats
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');

        if ($_FILES["image"]["size"] > 500000) {
            echo '<script>alert("File Too Large, Select File Under 500kB.");</script>';
            header("refresh:0; url=../CreateAccount/createAccount.php");
            exit;
        }
        if (in_array($fileType, $allowTypes)) {
            $image = $_FILES['image']['tmp_name'];
            $imgContent = addslashes(file_get_contents($image));


            // Insert image content into database
            $insert = $conn->query("INSERT into user (user, email, password, image, active) VALUES ('$usernameuser','$email','$passworduser','$imgContent', 0)");
            header("Location: ../Login/Login.php");
            exit;
        } else {
            echo '<script>alert("Incorrect File Type. Please try again.");</script>';
            header("refresh:0; url=../CreateAccount/createAccount.php");
            exit;
        }
    }
    else {
        echo '<script>alert("Username or Email in use. Please try again.");</script>';
        header("refresh:0; url=../CreateAccount/createAccount.php");
        exit;
    }
}
?>