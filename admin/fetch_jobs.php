<?php
include 'db_connect.php'; // Make sure to include your database connection

// Query to fetch job count and authors
$query = "
    SELECT u.name AS posted_by, COUNT(c.id) AS count 
    FROM careers c
    JOIN users u ON c.user_id = u.id
    GROUP BY u.id
";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo "<h5>Total Jobs Posted: " . $result->num_rows . "</h5>";
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li>" . htmlspecialchars($row['posted_by']) . ": " . $row['count'] . " jobs posted</li>";
    }
    echo "</ul>";
} else {
    echo "No jobs found.";
}
?>
