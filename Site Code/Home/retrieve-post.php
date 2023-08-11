<?php
  $serverUser = '88827654';
  $serverPass = '88827654';

  $database = 'db_88827654';

  $serverName = 'cosc360.ok.ubc.ca';

  $mysqli = new mysqli($serverName, $serverUser, $serverPass, $database);

  if ($mysqli->connect_error) {
    die('Connect Error (' .
    $mysqli->connect_errno . ') '.
    $mysqli->connect_error);
  }

  $sql = "SELECT postTitle, user.user AS userName, postContent FROM Post JOIN user ON Post.userId = user.userId WHERE active = 0;";

  $result = $mysqli->query($sql);
  $posts = array();
  while ($row = $result->fetch_assoc()) {
    $posts[] = $row;
  }
  echo json_encode($posts);
  $mysqli->close();
?>