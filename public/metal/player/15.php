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
          <p class="character-title">Gourmet Geographer</p>
        <p class="character-title">group affiliation: mapper</p>
        <p class="score">ether credits: <?= htmlspecialchars($user["score"]) ?></p>
        <button><a href="https://eth.leverburns.blue/p/15" target="_blank">your notepad</a></button> 
        <br><br>
        <div class="section">
        <p class="character-text">Your guilty pleasure is food; you cannot pass a food place without at least checking the menu. You find it very inspiring to see what is offered and at what prices, as well as how the same food is prepared differently. Of course, you cannot afford to eat out all the time, so your dream is to one day become a food journalist and get paid for your passion. Due to your interest in different types of food, you prefer to live in a larger city with a wide variety of offerings. You don't like to spend too much time in one neighbourhood because you enjoy comparing and exploring different areas of the city.<br><br>
        What you really dislike are franchises, and you are concerned that rising rents and smart travel apps directing people to specific locations are causing smaller food places to be overlooked and disappear. When you heard about 868MHz radio through an open call, you thought it could be your chance to start your career by writing food place reviews about the city. Additionally, you believe that the radio could be a great platform to invite others to share their tips and opinions. Since then, you have become interested in experimenting with different formats on the radio.<br><br>
        Despite the reservations held by most 868Mhz members regarding Rotterdam's smart city development, you find the bonuses and credits offered by the platform quite attractive and don't want to miss out.
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