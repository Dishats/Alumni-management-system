<?php
include 'db_connect.php';

$query = "SELECT c.course, COUNT(*) as count 
          FROM alumnus_bio ab
          JOIN courses c ON ab.course_id = c.id
          WHERE ab.status = 1
          GROUP BY c.course";
$result = $conn->query($query);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = ['course' => $row['course'], 'count' => $row['count']];
}

echo json_encode($data);
?>
