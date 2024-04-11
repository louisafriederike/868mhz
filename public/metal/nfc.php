
<?php

$mysqlinfc = require __DIR__ . "/database.php";

//$sqlnfc = sprintf("SELECT EXISTS (SELECT * FROM user WHERE nfc = '12345')", $mysqlinfc->real_escape_string($_POST["nfc"]));
$sqlnfc = sprintf("SELECT EXISTS (SELECT * FROM nfc WHERE nfc = '12345')",$mysqlinfc->real_escape_string($_POST["6"]));

//print_r($sqlnfc);
 $result = $mysqlinfc->query($sqlnfc);
//  print_r($result);
$user = $result->fetch_row();
//  print_r($user);
printf($user[0]);

if($user[0] > 0){
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
            exit;

    } else {

            if ($mysqli->errno === 1062) {
                die("email already taken");
        } else {
            die($mysqli->error . " " . $mysqli->errno);
        }
    }
} else {
 echo "no";
}

//$row_cnt = $result->num_rows;
//print_r($row_cnt);

//if($result){
//if ($result->fetch_row()) {
// echo "yes";
// } else {
// echo "no";
//
//}
//}
