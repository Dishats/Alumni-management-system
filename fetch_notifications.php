<?php
session_start();
include('admin/db_connect.php');

$query = $conn->query("SELECT title, content, created_at FROM notices WHERE is_seen = 0 ORDER BY created_at DESC");

$notifications = array();
while ($row = $query->fetch_assoc()) {
    $notifications[] = array(
        'title' => $row['title'],
        'content' => $row['content'], // Include content (description)
        'created_at' => $row['created_at']
    );
}
echo json_encode($notifications);

$conn->close();
?>
