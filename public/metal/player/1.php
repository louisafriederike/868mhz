<?php

session_start();

if (isset($_SESSION["user_id"])) {

    $mysqli = include __DIR__ . "/../database.php";

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
   <link href="../../style.css" rel="stylesheet">
   <meta property="og:title" content="EIXOGEN" />
   <meta property="og:description" content="EIXOGEN" />
   <meta property="og:image" content="" />
</head>
<body>

    <?php if (isset($user)): ?>
        <br><button class="red" ><a href="../logout.php">Log out</a></button> <button class="red" ><a href="../../index.html">back</a></button>
    <?php else: ?>
       <p> <button><a href="../login.php">Log in</a></button> or <button><a href="../signup.html">sign up</a></p></button></p>
    <?php endif; ?>
    <br><br><br>
    <h1>Home</h1>
        <p>Hello <?= htmlspecialchars($user["name"]) ?></p>
        <p>profile number: <?= htmlspecialchars($user["id"]) ?></p>
        <br><button><a href="../portal.php"> . . * your portal * ~ .</a></button><br><br>

        <div class="wrapper">
        <div class="flex-container" >
          <div class="flex-left">
          <button><a href="https://eth.leverburns.blue/p/1" target="_blank">your notepad</a></button>
          <div class="section">
             <p class="code-input">> enter codewords below to mine ether credits:  </br>
            </p>
            <span><form id="form" action="word.php" method="post">
                <input id="input" name="word" autocomplete="off" onkeyup="this.value = this.value.toUpperCase();"/><button onclick="sendMessage()">>>></button>
            </form><br><br></span>
        </div>
        <p class="character-title">Xyzzy →  The Hacker</p>
        <br><br><p class="score">ether credits: <?= htmlspecialchars($user["score"]) ?></p>
        <p class="character-title">Group affiliation: Wanderer </p>
        <div class="section">
             <p class="character-text">
                You're a lockpick, possessing an extraordinary ability to gain access anywhere, whether it's by picking physical locks, cracking safes, or infiltrating computer networks. Somehow, you always manage to get in. Your love for the internet sets you apart, as most of the group is focused on exploring the physical city while you navigate virtual realms. You spend so much time in front of the computer that the line between your own identity and the computer's becomes blurred. You frequently use computer commands in your everyday language and enjoy expressing yourself through code.<br><br><br>
                Not too long ago, you fell in love with a server. You understand that this is a complex and unusual topic for most people, but you believe it's essential to explore modern human-computer relationships. You see yourself as an ambassador or translator between human and computer languages. One of your contributions is creating poems in code language and organising code poetry reading nights on the radio.<br><br>
                You and Wire have known each other since childhood, both being part of a kids' computer club. And with the years you became part of the friend group that eventually founded 868mHz radio.<br><br>
                Within the 868mHz collective, you hold the responsibility for cybersecurity and awareness. Your mission is to support everyone in navigating the internet more safely, except for [roos], whom you consider a hopeless case. You often find yourself in discussions with her, as you find her behaviour impossible to comprehend.
             </p>
        </div>
        <p>add to your character below:</p>
        <iframe name="embed_readwrite" src="https://eth.leverburns.blue/p/1?showControls=false&showChat=false&showLineNumbers=false&useMonospaceFont=true" width="100%" height="600" frameborder="0"></iframe>
    </div>

    </div>
    </div>
    </div>

</body>
</html>

