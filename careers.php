<?php 
include 'admin/db_connect.php'; 
?>
<style>
/* CSS styling */
#portfolio .img-fluid {
    width: calc(100%);
    height: 30vh;
    z-index: -1;
    position: relative;
    padding: 1em;
}
.gallery-list {
    cursor: pointer;
    border: unset;
    flex-direction: inherit;
}
.gallery-img, .gallery-list .card-body {
    width: calc(50%);
}
.gallery-img img {
    border-radius: 5px;
    min-height: 50vh;
    max-width: calc(100%);
}
span.hightlight {
    background: yellow;
}
.carousel, .carousel-inner, .carousel-item {
    min-height: calc(100%);
}
header.masthead, header.masthead:before {
    min-height: 50vh !important;
    height: 50vh !important;
}
.row-items {
    position: relative;
}
.masthead {
    min-height: 23vh !important;
    height: 23vh !important;
}
.masthead:before {
    min-height: 23vh !important;
    height: 23vh !important;
}
</style>

<header class="masthead">
    <div class="container-fluid h-100">
        <div class="row h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-8 align-self-end mb-4 page-title">
                <h3 class="text-white">Job List</h3>
                <hr class="divider my-4" />
                <div class="row col-md-12 mb-2 justify-content-center">
                    <button class="btn btn-primary btn-block col-sm-4" type="button" id="new_career"><i class="fa fa-plus"></i> Post a Job Opportunity</button>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="container mt-3 pt-2">
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="filter-field"><i class="fa fa-search"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Filter" id="filter" aria-label="Filter" aria-describedby="filter-field">
                    </div>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-primary btn-block btn-sm" id="search">Search</button>
                </div>
            </div>
        </div>
    </div>

    <?php
    $event = $conn->query("SELECT c.*, u.name FROM careers c INNER JOIN users u ON u.id = c.user_id ORDER BY id DESC");
    while($row = $event->fetch_assoc()):
        $trans = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);
        unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
        $desc = strtr(html_entity_decode($row['description']), $trans);
        $desc = str_replace(array("<li>", "</li>"), array("", ","), $desc);
    ?>
    <div class="card job-list" data-id="<?php echo $row['id'] ?>">
        <div class="card-body">
            <div class="row align-items-center justify-content-center text-center h-100">
                <div class="">
                    <h3><b class="filter-txt"><?php echo ucwords($row['job_title']) ?></b></h3>
                    <div>
                        <span class="filter-txt"><small><b><i class="fa fa-building"></i> <?php echo ucwords($row['company']) ?></b></small></span>
                        <span class="filter-txt"><small><b><i class="fa fa-map-marker"></i> <?php echo ucwords($row['location']) ?></b></small></span>
                    </div>
                    <hr>
                    <larger class="truncate filter-txt"><?php echo strip_tags($desc) ?></larger>
                    <br>
                    <hr class="divider" style="max-width: calc(80%)">
                    <span class="badge badge-info float-left px-3 pt-1 pb-1">
                        <b><i>Posted by: <?php echo $row['name'] ?></i></b>
                    </span>
                    <button class="btn btn-primary float-right read_more" data-id="<?php echo $row['id'] ?>">Read More</button>
                    <button class="btn btn-secondary float-right message-admin mr-2" data-id="<?php echo $row['id'] ?>">Message Admin</button>
                </div>
            </div>
        </div>
    </div>
    <br>
    <?php endwhile; ?>
</div>

<!-- Modal for Messaging Admin -->
<div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="messageModalLabel">Message Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="messageForm">
                    <div class="form-group">
                        <label for="userName">Name</label>
                        <input type="text" class="form-control" id="userName" required>
                    </div>
                    <div class="form-group">
                        <label for="userEmail">Email</label>
                        <input type="email" class="form-control" id="userEmail" required>
                    </div>
                    <div class="form-group">
                        <label for="userPhone">Phone Number</label>
                        <input type="text" class="form-control" id="userPhone" required>
                    </div>
                    <div class="form-group">
                        <label for="userMessage">Message</label>
                        <textarea class="form-control" id="userMessage" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Handle message form submission with AJAX
$('#messageForm').submit(function(e) {
    e.preventDefault(); // Prevent the default form submission

    var data = {
        job_id: $('.message-admin').data('id'), // Get job ID from the button clicked
        name: $('#userName').val(),
        email: $('#userEmail').val(),
        phone: $('#userPhone').val(),
        message: $('#userMessage').val()
    };

    $.ajax({
        url: 'save_message.php', // The URL to your PHP script that handles the message saving
        type: 'POST', // Use POST to send data
        dataType: 'json', // Expect JSON response
        data: data, // The data to send
        success: function(response) {
            if (response.status === 'success') {
                alert(response.message); // Show success message
                $('#messageModal').modal('hide'); // Hide the modal
                $('#messageForm')[0].reset(); // Reset the form after submission
            } else {
                alert(response.message); // Show error message
            }
        },
        error: function() {
            alert('An error occurred. Please try again later.'); // Handle error
        }
    });
});
// Handle "Message Admin" button click
$('.message-admin').click(function() {
    var jobId = $(this).attr('data-id'); // Get job ID
    $('#messageForm').data('job-id', jobId); // Store job ID in the form's data attribute
    $('#messageModal').modal('show'); // Show the modal
});
var data = {
    job_id: $('#messageForm').data('job-id'), // Get job ID from the form's data attribute
    name: $('#userName').val(),
    email: $('#userEmail').val(),
    phone: $('#userPhone').val(),
    message: $('#userMessage').val()
};

</script>
