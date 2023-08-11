<?php
$serverUser = '88827654';
$serverPass = '88827654';
$database = 'db_88827654';
$serverName = 'localhost';
$mysqli = new mysqli($serverName, $serverUser, $serverPass, $database);

if ($mysqli->connect_error) {
    die('Connect Error (' .
        $mysqli->connect_errno . ') '.
        $mysqli->connect_error);
}

$sql = "SELECT postId, postTitle, user.user AS userName, postContent FROM Post JOIN user ON Post.userId = user.userId WHERE active = 0;";

$result = $mysqli->query($sql);
$mysqli->close();

?>

<?php
include '../tracker.php'
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Mono">
    <link rel = "https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>
<body>




<div class = "container">

    <div class = "row">
        <div class = "col-md-8">

            <div class = "post-container">



            </div>
            <div class="create-post-button">
                <button class = "hotpost" onclick="hotpost()">Hottest Posts</button>
                <button class = "regularpost" onclick="regularpost()">Post by Date</button>
                <a href="../CreatePost/createPost.php"><img src="Vectorplus_button_image.png" alt="Create Post"></a>
            </div>
        </div>

    </div>




</div>
<div class="spotify-container">
    <p style="color: #F7F6C5 ">Playlist of the Day</p>
    <iframe style="border-radius:12px" src="https://open.spotify.com/embed/playlist/0nkuxVVvwVXZbAcDyYv6sh?utm_source=generator&theme=0" width="50%" height="352" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
</div>
<script src="homeLogic.js"></script>
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
    <input style=" position: relative; background-color: #313131; color: white; width: 20em; height:2em; margin-left: 55em; margin-top: 1.5em";   type = "text" name = "search" class = search placeholder = "Whats Boppin..." id = "search" class = "search">

</ul>

<script src="homeLogic.js"></script>

<script>
    var type = "regular";
    function updateComments(searchTerm, type) {


        $.ajax({
            type: "GET",
            url: "load-posts.php?content=",
            data: { content: searchTerm, type: type},
            success: function(data) {
                $('.post-container').empty();
                var comments = JSON.parse(data);

                for (var i = 0; i < comments.length; i++) {
                    var btnId = comments[i].postId;
                    var commentHtml = '<div class="post">';
                    commentHtml += '<button style="z-index: 100" class="upvote-btn" data = '  + comments[i].postId + ' onClick=clicker(' + btnId + ')>Upvote</button>';
                    commentHtml += '<h2 onclick="location.href=\'comment.php?id=' + comments[i].postId + '\'" style="cursor:pointer">' + comments[i].postTitle + '</h2>';
                    commentHtml += '<h4 onclick="location.href=\'comment.php?id=' + comments[i].postId + '\'" style="cursor:pointer">-' + comments[i].userName + '</h4>';
                    commentHtml += '<p onclick="location.href=\'comment.php?id=' + comments[i].postId + '\'" style="cursor:pointer">' + comments[i].postContent + '</p>';
                    commentHtml += '</div>';
                    $('.post-container').append(commentHtml);

                }
            },
            complete: function() {
                setTimeout(updateComments, 50000);
            }
        });
    }

    $(document).ready(function() {
        updateComments("", "regular");
    });

    $(document).ready(function(){
        $("input").keyup(function() {
            var name = $("input").val();
            updateComments(name);
        });
    });

    function clicker(clicked) {


        $.ajax({
            url: "upvote.php",
            data: {id: clicked},
            success: function() {
                alert ("Successfully upvoted the post");
            },
            error: function(){
                alert("The site is being a lil silly goofy. Plz try again later");
            }
        });
    }

    function hotpost(){
        updateComments("", "hotpost");
    }
    function regularpost(){
        updateComments("", "regularpost");
    }
</script>

</body>
</html>