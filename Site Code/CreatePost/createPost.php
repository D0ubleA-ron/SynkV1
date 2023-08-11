<!DOCTYPE html>
<?php
session_start();
if(!isset($_SESSION['username']))
{
    header("Location: ../Login/Login.php");
    exit;
}
include '../tracker.php';
?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Create Post</title>
    <link rel="stylesheet" href="../CreatePost/createPost.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Mono">
    <link rel = "https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">

</head>
<body>
<ul>
    <li><a href="../Home/home.php"><div class = "textnav">Home</div></a></li>
    <li><a href="../My Playlists/MyPlaylists.php"><div class="textnav">My Playlists</div></a></li>
    <?php if(isset($_SESSION['username'])): ?>
        <li style="float:right">
            <a class="active" href="../AccountSettings/AccountSettings.php">
                <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($_SESSION['image']); ?>" style=" height: 2em">
            </a>
        </li>
    <?php else: ?>
        <li style="float:right"><a class="active" href="../AccountSettings/AccountSettings.php"><img src="../Vector.png" style=" height: 2em"></a></li>
    <?php endif; ?>
    <li><div class = "synklogo">Synk</div></li>
</ul>



<div class="container">


    <div class="col-md-8">
        <h2>New Post</h2>
        <form action = "posting.php" method="post" id="postForm">

            <label for="post-title"></label>
            <input type="text" id="post-title" name="post-title" placeholder="Enter Post Title..." required>

            <label for="post-content"></label>
            <textarea id="post-content" name="post-content" placeholder="Enter Post Description..." required></textarea>

            <input type="image" src="../Login/login.png" alt="Submit" style="position: absolute; margin-top: 25%; margin-left: 83%;">
        </form>
    </div>



</div>
<script src="createPostLogic.js"></script>
</body>
</html>