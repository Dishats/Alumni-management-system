<?php include 'db_connect.php' ?>
<style>
   /* span.float-right.summary_icon {
    font-size: 3rem;
    position: absolute;
    right: 1rem;
    color: #ffffff96;
}
.imgs{
		margin: .5em;
		max-width: calc(100%);
		max-height: calc(100%);
	}
	.imgs img{
		max-width: calc(100%);
		max-height: calc(100%);
		cursor: pointer;
	}
	#imagesCarousel,#imagesCarousel .carousel-inner,#imagesCarousel .carousel-item{
		height: 60vh !important;background: black;
	}
	#imagesCarousel .carousel-item.active{
		display: flex !important;
	}
	#imagesCarousel .carousel-item-next{
		display: flex !important;
	}
	#imagesCarousel .carousel-item img{
		margin: auto;
	}
	#imagesCarousel img{
		width: auto!important;
		height: auto!important;
		max-height: calc(100%)!important;
		max-width: calc(100%)!important;
	} */
    span.float-right.summary_icon {
    font-size: 3rem;
    position: absolute;
    right: 1rem;
    color: #ffffff96;
}

/* Styling for images */
.imgs {
    margin: .5em;
    max-width: calc(100%);
    max-height: calc(100%);
}
.imgs img {
    max-width: calc(100%);
    max-height: calc(100%);
    cursor: pointer;
}

/* Carousel styles */
#imagesCarousel, #imagesCarousel .carousel-inner, #imagesCarousel .carousel-item {
    height: 60vh !important;
    background: black;
}
#imagesCarousel .carousel-item.active, #imagesCarousel .carousel-item-next {
    display: flex !important;
}
#imagesCarousel .carousel-item img {
    margin: auto;
}
#imagesCarousel img {
    width: auto !important;
    height: auto !important;
    max-height: calc(100%) !important;
    max-width: calc(100%) !important;
}

/* Card styling */
.card-body {
    position: relative;
    border-radius: 10px;
    padding: 1.5em;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

/* Hover effect on inner cards */
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 15px rgba(0, 0, 0, 0.2);
}

/* Individual card styles */
.bg-primary {
    background-color: #007bff !important;
}

.bg-info {
    background-color: #17a2b8 !important;
}

.bg-warning {
    background-color: #ffc107 !important;
}

/* Text color inside cards */
.card-body.text-white {
    color: white;
}

/* For better responsiveness */
@media (max-width: 768px) {
    .card-body {
        padding: 1em;
    }
}
</style>

<div class="containe-fluid">
	<div class="row mt-3 ml-3 mr-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <?php echo "Welcome back ". $_SESSION['login_name']."!"  ?>
                    <hr>
                    <div class="row">
                        <!-- <div class="col-md-3">
                            <div class="card">
                                <div class="card-body bg-primary">
                                    <div class="card-body text-white">
                                        <span class="float-right summary_icon"><i class="fa fa-users"></i></span>
                                        <h4><b>
                                            <?php echo $conn->query("SELECT * FROM alumnus_bio where status = 1")->num_rows; ?>
                                        </b></h4>
                                        <p><b>Alumni</b></p>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <!-- new alumni -->
                        <div class="col-md-3">
    <div class="card" id="alumni-card" style="cursor: pointer;">
        <div class="card-body bg-primary">
            <div class="card-body text-white">
                <span class="float-right summary_icon"><i class="fa fa-users"></i></span>
                <h4><b>
                    <?php echo $conn->query("SELECT * FROM alumnus_bio where status = 1")->num_rows; ?>
                </b></h4>
                <p><b>Alumni</b></p>
            </div>
        </div>
    </div>
</div>

                         <!-- new end -->
                        <!-- <div class="col-md-3">
                            <div class="card">
                                <div class="card-body bg-info">
                                    <div class="card-body text-white">
                                        <span class="float-right summary_icon"><i class="fa fa-comments"></i></span>
                                        <h4><b>
                                            <?php echo $conn->query("SELECT * FROM forum_topics")->num_rows; ?>
                                        </b></h4>
                                        <p><b>Publications</b></p>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="col-md-3">
    <div class="card" id="publications-card" style="cursor: pointer;">
        <div class="card-body bg-info">
            <div class="card-body text-white">
                <span class="float-right summary_icon"><i class="fa fa-comments"></i></span>
                <h4><b>
                    <?php echo $conn->query("SELECT * FROM forum_topics")->num_rows; ?>
                </b></h4>
                <p><b>Publications</b></p>
            </div>
        </div>
    </div>
</div>

                        <!-- <div class="col-md-3">
                            <div class="card">
                                <div class="card-body bg-warning">
                                    <div class="card-body text-white">
                                        <span class="float-right summary_icon"><i class="fa fa-briefcase"></i></span>
                                        <h4><b>
                                            <?php echo $conn->query("SELECT * FROM careers")->num_rows; ?>
                                        </b></h4>
                                        <p><b>Posted jobs</b></p>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                        <div class="col-md-3">
    <div class="card" id="jobs-card" style="cursor: pointer;">
        <div class="card-body bg-warning">
            <div class="card-body text-white">
                <span class="float-right summary_icon"><i class="fa fa-briefcase"></i></span>
                <h4><b>
                    <?php echo $conn->query("SELECT * FROM careers")->num_rows; ?>
                </b></h4>
                <p><b>Posted jobs</b></p>
            </div>
        </div>
    </div>
</div>
                        <!-- <div class="col-md-3">
                            <div class="card">
                                <div class="card-body bg-primary">
                                    <div class="card-body text-white">
                                        <span class="float-right summary_icon"><i class="fa fa-calendar-day"></i></span>
                                        <h4><b>
                                            <?php echo $conn->query("SELECT * FROM events where date_format(schedule,'%Y-%m%-d') >= '".date('Y-m-d')."' ")->num_rows; ?>
                                        </b></h4>
                                        <p><b> Events</b></p>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                        <div class="col-md-3">
    <div class="card" id="events-card" style="cursor: pointer;">
        <div class="card-body bg-primary">
            <div class="card-body text-white">
                <span class="float-right summary_icon"><i class="fa fa-calendar-day"></i></span>
                <h4><b>
                    <?php echo $conn->query("SELECT * FROM events")->num_rows; ?>
                </b></h4>
                <p><b>Events</b></p>
            </div>
        </div>
    </div>
</div>


                    </div>	

                    
                </div>
            </div>      			
        </div>
    </div>
</div>

<!-- extra extra  -->
 <!-- Modal Structure for Alumni Branch Details -->
<div class="modal fade" id="alumniModal" tabindex="-1" role="dialog" aria-labelledby="alumniModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="alumniModalLabel">Alumni Count by Branches</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="alumni-branch-details">
        <!-- Alumni branch details will be loaded here -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Structure for Publications Details -->
<div class="modal fade" id="publicationsModal" tabindex="-1" role="dialog" aria-labelledby="publicationsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="publicationsModalLabel">Publications Count and Authors</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="publications-details">
                <!-- Publications details will be loaded here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Structure for Jobs Posted Details -->
<div class="modal fade" id="jobsModal" tabindex="-1" role="dialog" aria-labelledby="jobsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="jobsModalLabel">Jobs Posted Count and Authors</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="jobs-details">
                <!-- Jobs details will be loaded here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Structure for Event Details -->
<div class="modal fade" id="eventsModal" tabindex="-1" role="dialog" aria-labelledby="eventsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventsModalLabel">Event Details and Participation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="events-details">
                <!-- Event details will be loaded here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>






 <!-- extra end -->
<script>
	$('#manage-records').submit(function(e){
        e.preventDefault()
        start_load()
        $.ajax({
            url:'ajax.php?action=save_track',
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            success:function(resp){
                resp=JSON.parse(resp)
                if(resp.status==1){
                    alert_toast("Data successfully saved",'success')
                    setTimeout(function(){
                        location.reload()
                    },800)

                }
                
            }
        })
    })
    $('#tracking_id').on('keypress',function(e){
        if(e.which == 13){
            get_person()
        }
    })
    $('#check').on('click',function(e){
            get_person()
    })
    function get_person(){
            start_load()
        $.ajax({
                url:'ajax.php?action=get_pdetails',
                method:"POST",
                data:{tracking_id : $('#tracking_id').val()},
                success:function(resp){
                    if(resp){
                        resp = JSON.parse(resp)
                        if(resp.status == 1){
                            $('#name').html(resp.name)
                            $('#address').html(resp.address)
                            $('[name="person_id"]').val(resp.id)
                            $('#details').show()
                            end_load()

                        }else if(resp.status == 2){
                            alert_toast("Unknow tracking id.",'danger');
                            end_load();
                        }
                    }
                }
            })
    }

    // extra script

    
$(document).ready(function() {
    // On click of the Alumni card, trigger the modal
    $('#alumni-card').on('click', function() {
        // Show loading text while fetching data
        $('#alumni-branch-details').html('Loading...');
        // Fetch alumni count by branches
        $.ajax({
            url: 'fetch_alumni_by_branch.php',  // PHP file to fetch data
            method: 'GET',
            success: function(response) {
                // Insert the response into the modal body
                $('#alumni-branch-details').html(response);
                // Open the modal
                $('#alumniModal').modal('show');
            },
            error: function() {
                $('#alumni-branch-details').html('An error occurred while fetching data.');
            }
        });
    });
});

// for publication pop up 
$(document).ready(function() {
    // On click of the Publications card, trigger the modal
    $('#publications-card').on('click', function() {
        // Show loading text while fetching data
        $('#publications-details').html('Loading...');
        // Fetch publication count and authors
        $.ajax({
            url: 'fetch_publications.php',  // PHP file to fetch data
            method: 'GET',
            success: function(response) {
                // Insert the response into the modal body
                $('#publications-details').html(response);
                // Open the modal
                $('#publicationsModal').modal('show');
            },
            error: function() {
                $('#publications-details').html('An error occurred while fetching data.');
            }
        });
    });
});
$(document).ready(function() {
    // On click of the Jobs card, trigger the modal
    $('#jobs-card').on('click', function() {
        // Show loading text while fetching data
        $('#jobs-details').html('Loading...');
        // Fetch job count and authors
        $.ajax({
            url: 'fetch_jobs.php',  // PHP file to fetch data
            method: 'GET',
            success: function(response) {
                // Insert the response into the modal body
                $('#jobs-details').html(response);
                // Open the modal
                $('#jobsModal').modal('show');
            },
            error: function() {
                $('#jobs-details').html('An error occurred while fetching data.');
            }
        });
    });
});

$(document).ready(function() {
    // On click of the Events card, trigger the modal
    $('#events-card').on('click', function() {
        // Show loading text while fetching data
        $('#events-details').html('Loading...');
        // Fetch event details and participant counts
        $.ajax({
            url: 'fetch_events.php',  // PHP file to fetch data
            method: 'GET',
            success: function(response) {
                // Insert the response into the modal body
                $('#events-details').html(response);
                // Open the modal
                $('#eventsModal').modal('show');
            },
            error: function() {
                $('#events-details').html('An error occurred while fetching data.');
            }
        });
    });
});



    // ends
</script>