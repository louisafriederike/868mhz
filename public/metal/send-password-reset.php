<?php

$email = $_POST["email"];

$token = bin2hex(random_bytes(16));

$token_hash = hash("sha256", $token);

$expiry = date("Y-m-d H:i:s", time() + 60 * 30);

$mysqli = require __DIR__ . "/database.php";

$sql = "UPDATE user
        SET reset_token_hash = ?,
            reset_token_expires_at = ?
        WHERE email = ?";

$stmt = $mysqli->prepare($sql);

$stmt->bind_param("sss", $token_hash, $expiry, $email);

$stmt->execute();

if ($mysqli->affected_rows) {

    $subject = "~* *..* password-shifting ~";
    $body = "jump to https://eixo.codes/metal/reset-password.php?token=$token and conjure up your new password ~* *.. *";
    $from = 'spells';
    $headers = "From: $from";

if (mail($email, $subject, $body, $headers,)) {
    echo '*~```` email funnelled your way `*';
} else {
    echo "* .. i couldn't send you an email . please give it one more try *` ";
}

}
echo "  `` please check your inbox  `*";

?>
