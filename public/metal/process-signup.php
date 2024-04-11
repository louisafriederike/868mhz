
<?php

if (empty($_POST["nfc"])) {
  die("hey, you forgot your nfc here ]]");
//  $errnfc = "hey, you forgot your nfc here ]]";
//  exit;
}

if (empty($_POST["name"])) {
    die("Name is required");
}

if ( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("are you sure this is an email? ]]");
}

if (strlen($_POST["password"]) < 8) {
    die("password must be at least 8 characters");
}

if ( ! preg_match("/[a-z]/i", $_POST["password"])) {
    die("password must contain at least one letter");
}

if ( ! preg_match("/[0-9]/", $_POST["password"])) {
    die("password must contain at least one number");
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
    die("passwords must match");
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$mysqlinfc = require __DIR__ . "/database.php";

//$sqlnfc = "SELECT EXISTS (SELECT * FROM user WHERE nfc = '%d')";
$sqlnfc = sprintf("SELECT EXISTS (SELECT * FROM nfc WHERE nfc = '%d')",$mysqlinfc->real_escape_string($_POST["nfc"]));

//print_r($sqlnfc);
$result = $mysqlinfc->query($sqlnfc);
//print_r($result);

$user = $result->fetch_row();
print_r($user);
print_r($user[0]);

if ($user[0] > 0 ) {

	$mysqli = require __DIR__ . "/database.php";

	$sql = "INSERT INTO user (name, email, password_hash, nfc)
	VALUES (?, ?, ?, ?)";

	$stmt = $mysqli->stmt_init();

	if ( ! $stmt->prepare($sql)) {
    		die("SQL error: " . $mysqli->error);
	}

	$stmt->bind_param("ssss",
		$_POST["name"],
		$_POST["email"],
		$password_hash,
		$_POST["nfc"]);

	if ($stmt->execute()) {
		header("Location: signup-success.html");
	    	exit;

	} else {

    		if ($mysqli->errno === 1062) {
        		die("email already taken");
    	} else {
        	die($mysqli->error . " " . $mysqli->errno);
    	}
	}
} else {
	die("token not here");
}

?>
