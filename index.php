<!DOCTYPE html>
<html lang="en">
    <?php
    session_start();
    include('admin/db_connect.php');
    ob_start();
        $query = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
         foreach ($query as $key => $value) {
          if(!is_numeric($key))
            $_SESSION['system'][$key] = $value;
        }
    ob_end_flush();
    include('header.php');

  
    ?>
    

    <style>
      header.masthead {
      background: url(admin/assets/uploads/<?php echo $_SESSION['system']['cover_img'] ?>);
      background-repeat: no-repeat;
      background-size: cover;
    }

    
  #viewer_modal .btn-close {
    position: absolute;
    z-index: 999999;
    /right: -4.5em;/
    background: unset;
    color: white;
    border: unset;
    font-size: 27px;
    top: 0;
}
#viewer_modal .modal-dialog {
        width: 80%;
    max-width: unset;
    height: calc(90%);
    max-height: unset;
}
  #viewer_modal .modal-content {
       background: black;
    border: unset;
    height: calc(100%);
    display: flex;
    align-items: center;
    justify-content: center;
  }
  #viewer_modal img,#viewer_modal video{
    max-height: calc(100%);
    max-width: calc(100%);
  }
  body, footer {
    background: #000000e6 !important;
}
 

a.jqte_tool_label.unselectable {
    height: auto !important;
    min-width: 4rem !important;
    padding:5px
}/*
a.jqte_tool_label.unselectable {
    height: 22px !important;
}*/
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

    </style>
    <body id="page-top">
        <!-- Navigation-->
        <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body text-white">
        </div>
      </div>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
            <div class="container">
                 <img src="/alumni/images/logo.jpeg" width="40" height="40">
                <a class="navbar-brand js-scroll-trigger" href="./"><?php echo $_SESSION['system']['name'] ?></a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto my-2 my-lg-0">
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=home">Home</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=about">About</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=alumni_list">Alumni</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=gallery">Gallery</a></li>
                        <?php if(isset($_SESSION['login_id'])): ?>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=careers">Jobs</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=forum">journals</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=alerts">Notices</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=fundings">Fundings</a></li>
                        <?php endif; ?>
                        
                        <?php if(!isset($_SESSION['login_id'])): ?>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#" id="login">Login</a></li>
                        <?php else: ?>
                        <li class="nav-item">
                          <div class=" dropdown mr-4">
                              <a href="#" class="nav-link js-scroll-trigger"  id="account_settings" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['login_name'] ?> <i class="fa fa-angle-down"></i></a>
                                <div class="dropdown-menu" aria-labelledby="account_settings" style="left: -2.5em;">
                                  <a class="dropdown-item" href="index.php?page=my_account" id="manage_my_account"><i class="fa fa-cog"></i> Manage Account</a>
                                  <a class="dropdown-item" href="admin/ajax.php?action=logout2"><i class="fa fa-power-off"></i> Logout</a>
                                </div>
                          </div>
                        </li>
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
       <!-- <li>
            <img src="/alumni/images/whatsapp-circle.png" width="32" height="32">
            <p><a href="http://https://www.youtube.com/@pescemandya4660" target="_blank">Subscribe on<br>YouYube</a></p>
        </li>-->
        
    </ul>


                       
                        <?php endif; ?>
                        
                     
                    </ul>
                </div>
            </div>
        </nav>
       
        <?php 
        $page = isset($_GET['page']) ?$_GET['page'] : "home";
        include $page.'.php';
        ?>
       

<div class="modal fade" id="confirm_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Confirmation</h5>
      </div>
      <div class="modal-body">
        <div id="delete_content"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='confirm' onclick="">Continue</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal_right" role='dialog'>
    <div class="modal-dialog modal-full-height  modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span class="fa fa-arrow-righ t"></span>
        </button>
      </div>
      <div class="modal-body">
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="viewer_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">

              <button type="button" class="btn-close" data-dismiss="modal"><span class="fa fa-times"></span></button>
               <a
               class='carousel-control-prev'
               href='#carouselExampleIndicators'
               role='button'
               data-slide='prev'
               >



              <span class='carousel-control-prev-icon'
                    aria-hidden='true'
                    ></span>
              <span class='sr-only'>Previous</span>
            </a>
            <a
               class='carousel-control-next'
               href='#carouselExampleIndicators'
               role='button'
               data-slide='next'
               >
              <span
                    class='carousel-control-next-icon'
                    aria-hidden='true'
                    ></span>
              <span class='sr-only'>Next</span>
            </a>
              <img src="" alt="">
      </div>
    </div>
  </div>
  <div id="preloader"></div>
  
        <footer class=" py-5">
            <div class="container">

                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center">
                        <!-- new code for college footer -->
                         <img src="/alumni/images/peslogo.png" width="300" height="60">
                         <div class="container"><a> <span style="color: #FFFFFF">PES College of Engineering,
                            <br>
PES Engineering College Road,
<br>
Mandya, Karnataka - 571 401.</span></a> </div>
<hr>
                        <h2 class="mt-0 text-white">Contact us</h2>
                        <hr class="divider my-4" />
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-4 ml-auto text-center mb-5 mb-lg-0">
                        <i class="fas fa-phone fa-3x mb-3 text-muted"></i>
                        <div class="text-white"><?php echo $_SESSION['system']['contact'] ?></div>
                    </div>
                    <div class="col-lg-4 mr-auto text-center">
                        <i class="fas fa-envelope fa-3x mb-3 text-muted"></i>
                        <!-- Make sure to change the email address in BOTH the anchor text and the link target below!-->
                        <a class="d-block" href="mailto:<?php echo $_SESSION['system']['email'] ?>"><?php echo $_SESSION['system']['email'] ?></a>
                       

                    </div>
                </div>
            </div>
            <br>
            <div class="container"><div class="small text-center text-muted">Copyright © 2024- <?php echo $_SESSION['system']['name'] ?> | <a >Phoenix</a></div></div>
        </footer>
        <div class="container"><div class="small text-center"> 
       <!-- <a><span style="color: #FFFFFF">Visitors</span></a>
          <a href='http://www.freevisitorcounters.com' span style="color: #000000">at freevisitorcounters.com</a> <script type='text/javascript' src='https://www.freevisitorcounters.com/auth.php?id=6d74c43d5f189f7ea969d17948feeb861b715e37'></script>
<script type="text/javascript" src="https://www.freevisitorcounters.com/en/home/counter/1122212/t/2"></script> -->
        </div></div>
       <?php include('footer.php') ?>
    </body>
    <script type="text/javascript">
      $('#login').click(function(){
        uni_modal("Login",'login.php')
      })

       $('#viewer_modal .carousel-control-next').click(function(){
        //alert('you clicked me next')
       // viewer_modal($(this).attr('src'))
    })
        $('#viewer_modal .carousel-control-prev').click(function(){
        
         var   src= './admin/assets/uploads/gallery/2_img.jpg'
          //   viewer_modal('../admin/assets/uploads/gallery/1_img.jpg')
                //viewer_modal($(this).attr('src'))
    })
    </script>
    <?php $conn->close() ?>

</html>