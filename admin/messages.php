<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
    <style>
        /* Notification panel styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }

        .notification-panel {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: auto;
            overflow: hidden;
        }

        .notification-header {
            background-color: #4CAF50;
            color: #fff;
            padding: 15px;
            text-align: center;
            font-size: 1.5em;
            font-weight: bold;
        }

        .message {
            border-bottom: 1px solid #e0e0e0;
            padding: 15px;
            display: flex;
            flex-direction: column;
            transition: background-color 0.3s;
        }

        .message:last-child {
            border-bottom: none;
        }

        .message:hover {
            background-color: #f9f9f9;
        }

        .message-header {
            display: flex;
            justify-content: space-between;
            font-weight: bold;
            color: #333;
        }

        .message-content {
            margin-top: 5px;
            color: #555;
        }

        .message-details {
            font-size: 0.9em;
            color: #777;
            margin-top: 10px;
        }

        .empty-notification {
            text-align: center;
            padding: 20px;
            color: #777;
            font-size: 1.2em;
        }
    </style>
</head>
<body>

<div class="notification-panel">
    <div class="notification-header">Messages</div>

    <?php
// Include your database connection file
include 'db_connect.php';

// Fetch messages from the messages table and join with careers table to get job title
$query = "
    SELECT m.*, c.job_title 
    FROM messages m 
    LEFT JOIN careers c ON m.job_id = c.id 
    ORDER BY m.created_at DESC
";
$result = mysqli_query($conn, $query);

// Check if messages exist
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='message'>";
        echo "<div class='message-header'>
                <span>" . htmlspecialchars($row['name'] ?: 'Anonymous') . "</span>
                <span>" . htmlspecialchars($row['created_at']) . "</span>
              </div>";
        echo "<div class='message-content'>" . htmlspecialchars($row['message']) . "</div>";
        echo "<div class='message-details'>";

        // Display job title instead of job ID
        if (!empty($row['job_title'])) {
            echo "Job Title: " . htmlspecialchars($row['job_title']) . " | ";
        } else {
            echo "Job Title: Not Available | ";
        }

        if (!empty($row['email'])) {
            echo "Email: " . htmlspecialchars($row['email']) . " | ";
        }

        if (!empty($row['phone'])) {
            echo "Phone: " . htmlspecialchars($row['phone']);
        }

        echo "</div></div>";
    }
} else {
    echo "<div class='empty-notification'>No messages found.</div>";
}

// Close the database connection
mysqli_close($conn);
?>



</div>

</body>
</html>
