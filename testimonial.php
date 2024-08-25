<?php
$page_title = 'Clientes';
// Obtener el nombre del archivo actual
$current_page = basename($_SERVER['PHP_SELF']);
// Verificar si es index.php
if ($current_page !== 'index.php') {
   include_once('layouts/header.php');
}
?>
<!-- testimonial section start -->
<div class="testimonial_section layout_padding">
   <div class="container">
      <div id="costum_slider" class="carousel slide" data-ride="carousel">
         <div class="carousel-inner">
            <div class="carousel-item active">
               <div class="row">
                  <div class="col-md-12">
                     <h1 class="testimonial_taital">Testimonial</h1>
                     <div class="testimonial_section_2">
                        <h2 class="client_name_text">Molik <span style="float: right;"><img src="images/quick-icon.png"></span></h2>
                        <p class="textimonial_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugia</p>
                     </div>
                     <div class="testimonial_section_2">
                        <h2 class="client_name_text"><img src="images/quick-icon.png"> <span style="float: right;">jeaanson</span></h2>
                        <p class="textimonial_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugia</p>
                     </div>
                  </div>
               </div>
            </div>
            <div class="carousel-item">
               <div class="row">
                  <div class="col-md-12">
                     <h1 class="testimonial_taital">Testimonial</h1>
                     <div class="testimonial_section_2">
                        <h2 class="client_name_text">Molik <span style="float: right;"><img src="images/quick-icon.png"></span></h2>
                        <p class="textimonial_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugia</p>
                     </div>
                     <div class="testimonial_section_2">
                        <h2 class="client_name_text"><img src="images/quick-icon.png"> <span style="float: right;">jeaanson</span></h2>
                        <p class="textimonial_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugia</p>
                     </div>
                  </div>
               </div>
            </div>
            <div class="carousel-item">
               <div class="row">
                  <div class="col-md-12">
                     <h1 class="testimonial_taital">Testimonial</h1>
                     <div class="testimonial_section_2">
                        <h2 class="client_name_text">Molik <span style="float: right;"><img src="images/quick-icon.png"></span></h2>
                        <p class="textimonial_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugia</p>
                     </div>
                     <div class="testimonial_section_2">
                        <h2 class="client_name_text"><img src="images/quick-icon.png"> <span style="float: right;">jeaanson</span></h2>
                        <p class="textimonial_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugia</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <a class="carousel-control-prev" href="#costum_slider" role="button" data-slide="prev">
            <i class="fa fa-angle-left"></i>
         </a>
         <a class="carousel-control-next" href="#costum_slider" role="button" data-slide="next">
            <i class="fa fa-angle-right"></i>
         </a>
      </div>
   </div>
</div>
<!-- testimonial section end -->
<!-- footer section start -->
<?php
// Verificar si es index.php
if ($current_page !== 'index.php') {
   include_once('layouts/footer.php');
}
?>