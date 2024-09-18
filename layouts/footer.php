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
                    <div class="g-recaptcha" id="g-recaptcha" data-sitekey="6LcNxkcqAAAAAOgq4a_VkSD7hhCEkE58jZhhhM4U"></div>
                </div>
            </div>
        </div>
        <div class="social_icon">
            <ul>
                <li>
                    <a href="https://www.facebook.com/jasil"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                </li>
                <li>
                    <a href="https://www.x.com/jasil"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                </li>
                <li>
                    <a href="https://www.linkedin.com/jasil"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                </li>
                <li>
                    <a href="https://www.instagram.com/jasil"><i class="fa fa-instagram" aria-hidden="true"></i></a>
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