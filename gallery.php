<?php 
include 'admin/db_connect.php'; 
?>
<style>
<style>
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

.gallery-img img {
    border-radius: 5px;
    min-height: 50vh;
    max-width: calc(100%);
    transition: transform 0.3s ease, opacity 0.3s ease; /* Add transition */
}

span.highlight {
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

.card-left {
    left: 0;
}

.card-right {
    right: 0;
}

.rtl {
    direction: rtl;
}

.gallery-text {
    justify-content: center;
    align-items: center;
}

.masthead {
    min-height: 23vh !important;
    height: 23vh !important;
}

.masthead:before {
    min-height: 23vh !important;
    height: 23vh !important;
}

/* New code for image alignment */
.carousel-item > img {
    position: static;
    top: 50%;
    left: 50%;
    min-width: 50%;
    height: 40rem;
    margin: 0 auto;
}

/* Hover effect for gallery and carousel images */
.gallery-img img:hover, 
.carousel-item img:hover {
    opacity: 0.8; /* Change opacity on hover */
    transform: scale(1.05); /* Slightly scale up the image */
    transition: transform 0.3s ease, opacity 0.3s ease; /* Smooth transition */
}
</style>


</style>
        <header class="masthead">
            <div class="container-fluid h-100">
                <div class="row h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-8 align-self-end mb-4 page-title">
                    <h1 class="text-uppercase text-white font-weight-bold">GALLERY</h1>
                        <hr class="divider my-4" />
                    <div class="col-md-12 mb-2 justify-content-center">
                    </div>                        
                    </div>                   
                </div>
            </div>
        </header>
                <!--<div class="container">
                <div class="card mb-4 mt-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="filter-field"><i class="fa fa-search"></i></span>
                              </div>
                              <input type="text" class="form-control" id="filter" placeholder="Filter dates,events etc.." aria-label="Filter" aria-describedby="filter-field">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-primary btn-block btn-sm" id="search">Search</button>
                        </div>
                    </div>
                    
                </div>
            </div>
            </div>-->
            <div class="container-fluid mt-3 pt-2">
    <div class="row-items">
        <div class="col-lg-12">
            <div class="row">
                <?php
                $rtl = 'rtl';
                $ci = 0;
                $img = array();
                $fpath = 'admin/assets/uploads/gallery';
                $files = is_dir($fpath) ? scandir($fpath) : array();
                foreach ($files as $val) {
                    if (!in_array($val, array('.', '..'))) {
                        $n = explode('_', $val);
                        $img[$n[0]] = $val;
                    }
                }
                $gallery = $conn->query("SELECT * from gallery order by id desc");
                while ($row = $gallery->fetch_assoc()):
                    $ci++;
                    if ($ci < 3) {
                        $rtl = '';
                    } else {
                        $rtl = 'rtl';
                    }
                    if ($ci == 4) {
                        $ci = 0;
                    }
                ?>
                <div class="col-md-4 mb-3"> <!-- Adjust column size here -->
                    <div class="card gallery-list <?php echo $rtl ?>" data-id="<?php echo $row['id'] ?>">
                        <div class="gallery-img">
                            <img src="<?php echo isset($img[$row['id']]) && is_file($fpath . '/' . $img[$row['id']]) ? $fpath . '/' . $img[$row['id']] : '' ?>" alt="" class="img-fluid"> <!-- Added img-fluid class for responsive images -->
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
                </div>
                <br>
                <br><br>
<<!--corousal code starts here -->
    <div>
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-75" src="./admin/assets/uploads/gallery/11_img.jpg"   alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-75" src="./admin/assets/uploads/gallery/38_img.jpg" alt="Second slide">
    </div>
    
    <div class="carousel-item">
      <img class="d-block w-75" src="./admin/assets/uploads/gallery/12_img.jpg" alt="Third slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-75" src="./admin/assets/uploads/gallery/15_img.jpg" alt="Third slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-75" src="./admin/assets/uploads/gallery/17_img.jpg" alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<!--corousal code ends here -->
                </div>
            </div>
            <br>
            <br>
             <br>


<script>
    // $('.card.gallery-list').click(function(){
    //     location.href = "index.php?page=view_gallery&id="+$(this).attr('data-id')
    // })
    $('.book-gallery').click(function(){
        uni_modal("Submit Booking Request","booking.php?gallery_id="+$(this).attr('data-id'))
    })
    $('.gallery-img img').click(function(){
        
        viewer_modal($(this).attr('src'))
    })

</script>