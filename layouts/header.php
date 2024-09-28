<?php
require_once('admin/includes/load.php');
$current_page = basename($_SERVER['PHP_SELF']);
?>
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
    <title><?php if (!empty($page_title))
                echo $page_title;
            else echo "Jasil"; ?>
    </title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- favicon -->
    <link rel="icon" href="images/logo-jasil.png" sizes="16x16" type="image/png">
    <link rel="icon" href="images/logo-jasil.png" sizes="32x32" type="image/png">
    <link rel="icon" href="images/logo-jasil.png" sizes="96x96" type="image/png">
    <link rel="icon" href="images/logo-jasil.png" sizes="192x192" type="image/png">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css">
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
                        <div class="call_text"><i class="fa fa-clock-o"></i> Lunes a Sábado de 09:00 - 18:00
                        </div>
                        <div class="call_text_2"><a href="tel:+51902332192"><i class="fa fa-phone" aria-hidden="true"></i> +51 902332192</a></div>
                        <div class="call_text_2"><a href="mailto:ryd.jasil@gmail.com?cc=soporte@jasil.pe&subject=Informaci%C3%B3n%20Jasil&body=Hola,%0A%0ANecesito%20más%20información%20sobre:%0A%0ASaludos,"><i class="fa fa-envelope" aria-hidden="true"></i> ryd.jasil@gmail.com</a></div>
                        <div class="call_text_1"><a href="<?php
                                                            if ($current_page != 'index.php') {
                                                                echo "contact.php#mapa";
                                                            } else {
                                                                echo "#mapa";
                                                            }
                                                            ?>"><i class="fa fa-map-marker" aria-hidden="true"></i> Talara, Perú</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- header top section start -->
    <!-- header section start -->
    <div class="header_section <?php
                                if ($current_page != 'index.php') {
                                    echo "header_bg";
                                }
                                ?>">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="logo"><a href="index.php"><img src="<?php
                                                                if ($current_page != 'index.php') {
                                                                    echo "images/logo-blanco.png";
                                                                } else {
                                                                    echo "images/logo.png";
                                                                }
                                                                ?>"></a></div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item <?php if ($current_page == 'index.php') echo 'active'; ?>">
                            <a class="nav-link" href="index.php">Inicio</a>
                        </li>
                        <li class="nav-item <?php if ($current_page == 'about.php') echo 'active'; ?>">
                            <a class="nav-link" href="about.php">Nosotros</a>
                        </li>
                        <li class="nav-item <?php if ($current_page == 'services.php') echo 'active'; ?>">
                            <a class="nav-link" href="services.php">Servicios</a>
                        </li>
                        <li class="nav-item <?php if ($current_page == 'process.php') echo 'active'; ?>">
                            <a class="nav-link" href="process.php">Procesos</a>
                        </li>
                        <li class="nav-item <?php if ($current_page == 'blog.php') echo 'active'; ?>">
                            <a class="nav-link" href="blog.php">Blog</a>
                        </li>
                        <li class="nav-item <?php if ($current_page == 'testimonial.php') echo 'active'; ?>">
                            <a class="nav-link" href="testimonial.php">Clientes</a>
                        </li>
                        <li class="nav-item <?php if ($current_page == 'contact.php') echo 'active'; ?>">
                            <a class=" nav-link" href="contact.php">Contacto</a>
                        </li>
                    </ul>
                    <form class="form-inline my-2 my-lg-0">
                        <div class="login_text">
                            <ul>
                                <li><a href="admin/login.php" target="_blank"><i class="fa fa-user" aria-hidden="true"></i> Login</a></li>
                            </ul>
                        </div>
                        <div class="quote_btn">
                            <a href="#" data-toggle="modal" data-target="#quoteModal">Cotizar</a>
                        </div>
                    </form>
                </div>
            </nav>
        </div>
        <!-- banner section start -->
        <?php
        if ($current_page == 'index.php') {
            include_once('banner.php');
        }
        ?>
        <!-- banner section end -->
    </div>
    <!-- header section end -->