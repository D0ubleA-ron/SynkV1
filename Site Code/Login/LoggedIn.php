<?php
session_start();
    if (isset($_POST["username"]) && isset($_POST["password"])) {
        $usernameuser = $_POST['username'];
        $passworduser = $_POST['password'];
        $passworduser = md5($passworduser);

        $servername = "cosc360.ok.ubc.ca";
        $username = "88827654";
        $password = "88827654";
        $dbname = "db_88827654";



        $conn = mysqli_connect($servername, $username, $password, $dbname);

        $stmt = $conn->prepare("SELECT EXISTS(SELECT * FROM user WHERE email=? AND password=?)");
        $stmt->bind_param("ss", $usernameuser, $passworduser);
        $stmt->execute();
        $stmt->bind_result($exists);
        $stmt->fetch();
        $stmt->close();

        if ($exists) {
            $stmt = $conn->prepare("SELECT `userId`, `user`, `email`, `password` FROM user WHERE email=? AND password=?");
            $stmt->bind_param("ss", $usernameuser, $passworduser);
            $stmt->execute();
            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()) {
                $username2 = $row["user"];
                $_SESSION['userId'] = $row["userId"];
            }

            $stmt->close();

            // Get image data from database
            $username = $_POST['username'];

            $result = $conn->query("SELECT image FROM user WHERE user = '$username2'");
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $_SESSION['image'] = $row['image'];
                }
            }

            $_SESSION['username'] = $username2;
            $_SESSION['email'] = $usernameuser;
            header("Location: ../AccountSettings/AccountSettings.php");
            exit;
        }
        else{
            echo '<script>alert("Incorrect email or password. Please try again.");</script>';
            header("refresh:0; url=../Login/Login.php");
            exit;
        }

}
?>