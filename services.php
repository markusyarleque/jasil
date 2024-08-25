<?php
$page_title = 'Servicios';
// Obtener el nombre del archivo actual
$current_page = basename($_SERVER['PHP_SELF']);
// Verificar si es index.php
if ($current_page !== 'index.php') {
   include_once('layouts/header.php');
}
?>
<!-- services section start -->
<div class="services_section layout_padding">
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-12">
            <h1 class="services_taital">Nuestros Servicios</h1>
            <p class="services_text_1">ssages of Lorem Ipsum available, but the majority have suffered alteration</p>
         </div>
      </div>
      <div class="services_section_2">
         <div class="row">
            <div class="col-lg-3 col-sm-6">
               <div class="box_main active">
                  <div class="service_img"><img src="images/icon-1.png"></div>
                  <h4 class="development_text">Construction Services</h4>
                  <p class="services_text">fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using L</p>
                  <div class="readmore_bt"><a href="#">Read More</a></div>
               </div>
            </div>
            <div class="col-lg-3 col-sm-6">
               <div class="box_main">
                  <div class="service_img"><img src="images/icon-2.png"></div>
                  <h4 class="development_text">Building Modeling</h4>
                  <p class="services_text">fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using L</p>
                  <div class="readmore_bt"><a href="#">Read More</a></div>
               </div>
            </div>
            <div class="col-lg-3 col-sm-6">
               <div class="box_main">
                  <div class="service_img"><img src="images/icon-3.png"></div>
                  <h4 class="development_text">Pre construction</h4>
                  <p class="services_text">fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using L</p>
                  <div class="readmore_bt"><a href="#">Read More</a></div>
               </div>
            </div>
            <div class="col-lg-3 col-sm-6">
               <div class="box_main">
                  <div class="service_img"><img src="images/icon-4.png"></div>
                  <h4 class="development_text">Management</h4>
                  <p class="services_text">fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using L</p>
                  <div class="readmore_bt"><a href="#">Read More</a></div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <br>
</div>
<!-- services section end -->
<!-- footer section start -->
<?php
// Verificar si es index.php
if ($current_page !== 'index.php') {
   include_once('layouts/footer.php');
}
?>