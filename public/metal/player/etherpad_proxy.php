<?php
$etherpadURL = 'https://eth.leverburns.blue/p/2.php';

$response = file_get_contents($etherpadURL);

if ($response !== false) {
    // Set the appropriate content type header
    header('Content-Type: text/plain');
    echo $response;
} else {
    // Handle the error
    header('HTTP/1.1 500 Internal Server Error');
    echo 'Failed to fetch Etherpad content';
}
