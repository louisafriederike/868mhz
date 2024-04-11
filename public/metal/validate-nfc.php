<?php

$mysqli = require __DIR__ . "/database.php";

$sql = sprintf("SELECT EXISTS (SELECT * FROM nfc WHERE nfc = '%d')",$mysqli->real_escape_string($_GET["nfc"]));

$result = $mysqli->query($sql);

$token_yes = $result->fetch_row()[0] === 1;

header("Content-Type: application/json");

echo json_encode(["tokenyes" => $token_yes]);
?>
