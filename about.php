<?php
$page_title = 'Nosotros';
// Obtener el nombre del archivo actual
$current_page = basename($_SERVER['PHP_SELF']);
// Verificar si es index.php
if ($current_page !== 'index.php') {
   include_once('layouts/header.php');
}
?>
<!-- about section start -->
<div class="about_section layout_padding">
   <div class="container">
      <div class="row">
         <div class="col-md-6">
            <h1 class="about_taital">¿Quiénes somos?</h1>
            <p class="about_text" id="historia">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All </p>
            <div class="read_bt_1"><a href="#">Read More</a></div>
         </div>
         <div class="col-md-6">
            <div class="about_img">
               <div class="video_bt">
                  <div class="play_icon"><img src="images/play-icon.png"></div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <br>
</div>
<!-- about section end -->
<!-- footer section start -->
<?php
// Verificar si es index.php
if ($current_page !== 'index.php') {
   include_once('layouts/footer.php');
}
?>