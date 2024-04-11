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
          <p class="character-title">The Nose</p>
        <p class="character-title">group affiliation: observer</p>
        <p class="score">ether credits: <?= htmlspecialchars($user["score"]) ?></p>
        <button><a href="https://eth.leverburns.blue/p/16" target="_blank">your notepad</a></button> 
        <br><br>
        <div class="section">
        <p class="character-text">
        You have a peculiar habit of constantly wanting to smell things. Perhaps it stems from growing up with a dog, as your parents were often busy, and your dog was your constant companion. Smelling things gives you a sense of better understanding them, and you make sense of the world through scent, relying on it for memorization. While being nosy isn't always welcomed, it has the advantage of making you exceptionally curious and well-informed.<br><br>
        Having grown up in the countryside, the overwhelming array of smells but first and foremost stinkyness in the city leaves you in awe. To process this sensory overload, you journal about your daily olfactory experiences or have to discuss them with someone.<br><br>
        One day, you accidentally ended up at a rave, where you were on the brink of a breakdown due to the overwhelming scent of the smoke machine and the collective sweat of the crowd. That's when Spin came to your rescue. Since then she has taken you under her wing and helped you navigate city life. She invited you to become part of 868mHz to connect with people here in the city.
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