<?php 
include('db_connect.php'); // Include your database connection

if(isset($_GET['id'])){
    $notice_id = $_GET['id'];
    $query = $conn->query("SELECT * FROM notices WHERE id = $notice_id");
    if($query->num_rows > 0){
        $notice = $query->fetch_assoc();
    } else {
        echo "<p>No notice found.</p>";
        exit;
    }
} else {
    echo "<p>Invalid request.</p>";
    exit;
}
?>

<div class="container-fluid">
    <h4><?php echo ucwords($notice['title']); ?></h4>
    <p><small><?php echo date('M d, Y', strtotime($notice['created_at'])); ?></small></p>
    <hr>
    <p><?php echo nl2br($notice['content']); ?></p>
</div>
