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
                <input id="input" name="word" autocomplete="off" onkeyup="this.value = this.value.toUpperCase();"/><button onclick="checkInputValue(document.getElementbyId('input').value)">>>></button>
            </form><br><br></span>
        </div>
        <p class="character-title">Spin:→ the spider</p>
        <p class="character-title">Group affiliation: Collector</p>
        <p class="score">ether credits: <?= htmlspecialchars($user["score"]) ?></p>
        <button><a href="https://eth.leverburns.blue/p/4" target="_blank">your notepad</a></button> 
        <br><br>
        <p class="character-text">You've always had a penchant for the magical and spiritualistic. You enjoy conducting rituals and infuse a cultic flavour into whatever you're engaged with.<br><br>
            Your strong need to be among humans and build communities is a driving force in your life. You view community-building as one of humanity's most potent tools. In an age marked by capitalism's rise and technological advancements, you see the danger of humans isolating themselves. You believe that isolated individuals are weak and incapable of effective resistance. Only together, as a community fueled by love and care, can we muster the strength to construct structures of solidarity, support each other, and resist exploitation. You're preoccupied with the question of how we can create a society that is caring and just for everyone. As a result, you often invent political systems and societal models, with your friends often serving as test subjects for your ideas.<br><br>
            Within the 868mHz community, your caring and altruistic engagement has earned you the moniker 'the mother of the community,' although you dislike this term. You see yourself more as a spider, weaving webs of connection and drawing people into those webs.<br><br>
            You, Nine, Wire, and (Roos) are childhood friends who all grew up in the same neighbourhood. From a young age, you shared a passion for fighting injustice. It all began with a detective club, which later evolved into weed protection activism, a graffiti gang, and eventually, a pirate radio collective. Your pirate radio group would hack into private radio channels once a month and deliver 20-30 minutes of jokes. Unfortunately, one day, you got caught, and since you were all minors, your parents were fined an exorbitant amount of money. Fortunately, (Roos)'s father covered the fee, but this incident marked the end of your official club activities.<br><br>
            A few years later, as your group of friends expanded, you came up with the idea of resurrecting your radio activities, but this time, you'd operate from the underground and online. You realised that radio was the perfect tool to address your concerns about losing control over the history and future of the city. It would provide you with a platform to speak and connect with like-minded individuals.
        </p>
        <br><br><button><a href="../../index.html">back</a></button>
    </div>
 

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


