<?php

session_start();

ini_set("display_errors", "1");
ini_set("display_startup_errors", "1");
error_reporting(E_ALL);

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
          <div class="section">
             <p class="code-input">> enter codewords below to mine ether credits:  </br>
            </p>
            <span><form id="form" action="word.php" method="post">
                <input id="input" name="word" autocomplete="off" onkeyup="this.value = this.value.toUpperCase();"/><button onclick="sendMessage()">>>></button>
            </form><br><br></span>
        </div>
          <p class="character-title">Night-Owl Oracle</p>
        <p class="character-title">group affiliation: mapper</p>
        <p class="score">ether credits: <?= htmlspecialchars($user["score"]) ?></p>
        <button><a href="https://eth.leverburns.blue/p/11" target="_blank">your notepad</a></button> 
        <br><br>
        <div class="section">
        <p class="character-text">The night is your sanctuary, and you've embraced the life of a night owl, taking mysterious walks through the city under the starry sky. Your fascination with the stars extends to studying constellations and their historical use in navigation and divination, extracting profound meaning from these celestial bodies. You are known for your good prediction and horoscopes, even though you never properly studied astrology you can intuitively read the messages from the stars.<br><br>
        Living in one of the world's most light-polluted countries poses a challenge, but it fuels your determination to discover dark pockets within the city. Your dream is to compile a darkness map of Rotterdam, revealing hidden corners where the stars can be seen.<br><br>
        Your journey to 868mHz began at a creative writing workshop where you met 9. When she found out about your horoscope gift she invited you to a future reading radio show, where listeners could call in and you gave them their horoscope. Since then you have been experimenting with different formats. While sharing isn't always easy for an introvert person like you, you appreciate the like-minded community and enjoy spending time with those who share your interests.<br><br>
        Although you align with the critical spirit of most 868Mhz members regarding the city's technological development, you're also biased because your parents work for Eixogen, and you feel a sense of loyalty toward them.
        </p>
       
    </div>
    <br><br><button><a href="../../index.html">back</a></button>

        <!-- <div class="score">
          <label for="worde">>>> CACHE CODE:</label>

          <p>>>> CACHE CODE:<br></p>
           <form id="code" action="word.php" method="post"">
            <input id="word" name="word" autocomplete="off" onkeyup="this.value = this.value.toUpperCase();"/><button onclick="sendMessage()">>>></button>
           </form><br><br> 
        </div> -->

        
    </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#submitButton').click(function (e) {
                e.preventDefault(); // Prevent the form submission

                // Check if the input value is "9292"
                var inputValue = $('#input').val();
                if (inputValue === "9292") {
                    // Make an AJAX request to /trash
                    $.post('/trash', function (data) {
                        // Handle the response if needed
                        console.log(data);
                        $('#response').text(data); // Display the response on the page
                    });
                }
            });
        });

        // Function to check the input value
        function checkInputValue(value) {
            if (value === "9292") {
                $('#submitButton').click();
            }
        }
    </script>
</body>
</html>