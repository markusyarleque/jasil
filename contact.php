<!DOCTYPE html>
<html lang="en">

<head>
   <!-- basic -->
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <!-- mobile metas -->
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="viewport" content="initial-scale=1, maximum-scale=1">
   <!-- site metas -->
   <title>Contact</title>
   <meta name="keywords" content="">
   <meta name="description" content="">
   <meta name="author" content="">
   <!-- bootstrap css -->
   <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
   <!-- style css -->
   <link rel="stylesheet" type="text/css" href="css/style.css">
   <!-- Responsive-->
   <link rel="stylesheet" href="css/responsive.css">
   <!-- fevicon -->
   <link rel="icon" href="images/fevicon.png" type="image/gif" />
   <!-- Scrollbar Custom CSS -->
   <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
   <!-- Tweaks for older IEs-->
   <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
   <!-- fonts -->
   <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;800&family=Sen:wght@400;700;800&display=swap" rel="stylesheet">
</head>

<body>
   <!-- header top section start -->
   <div class="header_top_section">
      <div class="container">
         <div class="row">
            <div class="col-sm-12">
               <div class="header_top_main">
                  <div class="call_text"><a href="#"><i class="fa fa-phone" aria-hidden="true"></i> +01-40-114-6855</a></div>
                  <div class="call_text_2"><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i> demo@gmail.com</a></div>
                  <div class="call_text_1"><a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i> Mordern Tawon Mosco</a></div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- header top section start -->
   <!-- header section start -->
   <div class="header_section header_bg">
      <div class="container-fluid">
         <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="logo"><a href="index.html"><img src="images/logo.png"></a></div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
               <ul class="navbar-nav ml-auto">
                  <li class="nav-item">
                     <a class="nav-link" href="index.html">Home</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="services.html">Services</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="about.html">About</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="projects.html">Project</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="blog.html">Blog</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="testimonial.html">Testimonial</a>
                  </li>
                  <li class="nav-item active">
                     <a class="nav-link" href="contact.html">Contact Us</a>
                  </li>
               </ul>
               <form class="form-inline my-2 my-lg-0">
                  <div class="login_text">
                     <ul>
                        <li><a href="#">Login</a></li>
                        <li><a href="#"><i class="fa fa-user" aria-hidden="true"></i></a></li>
                     </ul>
                  </div>
                  <div class="quote_btn"><a href="#">Get A Quote</a></div>
               </form>
            </div>
         </nav>
      </div>
   </div>
   <!-- header section end -->
   <!-- contact section start -->
   <div class="contact_section layout_padding">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <h1 class="contact_taital">Contact Us</h1>
            </div>
         </div>
      </div>
      <div class="container-fluid">
         <div class="contact_section_2">
            <div class="row">
               <div class="col-md-6">
                  <form action="">
                     <div class="mail_section_1">
                        <input type="text" class="mail_text" placeholder="Name" name="Name">
                        <input type="text" class="mail_text" placeholder="Phone Number" name="Phone Number">
                        <input type="text" class="mail_text" placeholder="Email" name="Email">
                        <textarea class="massage-bt" placeholder="Massage" rows="5" id="comment" name="Massage"></textarea>
                        <div class="send_bt"><a href="#">SEND</a></div>
                     </div>
                  </form>
               </div>
               <div class="col-md-6 padding_left_15">
                  <div class="contact_img"><img src="images/contact-img.png"></div>
               </div>
            </div>
         </div>
      </div>
      <div class="map_main">
         <div class="map-responsive">
            <iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA0s1a7phLN0iaD6-UE7m4qP-z21pH0eSc&amp;q=Eiffel+Tower+Paris+France" width="600" height="600" frameborder="0" style="border:0; width: 100%;" allowfullscreen=""></iframe>
         </div>
      </div>
   </div>
   <!-- contact section end -->
   <!-- footer section start -->
   <?php include_once('layouts/footer.php'); ?>