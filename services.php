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
            <?php if ($current_page == 'index.php') {
            ?>
               <p class="services_text_1">En Representaciones y Distribuciones Jasil, nuestro compromiso es con la excelencia en cada aspecto de nuestra operación. Desde la selección y distribución de nuestros productos hasta la atención al cliente, trabajamos con dedicación para asegurar que nuestros clientes reciban lo mejor en cada entrega. Creemos que una hidratación adecuada es fundamental para el bienestar y la salud, y nos enorgullece ser parte de este importante proceso.</p>
               <div class="container-button">
                  <div class="read_bt_2"><a href="services.php">Conocer más</a></div>
               </div>
            <?php
            } else {
            ?>
               <p class="services_text_1">Nos destacamos por nuestra capacidad para ofrecer un servicio eficiente y personalizado, adaptándonos a las necesidades específicas de nuestros clientes y garantizando una entrega puntual y precisa. Nuestra pasión por la calidad y nuestro enfoque en la satisfacción del cliente nos diferencian en el mercado y nos impulsan a seguir innovando y mejorando continuamente.</p>
         </div>
      </div>
      <div class="services_section_2">
         <div class="row">
            <div class="col-lg-3 col-sm-6">
               <div class="box_main">
                  <div class="service_img"><img src="images/icon-5.png"></div>
                  <h4 class="development_text">Agua de mesa sin gas</h4>
                  <p class="services_text">Ofrecemos agua de mesa sin gas, purificada y ozonizada para garantizar su pureza y frescura. Ideal para el consumo diario en hogares, oficinas y negocios, nuestra agua cumple con los más altos estándares de calidad, asegurando una hidratación saludable y segura para todos.</p>
                  <!--<div class="readmore_bt"><a href="#">Leer más</a></div>-->
               </div>
            </div>
            <div class="col-lg-3 col-sm-6">
               <div class="box_main">
                  <div class="service_img"><img src="images/icon-1.png"></div>
                  <h4 class="development_text">Servicios de construcción</h4>
                  <p class="services_text">Ofrecemos soluciones integrales en construcción, desde el diseño y planificación hasta la ejecución de proyectos residenciales, comerciales e industriales. Nos comprometemos a entregar calidad, seguridad y cumplimiento en cada etapa del proyecto.</p>
                  <!--<div class="readmore_bt"><a href="#">Leer más</a></div>-->
               </div>
            </div>
            <div class="col-lg-3 col-sm-6">
               <div class="box_main">
                  <div class="service_img"><img src="images/icon-2.png"></div>
                  <h4 class="development_text">Alquiler de generadores</h4>
                  <p class="services_text">Brindamos alquiler de generadores y compresores de alta eficiencia y bajo consumo para eventos, emergencias y proyectos a largo plazo. Garantizamos un suministro continuo de energía con equipos de última tecnología y mantenimiento constante.</p>
                  <!--<div class="readmore_bt"><a href="#">...</a></div>-->
               </div>
            </div>
            <div class="col-lg-3 col-sm-6">
               <div class="box_main">
                  <div class="service_img"><img src="images/icon-3.png"></div>
                  <h4 class="development_text">Trabajo de arenado y pintura</h4>
                  <p class="services_text">Especialistas en arenado y pintura industrial, ofrecemos un acabado perfecto para superficies metálicas y estructuras. Utilizamos materiales de primera calidad y técnicas avanzadas para proteger y embellecer cualquier tipo de superficie.</p>
                  <!--<div class="readmore_bt"><a href="#">Leer más</a></div>-->
               </div>
            </div>
         </div>
      </div>
      <div class="brochure-download">
         <a href="documents/brochure.pdf" target="_blank" class="btn-brochure">
            <i class="fa fa-download"></i> Descargar Brochure
         </a>
      </div>
      <div class="floating-btn">
         <a href="documents/brochure.pdf" target="_blank">
            <i class="fa fa-download"></i>
            <span class="tooltip-floating">Brochure</span>
         </a>
      </div>
   <?php
            }
   ?>
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