<?php

session_start();

// remove next 3 lines when you're done, so that errors don't show up in a browser
ini_set("display_errors", "1");
ini_set("display_startup_errors", "1");
error_reporting(E_ALL);

if (isset($_SESSION["user_id"])) {
    $mysqli = require __DIR__ . "/database.php";
    $sql = "SELECT * FROM user WHERE id = {$_SESSION["user_id"]}";
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
}

?>

<!DOCTYPE html>
<html>
<head>
   <title>eixogen</title>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <link rel="icon" href="img/favicon.ico" type="image/x-icon" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="../style.css" rel="stylesheet">
   <meta property="og:title" content="EIXOGEN" />
   <meta property="og:description" content="EIXOGEN" />
   <meta property="og:image" content="" />
</head>
<body>
  <div class="section">
<div class="init">
  <?php if (isset($user)): ?>
    <div class="profile"> <p id="title">welcome to eixogen, <?= htmlspecialchars($user["name"]) ?></p> 
    <button><a href="player/<?= htmlspecialchars($user["id"]) ?>.php">your profile</a></button>
    <button><a href="logout.php">log out</a></button>
    <br><br>
    <p>[inbox]</p>
    <p>[drdrift]: stop on a traffic light for 10 periods. what do you notice?</p><br><br><br><br>
    <div id="highscore"><p>Highscore:</p><br>
    <!-- player name: player score -->
  
  
  </div>
  <?php else: ?>
    <button><a href="signup.html">sign up</a></button>
    <button><a href="login.php">log in</a></button>
  <?php endif; ?>
</div>
</div>
</body>
</html>

