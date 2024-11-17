<?php
    include 'db_connection.php'; // Include your DB connection

    $sql = "UPDATE notices SET is_seen = 1 WHERE is_seen = 0";
    if (mysqli_query($conn, $sql)) {
        echo "Success";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
?>
