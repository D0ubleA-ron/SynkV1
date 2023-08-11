<?php
session_start();
if($_SESSION["username"] != "Admin"){
    header("Location:  ../AccountSettings/AccountSettings.php");
    exit;
}
if (isset($_GET["postId"])) {
    $postid = $_GET["postId"];
    $servername = "localhost";
    $username = "88827654";
    $password = "88827654";
    $dbname = "db_88827654";
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    $postid = $conn->real_escape_string($postid);
    $query = "SELECT postTitle, postContent FROM Post WHERE postId = ?";
    $stmt2 = $conn->prepare($query);
    $stmt2->bind_param("s", $postid);
    $stmt2->execute();
    $result2 = $stmt2->get_result();
    if ($result2->num_rows > 0) {
        while ($row = $result2->fetch_assoc()) {
            $posttitle = $row["postTitle"];
            $postdesc = $row["postContent"];
        }
    }


}
?>
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
        <li style="float:right"><a class="active" href="../AccountSettings/AccountSettings.php"><img src="../Vector.png" style=" height: 2em"></a></li>
        <li><div class = "synklogo">Synk</div></li>
    </ul>
<form method="post">
    <div style="text-align: center;margin-top: 10em">
        <p style="color: #313131">Title</p>
        <input type="text" name="posttitle" id="usernamereset" style="display: inline-block;border-color: #313131; outline-width: 1em;" value="<?php echo $posttitle?>" required>
        <p style="color: #313131">Description</p>
        <input type="text" name="postdesc" id="usernamereset" style="display: inline-block;border-color: #313131; outline-width: 1em;" value="<?php echo $postdesc?>" required>
        <input type = "Submit" style="display: block; outline-color: #313131; outline-width: 1em; margin-top: 4em; margin-left: 56.5em" >Submit Edit</input>
    </div>

</form>
</body>
</html>
<?php
    if(isset($_POST["posttitle"]) && isset($_POST["postdesc"]))
    {

        $postdesc = $_POST["postdesc"];
        $posttitle = $_POST["posttitle"];

        $postdesc = $conn->real_escape_string($postdesc);
        $posttitle = $conn->real_escape_string($posttitle);
        $query = "UPDATE Post SET postTitle = ?, postContent = ? WHERE postid = ?";
        $stmt2 = $conn->prepare($query);
        $stmt2->bind_param("ssi", $posttitle,$postdesc,$postid);
        $stmt2->execute();
        header("Location: search.php");
        exit;

    }

?>