<?php
include 'db_connect.php'; // Include your database connection

// Query to fetch event details and participant count without user_id
$query = "
    SELECT e.id, e.title, e.schedule, COUNT(ec.user_id) AS participant_count 
    FROM events e
    LEFT JOIN event_commits ec ON e.id = ec.event_id
    GROUP BY e.id
";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo "<h5>Total Events: " . $result->num_rows . "</h5>";
    echo "<ul class='list-unstyled'>";
    while ($row = $result->fetch_assoc()) {
        echo "<li><strong>" . htmlspecialchars($row['title']) . "</strong> | Date: " . htmlspecialchars($row['schedule']) . " | Participants: " . $row['participant_count'] . "</li>";
    }
    echo "</ul>";
} else {
    echo "No events found.";
}
?>


