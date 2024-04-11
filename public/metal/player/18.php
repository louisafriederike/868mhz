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
          <p class="character-title">The Magpie</p>
        <p class="character-title">Group affiliation: Collector</p>
        <p class="score">ether credits: <?= htmlspecialchars($user["score"]) ?></p>
        <button><a href="https://eth.leverburns.blue/p/18" target="_blank">your notepad</a></button> 
        <br><br>
        <div class="section">
        <p class="character-text">Unlike everyone else in this group, you are neither particularly tech-savvy
            nor interested in all this smart technology and security talk. One reason for
            this might be your complicated and tense relationship with your father, who is
            the CEO of Exogen. He strongly disapproves of your friends and believes you are
            wasting your time, urging you to pursue a more sensible profession. Nonetheless,
            you become defensive when people criticise Exogen or plan to vandalise
            it.<br><br>You are the youngest member of the group. Despite being above-average smart,
            you have one significant disadvantage—you are extremely susceptible to anything
            that appears enticing, whether it’s something shiny, a tempting advertisement,
            or an enticing online offer. Unfortunately, this vulnerability makes you an
            easy target for frivolous purchases, accepting all kinds of cookies, and, most
            notably, scammers and hackers. You get hacked at least weekly because you click
            on links promising you supposed winnings, like the $500,000 from Nelson Mandela’s
            cousin or aunt (he seemingly had a huge family).<br><br>
            However, your attraction to shiny things in the virtual world becomes an advantage
            in the real world. You possess a natural talent for finding treasures of
            all kinds, almost as if you are magically drawn to them. Not every treasure is
            immediately obvious in its value, and you understand that some treasures are
            meant for others. Your pockets are often filled with curious items that you
            carry around, each looking for its rightful owner. You have a unique ability to
            sense when people need a treasure, often before they realise it themselves, you
            are there to hand them what could be useful for them in the future.
            You, Nine, Wire, and Spin are childhood friends who all grew up in the same
            neighbourhood. From a young age, you shared a passion for fighting injustice.
            It all began with a detective club, which later evolved into weed protection
            activism, a graffiti gang, and eventually, a pirate radio collective. Your pirate
            radio group would hack into private radio channels once a month and deliver
            20-30 minutes of jokes. Unfortunately, one day, you got caught, and since
            you were all minors, your parents were fined an exorbitant amount of money.
            Fortunately, your father covered the fee, but this incident marked the end of
            your official club activities.<br><br>A few years later, as your group of friends expanded, you came up with the idea
            of resurrecting your radio activities, but this time, you’d operate from the
            underground and online. You realised that radio was the perfect tool to address
            your concerns about losing control over the history and future of the city. It
            would provide you with a platform to speak and connect with like-minded individuals.</p>
       
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

