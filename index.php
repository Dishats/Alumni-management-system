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
    
    .masthead {
      position: relative;
      height: 100vh;
      background: url("admin/assets/uploads/<?php echo $_SESSION['system']['cover_img']; ?>") no-repeat center center;
      background-size: cover;
      animation: slideUpDown 8s ease-in-out infinite alternate;
    }

    @keyframes slideUpDown {
      0% {
        background-position: center top;
      }
      100% {
        background-position: center bottom;
      }
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
  body {
    background:#FEF9F2 !important;
}
/* footer{
    background:black;
} */
 

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


/* notification */
/* Modal Header */
.modal-header {
    background-color: #343a40; /* Dark background */
    color: #fff; /* White text */
    border-bottom: 2px solid #007bff; /* Blue border */
}

/* Modal Title */
.modal-title {
    font-weight: bold; /* Bold title */
}

/* Modal Body */
.modal-body {
    background-color: #f8f9fa; /* Light background for the body */
    padding: 15px; /* Padding for body */
}

/* Notification List */
#notification_list {
    max-height: 400px; /* Set a maximum height */
    overflow-y: auto; /* Enable scrolling if content exceeds height */
}

/* Notification Items */
#notification_list li {
    padding: 10px; /* Padding for each notification */
    border: 1px solid #dee2e6; /* Border around each item */
    border-radius: 5px; /* Rounded corners */
    margin-bottom: 10px; /* Space between items */
    background-color: #ffffff; /* White background */
    transition: background-color 0.3s; /* Smooth background transition */
}

/* Hover effect for notification items */
#notification_list li:hover {
    background-color: #e2e6ea; /* Light grey on hover */
}

/* Close Button */
.modal-footer .btn-secondary {
    background-color: #007bff; /* Blue background */
    color: white; /* White text */
}

/* Close Button on Hover */
.modal-footer .btn-secondary:hover {
    background-color: #0056b3; /* Darker blue on hover */
}

span.new-tag {
    color: red;
    font-weight: bold;
}
/* new styel */

/* Navbar Styling */
/* Navbar Styling */
/* Navbar Styling */
.navbar {
    background-color: #789DBC; /* White background for the navbar */
    padding: 15px 20px;
}

.navbar a {
    color: blue; /* Change text color to black */
    font-size: 1rem;
    padding: 10px 20px;
    text-decoration: none;
    position: relative;
}

.navbar a::after {
    content: '';
    position: absolute;
    width: 0;
    height: 2px;
    background-color: #007bff; /* Blue color for hover effect */
    left: 0;
    bottom: 0;
    transition: width 0.3s ease;
}

.navbar a:hover {
    color: #007bff; /* Change text color to blue on hover */
}

.navbar a:hover::after {
    width: 100%; /* Expand the underline effect on hover */
}


/* Notifications Icon Styling */
#notification_icon {
    position: relative;
    cursor: pointer;
    color: #fff;
    font-size: 1.5rem;
    padding: 10px;
    transition: color 0.3s ease;
}

#notification_icon:hover {
    color: #007bff;
}

/* Notification Modal Styling */
.modal-header {
    background-color: #007bff;
    color: #fff;
    border-bottom: 2px solid #0056b3;
}

.modal-title {
    font-weight: bold;
    font-size: 1.5rem;
}

.modal-body {
    background-color: #f1f3f5;
    padding: 20px;
    max-height: 400px;
    overflow-y: auto;
}

.modal-footer {
    background-color: #f1f3f5;
    padding: 15px;
}

.modal-footer .btn-secondary {
    background-color: #007bff;
    border-radius: 25px;
    font-size: 14px;
    padding: 10px 20px;
}

.modal-footer .btn-secondary:hover {
    background-color: #0056b3;
    color: #fff;
}

/* Notification List Styling */
#notification_list {
    background-color: #fff;
    border-radius: 10px;
    padding: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    list-style: none;
    max-height: 400px;
    overflow-y: auto;
}

#notification_list li {
    padding: 15px;
    border-bottom: 1px solid #dee2e6;
    background-color: #ffffff;
    border-radius: 8px;
    margin-bottom: 10px;
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

#notification_list li:hover {
    background-color: #f8f9fa;
    cursor: pointer;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
}

#notification_list li strong {
    font-size: 1rem;
    color: #333;
}

#notification_list li small {
    color: #6c757d;
    font-size: 0.85rem;
}

/* New Notification Tag */
span.new-tag {
    color: #d9534f;
    font-weight: bold;
    font-size: 0.9rem;
    margin-right: 5px;
}
/* new styel */

    </style>
    <body id="page-top">
        <!-- Navigation-->
        <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body text-white">
        </div>
      </div>
      <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav" style="background-color: #007bff;">
    <div class="container">
        <img src="/alumni/images/logoo-removebg-preview.png" width="40" height="40">
        <a class="navbar-brand js-scroll-trigger" href="./" style="color: white;"><?php echo $_SESSION['system']['name'] ?></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto my-2 my-lg-0">
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=home" style="color: white;">Home</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=about" style="color: white;">About</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=alumni_list" style="color: white;">Alumni</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=gallery" style="color: white;">Gallery</a></li>

                <?php if(isset($_SESSION['login_id'])): ?>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=careers" style="color: white;">Jobs</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=forum" style="color: white;">Journals</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=chat_messages" style="color: white;">Chat</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=fundings" style="color: white;">Fundings</a></li>
                <?php endif; ?>

                <?php if(!isset($_SESSION['login_id'])): ?>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#" id="login" style="color: white;">Login</a></li>
                <?php else: ?>
                    <li class="nav-item">
                        <div class="dropdown mr-4">
                            <a href="#" class="nav-link js-scroll-trigger" id="account_settings" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white;">
                                <?php echo $_SESSION['login_name'] ?> <i class="fa fa-angle-down"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="account_settings" style="left: -2.5em;">
                                <a class="dropdown-item" href="index.php?page=my_account" id="manage_my_account" style="color: black;">
                                    <i class="fa fa-cog"></i> Manage Account
                                </a>
                                <a class="dropdown-item" href="admin/ajax.php?action=logout2" style="color: black;">
                                    <i class="fa fa-power-off"></i> Logout
                                </a>
                            </div>
                        </div>
                    </li>
               


                        <li class="nav-item">
    <a class="nav-link js-scroll-trigger" href="#" id="notification_icon">
        <i class="fa fa-bell" style="color:white; margin-left: 10px;"></i> <!-- Notification Icon -->
    </a>
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
  
  <!-- Notification Modal -->
<!-- Notification Modal -->
<div class="modal fade" id="notification_modal" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Notifications</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul id="notification_list" class="list-unstyled">
                    <!-- Notifications will be dynamically added here -->
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- ends notification -->

<footer style="background-color: #007bff; color: white; padding: 20px;">
    <div class="container">
        <div class="row">
            <!-- Contact Us Section -->
            <div class="col-lg-4 mb-4">
                <h5 class="font-weight-bold">Contact us</h5>
                <address>
                    K V Shankaragowda Rd,<br>
                    PES College Campus,<br>
                    Mandya, Karnataka 571401<br><br>
                    <strong>Email:</strong> <a href="mailto:admissions@pesce.ac.in" >admissions@pesce.ac.in</a><br>
                    <strong>Mobile No:</strong> 9448282588<br>
                    <strong>Office No:</strong> 08232 220043
                </address>
                <div class="social-icons" style="color :white;">
                    <a href="#" style="color: white;"><i class="fab fa-youtube"></i></a>
                    <a href="https://www.facebook.com/pesce1962/" style="color: white;"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" style="color: white;"><i class="fab fa-twitter"></i></a>
                    <a href="#" style="color: white;"><i class="fab fa-instagram"></i></a>
                    <a href="#" style="color: white;"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>

            <!-- Quick Links Section -->
            <div class="col-lg-4 mb-4">
                <h5 class="font-weight-bold-white">Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="#"  style="color: white;">NIRF</a></li>
                    <li><a href="#"  style="color: white;">Industry Institute Interaction Cell</a></li>
                    <li><a href="#" style="color: white;">Anti Ragging</a></li>
                    <li><a href="#" style="color: white;">Professional Bodies</a></li>
                    <li><a href="#" style="color: white;">About PES</a></li>
                    <li><a href="#" style="color: white;">Placements</a></li>
                    <li><a href="#" style="color: white;">Alumni</a></li>
                </ul>
            </div>

            <!-- General Links Section -->
            <div class="col-lg-4 mb-4">
                <h5 class="font-weight-bold">General Links</h5>
                <ul class="list-unstyled">
                    <li><a href="#" style="color: white;">Mandatory Disclosure</a></li>
                    <li><a href="#" style="color: white;">Downloads</a></li>
                    <li><a href="#" style="color: white;">RTI</a></li>
                    <li><a href="#" style="color: white;">Audit Report</a></li>
                    <li><a href="#" style="color: white;">Privacy Policy</a></li>
                    <li><a href="#" style="color: white;">Refund and Cancellations</a></li>
                    <li><a href="#" style="color: white;">Terms and Conditions</a></li>
                </ul>
            </div>
        </div>

        <!-- Bottom Section -->
        <div class="text-center mt-4">
            <p  class="white-text-muted small mb-0" >&copy; 2024 PES College of Engineering. All Rights Reserved.</p>
            <p class="white-text-muted small mb-0">Site by Quantum</p>
        </div>
    </div>
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

    $(document).ready(function() {
    $('#notification_icon').click(function() {
        $.ajax({
            url: 'fetch_notifications.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#notification_list').empty(); // Clear existing notifications
                if (Array.isArray(data) && data.length > 0) {
                    $.each(data, function(index, notification) {
                        let formattedDate = new Date(notification.created_at).toLocaleString(); // Format date

                        // Determine if the notification is new or seen
                        let isNew = notification.is_seen == 0 ? '<span style="color:red;">New</span> ' : '';

                        console.log('Appending notification:', isNew + notification.title); // Debug log

                        $('#notification_list').append(
                            '<li><strong>' + isNew + notification.title + '</strong><br>' +
                            '<small>' + formattedDate + '</small><br>' + // Date and time
                            '<p>' + notification.content + '</p></li><hr>' // Description (content)
                        );
                    });
                } else {
                    $('#notification_list').append('<li>No new notifications</li>');
                }

                // Show the modal after loading notifications
                $('#notification_modal').modal('show');

                // AJAX request to mark notifications as seen
                $.ajax({
                    url: 'mark_notifications_seen.php',  // PHP file to update notifications to seen
                    method: 'POST',
                    success: function() {
                        console.log('Notifications marked as seen.');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error marking notifications as seen: ' + textStatus, errorThrown);
                    }
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error fetching notifications: ' + textStatus, errorThrown);
                alert('Failed to fetch notifications. Please try again later.');
            }
        });
    });
});





    </script>
    <?php $conn->close() ?>

</html>