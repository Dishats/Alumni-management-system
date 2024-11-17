<?php
// load_messages.php

include 'admin/db_connect.php'; // Make sure this path is correct

// Fetch chat messages
$query = "SELECT cm.message, cm.created_at, u.name FROM chat_messages cm JOIN users u ON cm.user_id = u.id ORDER BY cm.created_at ASC";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="chat-message">';
        echo '<strong>' . htmlspecialchars($row['name']) . ':</strong> ';
        echo htmlspecialchars($row['message']);
        echo '<br><small>' . htmlspecialchars($row['created_at']) . '</small>';
        echo '</div>';
    }
} else {
    echo '<div class="chat-message">No messages yet.</div>';
}

$conn->close();
?>
