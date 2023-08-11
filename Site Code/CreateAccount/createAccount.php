<!DOCTYPE html>
<?php
session_start();
if(isset($_SESSION['username']))
{
    header("Location: ../AccountSettings/AccountSettings.php");
    exit;
}
include '../tracker.php';
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Account</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Mono">
    <link rel="stylesheet" href="createAccountStyle.css?v=<?php echo time(); ?>">
    <script src="pfpUpload.js"></script>
    <script src="createAccountClientSide.js"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-1WQYK1J7CX');
    </script>

</head>
<body>

<ul>
    <li><a href="../Home/home.php"><div class = "textnav">Home</div></a></li>
    <li><a href="../My Playlists/MyPlaylists.php"><div class="textnav">My Playlists</div></a></li>
    <li style="float:right"><a class="active" href="../AccountSettings/AccountSettings.php"><img src="../Vector.png" style=" height: 2em"></a></li>
    <li><div class = "synklogo">Synk</div></li>
</ul>


<div id = rectangle>
    <p>Sign Up</p>
    <form action="createAccountdb.php" method="post" id = "form" enctype="multipart/form-data" onsubmit="return ValidateEmail(document.getElementById('email').value)">
        <input type="file"  name="image" id="file" onchange="loadFile(event)" style="display: none" >
        <label for="file">
            <img src="Ellipse.png" class = "upload-icon" id="createimage" style="width: 7em; height: 7em; margin-right: 6em; margin-top: -4em" >
        </label>
        <input type="text" name="username" id="username" placeholder="Username" style="background-color: #F7F6C5;" required>
        <input type="text" name="email" id="email" placeholder="Email" style="background-color: #F7F6C5;" required>
        <input type="password" name="password" id="password" placeholder="Password" style="background-color: #F7F6C5;" required>
        <input type="password" name="password" id="passwordretest" placeholder="Password" style="background-color: #F7F6C5;"required>
        <span id="usernameError" style="display:none; color:red;posiction: absolute; bottom: 20.5em; font-size: 0.75rem">Invalid email address!</span>
        <span id="passwordError" style="display:none; color:red;position: absolute; bottom: 16.5em; font-size: 0.75rem">Passwords Do Not Match!</span>
        <span id="photoError" style="display:none; color:red;position: absolute; bottom: 21.5em; right:11.5em">Add Photo</span>
        <input type="submit" name="submit" value="Sign Up!" style="margin-top: 3em">
    </form>
    <a href="../Login/Login.php" class="abselement" style="text-decoration: none" >Oops, I already have an account</a>
</div>
</body>
