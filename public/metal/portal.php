<?php

session_start();

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
    <div id="highscore"><p> { {{  we've stashed some ethers }} } </p><br>
        <table>
            <tr>
                <th>`` runner ~ ``</th>
                <th>* . ether credits * *</th>
            </tr>
<?php

$mysqli_score = require __DIR__ . "/database.php";

$sql_scores = "SELECT name, score FROM user ORDER BY score DESC";

$sql_score = $mysqli_score->query($sql_scores);

$ranking = 1;
if (mysqli_num_rows($sql_score)) {
    while ($row = mysqli_fetch_array($sql_score)) {
          echo "<tr>
             <td>{$row['name']}</td>
             <td>{$row['score']}</td>
           <tr>";
           $ranking++;
    }
}

?>

          <tr>
                <td> <?= htmlspecialchars($row['name']) ?> </td>
                <td> <?= htmlspecialchars($row['score']) ?> </td>
            </tr>

  </div>
  <?php else: ?>
    <button><a href="signup.html">sign up</a></button>
    <button><a href="login.php">log in</a></button>
  <?php endif; ?>
</div>
</div>
</body>
</html>


