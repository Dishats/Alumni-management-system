<?php
// save_message.php

include 'admin/db_connect.php'; // Make sure this path is correct
session_start();

$user_id = $_SESSION['login_id'] ?? 1; // Use session user_id, default to 1 if session is not set for testing
$message = trim($_POST['message']);

if (!empty($message) && isset($user_id)) {
    $stmt = $conn->prepare("INSERT INTO chat_messages (user_id, message, created_at) VALUES (?, ?, NOW())");
    $stmt->bind_param("is", $user_id, $message);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Message sent successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid input or session.']);
}

$conn->close();
?>

<?php
// save_message.php

include 'db_connect.php'; // Make sure this path is correct

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['login_id']; // Assuming this is set when the user logs in
    $message = trim($_POST['message']);

    if (!empty($message) && isset($user_id)) {
        $stmt = $conn->prepare("INSERT INTO chat_messages (user_id, message, created_at) VALUES (?, ?, NOW())");
        $stmt->bind_param("is", $user_id, $message);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Message sent successfully!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to send message: ' . $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Message cannot be empty or user not logged in.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}

$conn->close();
?>
session_start();
print_r($_POST); // Check if data is received correctly

?>
