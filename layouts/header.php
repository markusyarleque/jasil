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
                        <div class="call_text"><a href="#"><i class="fa fa-phone" aria-hidden="true"></i> +51 902332192</a></div>
                        <div class="call_text_2"><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i> ryd.jasil@gmail.com</a></div>
                        <div class="call_text_1"><a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i> Talara, Perú</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- header top section start -->
    <!-- header section start -->
    <div class="header_section">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="logo"><a href="index.php"><img src="images/logo.png"></a></div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.php">Nosotros</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="services.php">Servicios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="projects.php">Proyectos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="blog.php">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="testimonial.php">Clientes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.php">Contacto</a>
                        </li>
                    </ul>
                    <form class="form-inline my-2 my-lg-0">
                        <div class="login_text">
                            <ul>
                                <li><a href="#">Login</a></li>
                                <li><a href="#"><i class="fa fa-user" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                        <div class="quote_btn"><a href="#">Cotizar</a></div>
                    </form>
                </div>
            </nav>
        </div>