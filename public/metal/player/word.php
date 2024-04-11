<?php

ini_set("display_errors", "1");
ini_set("display_startup_errors", "1");
error_reporting(E_ALL);

session_start();

if (empty($_POST["word"])) {
    die("almmost there ]]");
}


$mysqli = include __DIR__ . "/../database.php";

$sqlword = sprintf("SELECT EXISTS (SELECT * FROM code WHERE word = '%d' LIMIT 1)",$mysqli->real_escape_string($_POST["word"]));

$result = $mysqli->query($sqlword);
$word = $result->fetch_row();
//print_r($word);
//print_r($word[0]);


if ($word[0] > 0 ) {

   $mysqliword = include __DIR__ . "/../database.php";

   //$sqlid = "SELECT * FROM user WHERE id = 1";
   $sqlid = "SELECT * FROM user WHERE id = '".$_SESSION['user_id']."'";

   $resultid = $mysqliword->query($sqlid);
   $info = $resultid->fetch_assoc();
   $id = $info['id'];
   //print_r($id);
   $yourcolumn = $info['id'];
   //print_r($yourcolumn);

   $sqlcheckword = sprintf("SELECT EXISTS (SELECT * FROM check_words WHERE `".$id."` = '%d' LIMIT 1)",$mysqliword->real_escape_string($_POST["word"]));

   $checkresult = $mysqliword->query($sqlcheckword);
   //print_r($checkresult);
   $isword = $checkresult->fetch_row();
   //print_r($isword);


  if ($isword[0] == 0 ) {

  $remembercache = "INSERT INTO check_words (`".$id."`) VALUES (?)";

        $glue = $mysqli->stmt_init();

	if ( ! $glue->prepare($remembercache)) {
    		die("SQL error: " . $mysqli->error);
	}

	$glue->bind_param("s", $_POST["word"]);

        $glue->execute();


   $mysqliword = "UPDATE user SET score = score + 25 WHERE id = {$id}";

   $stmt = $mysqli->prepare($mysqliword);

   $stmt->execute();

   echo "+ + ++++ ++ + 25 ether credits";

   } else {
	echo ".. .* you've already used this code **~... .. .";
   }

} else {
      echo ".. .* i can't recognize this code **~... .. .";
     $cachegone = true;
}

?>
