<?php
session_start();

if (isset($_SESSION["user_id"])) {
    // Get the user input from the POST request
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['text'])) {
        // Store the user input in the session
        $_SESSION['user_text'] = $data['text'];

        // Send a response to indicate success
        echo json_encode(['message' => 'User text saved successfully.']);
    } else {
        // Send an error response
        http_response_code(400);
        echo json_encode(['message' => 'Invalid request.']);
    }
} else {
    // Send an error response if the user is not logged in
    http_response_code(403);
    echo json_encode(['message' => 'Access denied.']);
}
?>
