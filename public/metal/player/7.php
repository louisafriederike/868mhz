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
          <p class="character-title">*//Keep_it_Locked//*</p>
        <p class="character-title">Group affiliation: Collector</p>
        <p class="score">ether credits: <?= htmlspecialchars($user["score"]) ?></p>
        <button><a href="https://eth.leverburns.blue/p/7" target="_blank">your notepad</a></button> 
        <br><br>
        <div class="section">
        <p class="character-text">They call you the Alchemist because you possess the unique ability to transmute
            concepts or ideas into code and devices. This talent comes so intuitively to
            you that you often find it difficult to explain how you came to your results..
            Generally, talking to people is difficult, you prefer not to speak much, as you
            are a shy and introverted person—a true nerd. Nonetheless, you run a successful
            underground bureau where people seek your expertise for advanced, specialised,
            and often illegal cyber and digital technology problems.
            You crossed paths with Nine/9 a few years ago through mutual connections. She
            needed your assistance in hacking into the history of her brand-new electric
            toothbrush, which was sending her toothbrushing data to her health insurance
            company, leading to a dispute over dental treatment payments. Cases like these
            are a breeze for you. Since then, she has become a frequent client and even
            somewhat of a friend.
            Although everyone sees you as a techno-nerd, deep down, you are a truly romantic
            person. You express your feelings through beautiful love poems that you
            write in different code languages. However, your shyness prevents you from
            sharing them with the world. Instead, you often hack into websites and incorporate
            your poems as code into their source code, hoping that one day your expressions
            of love will be discovered, by someone or something that truly deserves
            it.</p>
       
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