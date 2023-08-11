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
    <title>Login</title>
    <link rel="stylesheet" href="LoginStyle.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Mono">
    <link rel = "https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="LoginClientSide.js"></script>
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
    <p>Log In</p>
    <form action="LoggedIn.php" method="post" id = "form1" onsubmit="return ValidateEmail(document.getElementById('username').value)">
        <input type="text" name="username" id="username" placeholder="Email" required>
        <input type="password" name="password" id="password" placeholder="Password" required>
        <span id="usernameError" style="display:none; color:red;position: absolute; bottom: 17em">Invalid email address!</span>
       <button type = "Submit"><img src="login.png" class="loginimg"></button>
    </form>
    <a href="../CreateAccount/createAccount.php" class="abselement" style="text-decoration: none">Create Account</a>
</div>

<script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>

</body>
</html>
