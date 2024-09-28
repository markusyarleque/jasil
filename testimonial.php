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
                        <h2 class="client_name_text">Gabriel Paredes <span style="float: right;"><img src="images/quick-icon.png"></span></h2>
                        <p class="textimonial_text">"El servicio de agua de mesa en botellas de 20 litros ha sido una gran solución para mi hogar. La calidad es excelente y el sabor es insuperable. Recomiendo este servicio a todos mis amigos y familiares." - Servicio de agua de mesa (20L)</p>
                     </div>
                     <div class="testimonial_section_2">
                        <h2 class="client_name_text"><img src="images/quick-icon.png"> <span style="float: right;">Martha Herrera</span></h2>
                        <p class="textimonial_text">"Optamos por el servicio de agua de mesa de 8 litros para nuestras oficinas. Es muy práctico y conveniente, sobre todo en espacios reducidos. El servicio siempre ha sido puntual y confiable." - Servicio de agua de mesa (8L)</p>
                     </div>
                  </div>
               </div>
            </div>
            <div class="carousel-item">
               <div class="row">
                  <div class="col-md-12">
                     <h1 class="testimonial_taital">Testimonial</h1>
                     <div class="testimonial_section_2">
                        <h2 class="client_name_text">Roberto Salazar <span style="float: right;"><img src="images/quick-icon.png"></span></h2>
                        <p class="textimonial_text">"Contratamos el servicio de construcción para nuestro nuevo local y quedamos completamente satisfechos. La calidad del trabajo y la atención al detalle superaron nuestras expectativas." - Servicio de construcción</p>
                     </div>
                     <div class="testimonial_section_2">
                        <h2 class="client_name_text"><img src="images/quick-icon.png"> <span style="float: right;">Valeria Montes</span></h2>
                        <p class="textimonial_text">"Alquilamos generadores para un evento importante y el servicio fue impecable. Los equipos en excelente estado y el soporte técnico siempre estuvo disponible. Definitivamente volveremos a utilizar este servicio." - Alquiler de generadores</p>
                     </div>
                  </div>
               </div>
            </div>
            <div class="carousel-item">
               <div class="row">
                  <div class="col-md-12">
                     <h1 class="testimonial_taital">Testimonial</h1>
                     <div class="testimonial_section_2">
                        <h2 class="client_name_text">Diego Pérez <span style="float: right;"><img src="images/quick-icon.png"></span></h2>
                        <p class="textimonial_text">"Necesitábamos compresores para un proyecto y el servicio de alquiler fue excelente. Equipos en perfecto estado y atención rápida. Nos ayudaron a completar el trabajo sin problemas." - Alquiler de compresores</p>
                     </div>
                     <div class="testimonial_section_2">
                        <h2 class="client_name_text"><img src="images/quick-icon.png"> <span style="float: right;">Luisa Ramírez</span></h2>
                        <p class="textimonial_text">"El servicio de arenado y pintura transformó por completo la imagen de nuestra empresa. El trabajo fue impecable y el equipo muy profesional. El resultado final superó nuestras expectativas." - Servicio de arenado y pintura</p>
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