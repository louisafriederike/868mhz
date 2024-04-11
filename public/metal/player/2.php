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
<div class="section">
    <h1>Home</h1>
    <?php if (isset($user)): ?>

        <p>Hello <?= htmlspecialchars($user["name"]) ?></p>
        <p>Hello <?= htmlspecialchars($user["id"]) ?></p>


        <div class="score">
          <label for="worde">>>> CACHE CODE:</label>

          <p>>>> CACHE CODE:<br></p>
          <span><form id="form" action="word.php" method="post">
                <input id="input" name="word" autocomplete="off" onkeyup="this.value = this.value.toUpperCase();"/><button onclick="sendMessage()">>>></button>
            </form><br><br></span>
        </div>
        <textarea id="etherpadContent" rows="10" cols="50"></textarea>
        
        <script>
            // Function to fetch content from Etherpad
            function fetchEtherpadContent() {
                fetch('https://eth.leverburns.blue/p/2/export/txt')
                    .then(response => response.text())
                    .then(data => {
                        // Populate the textarea with the fetched content
                        document.getElementById('etherpadContent').value = data;
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }

            // Call the function to fetch Etherpad content when the page loads
            window.onload = function() {
                fetchEtherpadContent();
            };
        </script>
        </div>
        <p><a href="../logout.php">Log out</a></p>


    <?php else: ?>

        <p><a href="../login.php">Log in</a> or <a href="../signup.html">sign up</a></p>

    <?php endif; ?>

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

