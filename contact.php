<?php
$page_title = 'Contacto';
// Obtener el nombre del archivo actual
$current_page = basename($_SERVER['PHP_SELF']);
// Verificar si es index.php
if ($current_page !== 'index.php') {
   include_once('layouts/header.php');
}
?>
<!-- contact section start -->
<div class="contact_section layout_padding">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <h1 class="contact_taital">Contáctanos</h1>
         </div>
      </div>
   </div>
   <div class="container-fluid">
      <div class="contact_section_2">
         <div class="row">
            <div class="col-md-6">
               <form id="contactForm">
                  <div class="mail_section_1">
                     <input type="text" class="mail_text" placeholder="Nombre" name="Name">
                     <input type="text" class="mail_text" placeholder="Teléfono" name="PhoneNumber">
                     <input type="text" class="mail_text" placeholder="Email" name="Email">
                     <textarea class="massage-bt" placeholder="Mensaje" rows="5" id="comment" name="Massage"></textarea>
                     <button type="submit" class="send_bt">Enviar</button>
                  </div>
               </form>
            </div>
            <div class="col-md-6 padding_left_15 text-center">
               <div class="contact_img"><img src="images/contact-img.jpg"></div>
            </div>
         </div>
      </div>
   </div>
   <div class="map_main">
      <div class="map-responsive">
         <iframe src="https://www.google.com/maps/embed/v1/place?key=<?php echo $maps_api_key ?>&amp;q=place_id:ChIJb_SXTQBFNpAR2Spjf-b26EM&amp;center=-4.573608678347304,-81.27028559814471" width="600" height="600" frameborder="0" style="border:0; width: 100%;" allowfullscreen="" id="mapa"></iframe>
      </div>
   </div>
</div>
<!-- contact section end -->
<!-- footer section start -->
<?php
// Verificar si es index.php
if ($current_page !== 'index.php') {
   include_once('layouts/footer.php');
}
?>