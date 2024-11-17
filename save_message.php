<?php
include 'admin/db_connect.php'; // Make sure this file is included

header('Content-Type: application/json'); // Set response type to JSON

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the data from POST
    $job_id = $_POST['job_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    // Validate the data (you can add more validations)
    if (empty($name) || empty($email) || empty($message)) {
        echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
        exit;
    }

    // Insert into the database
    $stmt = $conn->prepare("INSERT INTO messages (job_id, name, email, phone, message) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param('issss', $job_id, $name, $email, $phone, $message);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Message sent successfully!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
error_reporting(E_ALL);
ini_set('display_errors', 1);

?>
