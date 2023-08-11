<?php
session_start();
$id = $_GET['id'];
$_SESSION['commentId'] = $_GET['id'];
include '../dbh.php';

$serverUser = '88827654';
$serverPass = '88827654';

$database = 'db_88827654';

$serverName = 'localhost';

$mysqli = new mysqli($serverName, $serverUser, $serverPass, $database);
$conn = mysqli_connect($serverName, $serverUser, $serverPass, $database);

if ($mysqli->connect_error) {
    die('Connect Error (' .
        $mysqli->connect_errno . ') '.
        $mysqli->connect_error);
}

?>

<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <title>comment</title>
    <link rel="stylesheet" href="../Home/comment.css"">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Mono">
    <link rel = "https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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

<div class = "container">
    <div class = "row">
        <div class = "col-md-12">
            <div class = "post-container">

            </div>

        </div>

    </div>

</div>

<script>
    function updateComments() {


        $.ajax({
            type: "GET",
            url: "user-comments.php?postId=<?php echo $id ?>",
            success: function(data) {
                $('.post-container').empty();
                var comments = JSON.parse(data);

                for (var i = 0; i < comments.length; i++) {
                    var commentHtml = '<div class="comment">';
                    commentHtml += '<p>' + comments[i].userName + ' Commented: </p>';
                    commentHtml += '<p>' + comments[i].commentContent + '</p>';
                    commentHtml += '</div>';
                    $('.post-container').append(commentHtml);

                }
            },
            complete: function() {
                setTimeout(updateComments, 5000);
            }
        });
    }

    $(document).ready(function() {
        updateComments();
    });


</script>
</body>
</html>
