<?php 
include 'admin/db_connect.php'; 
?>
<style>
/* Your styles go here */
</style>
<header class="masthead">
    <div class="container-fluid h-100">
        <div class="row h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-8 align-self-end mb-4 page-title">
                <h3 class="text-white"><b>Notices</b></h3>
                <hr class="divider my-4" />
            </div>
        </div>
    </div>
</header>
<div class="container mt-3 pt-2">
    <?php
    $notices = $conn->query("SELECT * FROM notices ORDER BY date_created DESC");
    while($row = $notices->fetch_assoc()):
    ?>
    <div class="card notice" data-id="<?php echo $row['id'] ?>">
        <div class="card-body">
            <div class="row align-items-center justify-content-center text-center h-100">
                <div class="">
                    <h3><b><?php echo ucwords($row['title']) ?></b></h3>
                    <p><?php echo strip_tags($row['description']) ?></p>
                    <small><?php echo date("F j, Y, g:i a", strtotime($row['date_created'])) ?></small>
                </div>
            </div>
        </div>
    </div>
    <br>
    <?php endwhile; ?>
</div>
