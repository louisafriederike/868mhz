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
        <p class="character-title">Wire: 53000 Volt</p>
        <p class="score">ether credits: <?= htmlspecialchars($user["score"]) ?></p>
        <button><a href="https://eth.leverburns.blue/p/3" target="_blank">your notepad</a></button> 
        <br><br>
        <div class="section">
        <p class="character-text">You've been technically savvy since early childhood, always curious about how things work. At the age of 5, you dismantled and reassembled a coffee machine for the first time, though it couldn't brew coffee afterward. You did manage to convert the milk frother valve into a bubble machine. Data security and privacy are paramount concerns for you, and you dislike how tech giants exploit us in our everyday communication through smartphones and apps. Consequently, you're constantly on the lookout for alternative communication tools, such as letterboxing, wire phones, or chalk marks in urban spaces.
        Although you're often referred to as "Wire," you are more like the electrical voltage being delivered. <br><br>You're a bundle of energy and one of the founders and driving forces behind 868mHz. Your vision is to create a platform where a cacophony of peculiar voices and unconventional perspectives is amplified. You're also a connector, not just in the sense of wiring things together, but in connecting people with each other. Ensuring that all interested individuals feel welcome and heard within the 868mHz community is of great importance to you.
        Regarding your radio contributions, you see yourself as a DJ and believe you have a knack for choosing the right music. <br><br>Unfortunately, your sense of timing is a bit off-beat, often leading to inappropriate song selections that don't quite match the mood or each other. However, due to the community's politeness and respect, no one dares to tell you, allowing you to continue believing in your special talent for music selection.
        Your energy level is consistently high, sometimes causing you to act too quickly. Accidents are a common occurrence, particularly when soldering, resulting in your hands resembling a battlefield, perpetually covered in plasters and bandages. People have come to accept it as your distinctive style.
        You, Nine, Spin, and (Roos) are childhood friends who all grew up in the same neighbourhood. <br><br>From a young age, you shared a passion for fighting injustice. It all began with a detective club, which later evolved into weed protection activism, a graffiti gang, and eventually, a pirate radio collective. Your pirate radio group would hack into private radio channels once a month and deliver 20-30 minutes of jokes. Unfortunately, one day, you got caught, and since you were all minors, your parents were fined an exorbitant amount of money. Fortunately, (Roos)'s father covered the fee, but this incident marked the end of your official club activities.
        A few years later, as your group of friends expanded, you came up with the idea of resurrecting your radio activities, but this time, you'd operate from the underground and online. You realised that radio was the perfect tool to address your concerns about losing control over the history and future of the city. It would provide you with a platform to speak and connect with like-minded individuals.
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
            // Function to check the input value and submit the form
        function checkInputValue(event, button) {
            event.preventDefault(); // Prevent the form submission

            var inputValue = document.getElementById('input').value;
            if (inputValue === "9292") {
                // Trigger form submission
                button.closest('form').submit();
            }
        }

        $(document).ready(function () {
            $('#form').submit(function (e) {
                e.preventDefault(); // Prevent the form submission

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
    </script>
</body>
</html>

