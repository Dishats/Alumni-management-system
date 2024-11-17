<?php 
include 'admin/db_connect.php'; 
?>
<style>
/* Your existing CSS code */

/* Existing CSS, update as needed */

/* Card Styling */
.alumni-list {
    transition: transform 0.2s, box-shadow 0.2s;
    margin-bottom: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.alumni-list:hover {
    transform: scale(1.05);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
}

/* Image Styling */
/* Adjusted Image Styling for Smaller, Oval Shape */
.alumni-img img {
    width: 120px; /* Smaller width */
    height: 120px; /* Smaller height */
    object-fit: cover;
    border-radius: 50%; /* Oval shape */
    margin: 10px auto; /* Center alignment */
    display: block;
    border: 3px solid #007bff; /* Optional border for added emphasis */
}


/* Card Body Styling */
.card-body {
    padding: 20px;
    background: #f8f9fa;
    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 10px;
}

.card-body .filter-txt {
    margin-bottom: 5px;
    font-size: 0.9em;
    color: #495057;
}

.card-body .filter-txt b {
    color: #007bff;
}

/* Heading Styling */
.masthead h1 {
    font-size: 3rem;
    letter-spacing: 0.1em;
    margin-bottom: 10px;
}

.masthead hr {
    width: 80px;
    border-top: 3px solid #fff;
}

/* Filter Input Styling */
.input-group .input-group-text {
    background-color: #007bff;
    color: white;
    border: none;
}

.input-group .form-control {
    border: none;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.btn-primary {
    background-color: #007bff;
    border: none;
}

/* Card Layout Adjustments */
.row-items .col-md-4 {
    display: flex;
    align-items: stretch;
}

.row-items .item {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}
</style>



<header class="masthead">
    <div class="container-fluid h-100">
        <div class="row h-100 align-items-center justify-content-center text-center">
        <div class="col-lg-10 align-self-end mb-4" ;>
                <h1 class="text-uppercase text-white font-weight-bold">ALUMNI LIST</h1>
                <hr class="divider my-4" />
            </div>
        </div>
    </div>
</header>

<div class="container">
    <div class="card mb-4 mt-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="filter-field"><i class="fa fa-search"></i></span>
                        </div>
                        <input type="text" class="form-control" id="filter" placeholder="Filter name, course, etc." aria-label="Filter" aria-describedby="filter-field">
                    </div>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-primary btn-block btn-sm" id="search">Search</button>
                </div>
            </div>
        </div>
    </div>
</div>	

<div class="container-fluid mt-3 pt-2">
    <div class="row-items">
        <div class="col-lg-12">
            <div class="row">
                <?php
                $fpath = 'admin/assets/uploads';
                $alumni = $conn->query("SELECT a.*, c.course, Concat(a.lastname, ' ', a.firstname, ' ', a.middlename) AS name 
                                        FROM alumnus_bio a 
                                        INNER JOIN courses c ON c.id = a.course_id 
                                        ORDER BY Concat(a.lastname, ' ', a.firstname, ' ', a.middlename) ASC");
                while ($row = $alumni->fetch_assoc()):
                ?>
                <div class="col-md-4 item">
                    <div class="card alumni-list" data-id="<?php echo $row['id'] ?>">
                        <div class="alumni-img" card-img-top>
                            <img src="<?php echo $fpath . '/' . $row['avatar'] ?>" alt="">
                        </div>
                        <div class="card-body">
                            <div class="row align-items-center h-100">
                                <div class="">
                                    <div>
                                        <p class="filter-txt"><b><?php echo $row['name'] ?></b></p>
                                        <hr class="divider w-100" style="max-width: calc(100%)">
                                        <p class="filter-txt">Email: <b><?php echo $row['email'] ?></b></p>
                                        <p class="filter-txt">Course: <b><?php echo $row['course'] ?></b></p>
                                        <p class="filter-txt">Batch: <b><?php echo $row['batch'] ?></b></p>
                                        <p class="filter-txt">LinkedIn: <b><a href="<?php echo $row['linkedin'] ?>" target="_blank"><?php echo $row['linkedin'] ?></a></b></p>
                                        <p class="filter-txt">Mentorship Domain: <b><?php echo $row['mentorship_domain'] ?></b></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</div>

<script>
    $('.book-alumni').click(function(){
        uni_modal("Submit Booking Request", "booking.php?alumni_id=" + $(this).attr('data-id'));
    });
    $('.alumni-img img').click(function(){
        viewer_modal($(this).attr('src'));
    });
    $('#filter').keypress(function(e){
        if(e.which == 13)
            $('#search').trigger('click');
    });
    $('#search').click(function(){
        var txt = $('#filter').val();
        start_load();
        if(txt == ''){
            $('.item').show();
            end_load();
            return false;
        }
        $('.item').each(function(){
            var content = "";
            $(this).find(".filter-txt").each(function(){
                content += ' ' + $(this).text();
            });
            if((content.toLowerCase()).includes(txt.toLowerCase()) == true){
                $(this).toggle(true);
            } else {
                $(this).toggle(false);
            }
        });
        end_load();
    });
</script>
