<?php
include 'db_connect.php'; // Make sure to include your database connection

// Query to fetch publication count and authors
$query = "
    SELECT u.name AS posted_by, COUNT(ft.id) AS count 
    FROM forum_topics ft
    JOIN users u ON ft.user_id = u.id
    GROUP BY u.id
";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo "<h5>Total Publications: " . $result->num_rows . "</h5>";
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li>" . htmlspecialchars($row['posted_by']) . ": " . $row['count'] . " publications</li>";
    }
    echo "</ul>";
} else {
    echo "No publications found.";
}
?>
