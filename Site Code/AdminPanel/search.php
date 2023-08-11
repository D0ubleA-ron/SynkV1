<?php
session_start();
if($_SESSION["username"] != "Admin"){
    header("Location:  ../AccountSettings/AccountSettings.php");
    exit;
}
include '../tracker.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title> Search </title>
    <link rel="stylesheet" href="Search.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Mono">
    <link rel = "https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">

</head>
<body>
<ul>
    <li><a href="../Home/home.php"><div class = "textnav">Home</div></a></li>
    <li><a href="../My Playlists/MyPlaylists.php"><div class="textnav">My Playlists</div></a></li>
    <li style="float:right"><a class="active" href="../AccountSettings/AccountSettings.php"><img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($_SESSION['image']); ?>" style="height: 2em"/></a></li>
    <li><div class = "synklogo">Synk</div></li>
</ul>

<div style="text-align: center;margin-top: 2em">
    <p style="color: #313131; margin-top: 5em; font-size: 30px"><a href="siteusage.php">Site Usage Reports</a></p>

    <form method="post" style="color: #313131">
        <div style="text-align: center;margin-top: 2em">
            <form>
                <p style="font-size: 30px">Admin Search</p>
                <input type="text" name="search" id="search" style="display: inline-block;border-color: #313131; outline-width: 1em;" placeholder="Enter username, email or post here...">
                <input type="submit" name="submit" value="Submit" style="display: inline-block; border-color: #313131; outline-width: 1em">
            </form>

    </form>
</div>
<?php

session_start();
echo "<div style='text-align: center'>";
if (isset($_POST["search"])) {
    $search = $_POST['search'];

    $servername = "localhost";
    $username = "88827654";
    $password = "88827654";
    $dbname = "db_88827654";


    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $search = $conn->real_escape_string($search);
    $query = "SELECT DISTINCT u.user,u.userId,p.postTitle, u.email, u.active FROM user u LEFT JOIN Post p ON u.userId = p.userId WHERE user LIKE '%$search%' OR postTitle LIKE '%$search%' OR email LIKE '%$search%' GROUP BY u.userid ORDER BY u.userId ASC ";
    $result = $conn->query($query);
    echo "<table border = 1 style='color: #313131; text-align: center;'>";
    echo "<tr><th>UserID</th><th>User</th><th>Email</th><th>Active</th><th>Enable/Disable User</th></tr>";
    while ($row = $result->fetch_assoc()) {
        if($row['active'] == 0)
        {
            $type = "enabled";
        }
        else{ $type = "disabed";}
        echo "<tr>";
        echo "<td>" . $row['userId'] . "</td>";
        echo "<td>" . $row['user'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $type . "</td>";
        echo "<td><a href=\"delete_user.php?userId=" . $row['userId'] . "&active=" . $row['active'] . "\">Enable/Disable User</a></td>";
        echo "</tr>";
        $sql2 = "SELECT postTitle, postContent, postId FROM Post WHERE userId = ?";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bind_param("s", $row["userId"]);
        $stmt2->execute();
        $result2 = $stmt2->get_result();
        if ($result2->num_rows > 0) {
            echo "<tr><td colspan = 5 ><table border = 1 ><tr><th>Post ID</th><th>Post Title</th><th>Post Description</th><th>Delete Post</th><th>Edit Post</th><th>Post Analytics</th></tr>";
            while ($row2 = $result2->fetch_assoc()) {
                echo "<tr>" . "<td>" . $row2['postId'] . "</td>" . "<td>" . $row2['postTitle'] . "</td>" . "<td>" . $row2['postContent'] . "</td>" . "<td><a href=\"deletepost.php?postId=" . $row2['postId'] . "\">Delete Post</a></td>" . "<td><a href=\"editpost.php?postId=" . $row2['postId'] . "\">Edit Post</a></td>"."<td><a href=\"PlaylistAnalytics.php?postId=" . $row2['postId'] ."&postTitle=".$row2['postTitle'] ."\">View Analytics</a></td>" . "</tr>";
                $sql3 = "SELECT commentId, commentContent, userId FROM Comment WHERE postId = ?";
                $stmt3 = $conn->prepare($sql3);
                $stmt3->bind_param("s", $row2["postId"]);
                $stmt3->execute();
                $result3 = $stmt3->get_result();
                if ($result3->num_rows > 0) {
                    echo "<tr><td colspan = 6 ><table border = 1 ><tr><th>Comment ID</th><th>User That Commented</th><th>Comment Content</th><th>Delete Comment</th><th>Edit Comment</th></tr>";
                    while ($row3 = $result3->fetch_assoc()) {
                        $sql4 = "SELECT user FROM user WHERE userId = ?";
                        $stmt4 = $conn->prepare($sql4);
                        $stmt4->bind_param("s", $row3["userId"]);
                        $stmt4->execute();
                        $result4 = $stmt4->get_result();
                        while ($row4 = $result4->fetch_assoc()) {
                            $usernamed = $row4["user"];
                        }
                        echo "<tr>" . "<td>" . $row3['commentId'] . "</td>". "<td>" . $usernamed . "</td>"  . "<td>" . $row3['commentContent'] . "</td>" . "<td><a href=\"deletecomment.php?commentId=" . $row3['commentId'] . "\">Delete Comment</a></td>". "<td><a href=\"editcomment.php?commentId=" . $row3['commentId'] . "\">Edit Comment</a></td>" ."</tr>";

                    }
                    echo "</table></td></tr>";

                }
            }
            echo "</table></td></tr>";
        }
    }
    echo "</table>";
    echo "</div>";
}

?>
</body>
</html>
