<?php
include 'db_connect.php';

// Query to fetch alumni counts by courses/branches
$query = "SELECT c.course, COUNT(*) as count 
          FROM alumnus_bio ab
          JOIN courses c ON ab.course_id = c.id
          WHERE ab.status = 1
          GROUP BY c.course";
$result = $conn->query($query);

// Prepare the output
$output = "<ul class='list-group'>";
while ($row = $result->fetch_assoc()) {
    $output .= "<li class='list-group-item d-flex justify-content-between align-items-center'>";
    $output .= $row['course']; // Display course/branch name
    $output .= "<span class='badge badge-primary badge-pill'>" . $row['count'] . "</span>";
    $output .= "</li>";
}
$output .= "</ul>";

// Return the output
echo $output;
?>


