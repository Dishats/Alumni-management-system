<?php 
include 'admin/db_connect.php'; 
?>
<style>
#portfolio .img-fluid{
    width: calc(100%);
    height: 30vh;
    z-index: -1;
    position: relative;
    padding: 1em;
}
.event-list{
cursor: pointer;
}
span.hightlight{
    background: yellow;
}
.banner{
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 26vh;
        width: calc(30%);
    }
    .banner img{
        width: calc(100%);
        height: calc(100%);
        cursor :pointer;
    }
.event-list{
cursor: pointer;
border: unset;
flex-direction: inherit;
}

.event-list .banner {
    width: calc(40%)
}
.event-list .card-body {
    width: calc(60%)
}
.event-list .banner img {
    border-top-left-radius: 5px;
    border-bottom-left-radius: 5px;
    min-height: 50vh;
}
span.hightlight{
    background: yellow;
}
.banner{
   min-height: calc(100%)
}

/* social media style*/
.sticky-container{
    padding:0px;
    margin:0px;
    position:fixed;
    right:-130px;
    top:230px;
    width:210px;
    z-index: 1100;
}
.sticky li{
    list-style-type:none;
    background-color:#fff;
    color:#efefef;
    height:43px;
    padding:0px;
    margin:0px 0px 1px 0px;
    -webkit-transition:all 0.25s ease-in-out;
    -moz-transition:all 0.25s ease-in-out;
    -o-transition:all 0.25s ease-in-out;
    transition:all 0.25s ease-in-out;
    cursor:pointer;
}
.sticky li:hover{
    margin-left:-115px;
}
.sticky li img{
    float:left;
    margin:5px 4px;
    margin-right:5px;
}
.sticky li p{
    padding-top:5px;
    margin:0px;
    line-height:16px;
    font-size:11px;
}
.sticky li p a{
    text-decoration:none;
    color:#2C3539;
}
.sticky li p a:hover{
    text-decoration:underline;
}

/* Container styles */
.scrolling-text-container {
    background-color: #eff5ff;
    border-radius: 4px;
    overflow: hidden;
}

/* Inner container styles */
.scrolling-text-inner {
    display: flex;
    white-space: nowrap;
    font-size: 16px;
    font-weight: 600;
    padding: 8px 0;
}

/* Text styles */
.scrolling-text {
    display: flex;
}

.scrolling-text-item {
    padding: 0 30px;
}

/* Apply the animation to the text items */
.scrolling-text-inner>div {
    animation: var(--direction) var(--marquee-speed) linear infinite;
}

/* Pause the animation when a user hovers over it */
.scrolling-text-container:hover .scrolling-text-inner>div {
    animation-play-state: paused;
}

/* Setting the Animation using Keyframes */
@keyframes scroll-left {
    0% {
        transform: translateX(100%);
    }

    100% {
        transform: translateX(-100%);
    }
}

@keyframes scroll-right {
    0% {
        transform: translateX(-100%);
    }

    100% {
        transform: translateX(100%);
    }
}
</style>

        <header class="masthead">
            <!--this is scrolling divv-->
                                                  <div class="scrolling-text-container">
    <div class="scrolling-text-inner" style="--marquee-speed: 10s; --direction:scroll-left" role="marquee">
        <div class="scrolling-text">
            <div class="scrolling-text-item"> Check out our social media pages </div>
            <div class="scrolling-text-item"> Do participate in HACKMANIA </div>
            <div class="scrolling-text-item"> To get more information login to our page </div>
            
            <!-- Add More Items Here -->
        </div>
    </div>
</div>
<!-- finished here-->


            <div class="container-fluid h-100">
                <div class="row h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-8 align-self-end mb-4 page-title">
                    	<h1 class="text-uppercase text-white font-weight-bold">Welcome To <?php echo $_SESSION['system']['name']; ?></h1>
                        <hr class="divider my-4" />
                        

                    <div class="col-md-12 mb-2 justify-content-center">
                    </div>                        
                    </div>
 
       
                    
                </div>
            </div>

        </header>
      <div class="container mt-3 pt-2">
                <h4 class="text-center text-white">Upcoming Events</h4>
                <hr class="divider">
                <?php
                $event = $conn->query("SELECT * FROM events where date_format(schedule,'%Y-%m%-d') >= '".date('Y-m-d')."' order by unix_timestamp(schedule) asc");
                while($row = $event->fetch_assoc()):
                    $trans = get_html_translation_table(HTML_ENTITIES,ENT_QUOTES);
                    unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
                    $desc = strtr(html_entity_decode($row['content']),$trans);
                    $desc=str_replace(array("<li>","</li>"), array("",","), $desc);
                ?>
                <div class="card event-list" data-id="<?php echo $row['id'] ?>">
                     <div class='banner'>
                        <?php if(!empty($row['banner'])): ?>
                            <img src="admin/assets/uploads/<?php echo($row['banner']) ?>" alt="">
                        <?php endif; ?>
                    </div>
                    <div class="card-body">
                        <div class="row  align-items-center justify-content-center text-center h-100">
                            <div class="">
                                <h3><b class="filter-txt"><?php echo ucwords($row['title']) ?></b></h3>
                                <div><small><p><b><i class="fa fa-calendar"></i> <?php echo date("F d, Y h:i A",strtotime($row['schedule'])) ?></b></p></small></div>
                                <hr>
                                <larger class="truncate filter-txt"><?php echo strip_tags($desc) ?></larger>
                                <br>
                                <hr class="divider"  style="max-width: calc(80%)">
                                <button class="btn btn-primary float-right read_more" data-id="<?php echo $row['id'] ?>">Read More</button>
                            </div>
                        </div>
                        

                    </div>
                </div>
                <br>
                 <div class="sticky-container">
                    <ul class="sticky">
        <li>
            <img src="/alumni/images/facebook-circle.png" width="32" height="32">
            <p><a href="https://www.facebook.com/pesce1962/" target="_blank">Like Us on<br>Facebook</a></p>
        </li>
        <li>
            <img src="/alumni/images/twitter-circle.png" width="32" height="32">
            <p><a href="https://twitter.com/pesce1962" target="_blank">Follow Us on<br>Twitter</a></p>
        </li>
        <li>
            <img src="/alumni/images/download.jpg" width="32" height="32">
            <p><a href="https://www.instagram.com/pesmandya/" target="_blank">Follow Us on<br>Instagram</a></p>
        </li>
        <li>
            <img src="/alumni/images/linkedin-circle.png" width="32" height="32">
            <p><a href="https://in.linkedin.com/school/pes-college-of-engineering/" target="_blank">Follow Us on<br>LinkedIn</a></p>
        </li>
        <li>
            <img src="/alumni/images/youtube-circle.png" width="32" height="32">
            <p><a href="http://https://www.youtube.com/@pescemandya4660" target="_blank">Subscribe on<br>YouYube</a></p>
        </li>
        
    </ul>

    
</div>
                <?php endwhile; ?>
                
            </div>


<script>
     $('.read_more').click(function(){
         location.href = "index.php?page=view_event&id="+$(this).attr('data-id')
     })
     $('.banner img').click(function(){
        viewer_modal($(this).attr('src'))
    })
    $('#filter').keyup(function(e){
        var filter = $(this).val()

        $('.card.event-list .filter-txt').each(function(){
            var txto = $(this).html();
            txt = txto
            if((txt.toLowerCase()).includes((filter.toLowerCase())) == true){
                $(this).closest('.card').toggle(true)
            }else{
                $(this).closest('.card').toggle(false)
               
            }
        })
    })
</script>