<?php

$is_invalid = false;
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $mysqli = require __DIR__ . "/database.php";

    $sql = sprintf("SELECT * FROM user
                    WHERE email = '%s'",
                   $mysqli->real_escape_string($_POST["email"]));

    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
    echo $user;


    if ($user) {

        if (password_verify($_POST["password"], $user["password_hash"])) {

            session_start();

            session_regenerate_id();

            $_SESSION["user_id"] = $user["id"];

            header("Location: player/${user["id"]}.php");
            exit;
        }
    }
    $is_invalid = true;
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
  
<div class="init">
    <?php if ($is_invalid): ?>
        <em>something's off ]]</em>
    <?php endif; ?>
    <form method="post">
        <label for="email">email</label>
        <input type="email" name="email" id="email"
               value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        <button>Log in</button>
    </form>
    <a href="forgot-password.php">Forgot password?</a>
</div>
<div class="wrapper">
        <div class="flex-container" >
        <div class="flex-left">      
        <div class="alert">
                      <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                        The code of conduct
                        <br><br><br>
                        
                        We are all on the same level:  All members of 868mHz are seen as equal and on the same level, regardless of their background and position. This should be a place free from stress, pressure, and competition, allowing vulnerability, experimentation, and doubt.<br><br>
                        We Respect each other: Respect for all members is required. While people may not like each other, it is important to maintain a cordial and tolerant level of respect for all members.<br><br> 
                        Celebrate Difference: Every member has fun in different ways, and with different aspects, has different skills and knowledge.  All members should do their best to contribute to the enjoyment of all members and learn from each other.<br><br>
                        We Listen to each other: Everyone is great at what they are doing and has a message that is important.  In listening to each other there's always an opportunity to learn something new from someone else.<br><br>
     </div></div></div></div>  
</body>
</html>

