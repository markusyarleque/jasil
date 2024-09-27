<div class="footer_section layout_padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="location_text">
                    <ul>
                        <li>
                            <a href="tel:+51902332192"><span class="padding_15"><i class="fa fa-mobile" aria-hidden="true"></i></span> <br>+51 902332192</a>
                        </li>
                        <li class="active">
                            <a href="#mailto:ryd.jasil@gmail.com?cc=soporte@jasil.pe&subject=Informaci%C3%B3n%20Jasil&body=Hola,%0A%0ANecesito%20más%20información%20sobre:%0A%0ASaludos,"><span class="padding_15"><i class="fa fa-envelope" aria-hidden="true"></i></span> <br>ryd.jasil@gmail.com</a>
                        </li>
                        <li>
                            <a href="<?php
                                        if ($current_page != 'index.php') {
                                            echo "contact.php#mapa";
                                        } else {
                                            echo "#mapa";
                                        }
                                        ?>"><span class="padding_15"><i class="fa fa-map-marker" aria-hidden="true"></i></span> <br>Talara, Perú</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer_section_2">
            <div class="row">
                <div class="col-md-4">
                    <h2 class="useful_text">JASIL</h2>
                    <div class="footer_menu">
                        <ul>
                            <li><a href="index.php">Inicio</a></li>
                            <li><a href="about.php">Nosotros</a></li>
                            <li><a href="services.php">Servicios</a></li>
                            <li><a href="process.php">Procesos</a></li>
                            <li><a href="testimonial.php">Clientes</a></li>
                            <li><a href="blog.php">Blog</a></li>
                            <li><a href="contact.php">Contacto</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <h2 class="useful_text"></h2>
                    <p class="lorem_text"></p>
                </div>
                <div class="col-md-4">
                    <h2 class="useful_text">Te Contactamos</h2>
                    <div class="form-group">
                        <input type="email" class="update_mail" placeholder="Ingrese su correo" id="email" name="email" required></input>
                        <div class="subscribe_bt"><button type="submit" id="subscribeButton">Suscríbete</button></div>
                    </div>
                    <div class="g-recaptcha" id="g-recaptcha" data-sitekey=<?php echo $recaptcha_site_key ?>></div>
                </div>
            </div>
        </div>
        <div class="social_icon">
            <ul>
                <li>
                    <a href="https://www.facebook.com/jasil.pe/" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                </li>
                <li>
                    <a href="https://wa.me/51902332192" target="_blank"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
                </li>
                <li>
                    <a href="https://www.linkedin.com/jasil" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                </li>
                <li>
                    <a href="https://www.instagram.com/jasil.pe/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- footer section end -->
<!-- copyright section start -->
<div class="copyright_section">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <p class="copyright_text">&#169; 2024 Todos los Derechos Reservados.
            </div>
        </div>
    </div>
</div>
<!-- copyright section end -->
<!-- Modal Cotizacion start-->
<div class="modal fade" id="quoteModal" tabindex="-1" role="dialog" aria-labelledby="quoteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="quoteModalLabel">Solicitar Cotización</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="quoteForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="fullName">Nombres Completos</label>
                        <input type="text" class="form-control" id="fullName" name="fullName" required>
                    </div>
                    <div class="form-group">
                        <label for="company">Empresa o Compañía</label>
                        <input type="text" class="form-control" id="company" name="company">
                    </div>
                    <div class="form-group">
                        <label for="phone">Número Telefónico</label>
                        <input type="tel" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="service">Seleccionar el Servicio a Consultar</label>
                        <select class="form-control" id="service" name="service" required>
                            <option>Seleccionar</option>
                            <option value="Servicio de agua de mesa (20L)">Servicio de agua de mesa (20L)</option>
                            <option value="Servicio de agua de mesa (8L)">Servicio de agua de mesa (8L)</option>
                            <option value="Servicio de construcción">Servicio de construcción</option>
                            <option value="Alquiler de generadores">Alquiler de generadores</option>
                            <option value="Servicio de arenado y pintura">Servicio de arenado y pintura</option>
                            <option value="Otros servicios generales">Otros servicios generales</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="message">Detalle del Mensaje</label>
                        <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Enviar Información</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Cotizacion end-->
<!-- Javascript files-->
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/jquery-3.0.0.min.js"></script>
<script src="js/plugin.js"></script>
<script src="js/scripts.js"></script>
<script>
    function goBack() {
        window.history.back();
    };
    /* $(document).ready(function() {
         $('.collapse ul li a').click(function(e) {
             e.preventDefault();
             var target = $(this).attr('id');
             if (target != undefined && target.startsWith('#')) {
                 var $targetElement = $(target);
                 if ($targetElement.length) {
                     $targetElement.load('admin/includes/load_content.php', {
                         section: target.substring(1)
                     });
                 } else {
                     console.error('Elemento de destino no encontrado:', target);
                 }
             } else {
                 console.error('El valor de id no es un ID válido:', target);
             }
         });
     });*/
</script>
</body>

</html>