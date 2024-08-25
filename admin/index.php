<?php
$page_title = 'Inicio';
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php if (!empty($page_title))
            echo $page_title;
          else echo "JASIL"; ?>
  </title>
  <link rel="stylesheet" href="libs/css/styles.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script type="text/javascript" src="libs/js/scripts.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
  <nav class="navbar bg-body-tertiary fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand">
        REPRESENTACIONES Y DISTRIBUCIONES JASIL E.I.R.L.
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation" id="navbar-toggle">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasNavbarLabel"><a class="nav-link active" aria-current="page" href="index.php">JASIL</a></h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#Inicio">Inicio</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Nosotros
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#historia">Historia</a></li>
                <li><a class="dropdown-item" href="#mision">Misión</a></li>
                <li><a class="dropdown-item" href="#vision">Visión</a></li>
                <li><a class="dropdown-item" href="#valores">Valores</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#admin">Admin</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#historia">Contacto</a>
            </li>
          </ul>
          <form class="d-flex mt-3" role="search">
            <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">🔍</button>
          </form>
        </div>
      </div>
    </div>
  </nav>
  <div class="content">
    <div id="inicio" class="section">
      <hr>
      <hr>
      <p>Inicio - Cargando contenido...</p>
    </div>
    <div id="historia" class="section hidden">
      <h2>Historia</h2>
      <p>Cargando contenido...</p>
    </div>
    <div id="mision" class="section hidden">
      <h2>Misión</h2>
      <p>Cargando contenido...</p>
    </div>
    <div id="vision" class="section hidden">
      <h2>Visión</h2>
      <p>Cargando contenido...</p>
    </div>
    <div id="valores" class="section hidden">
      <h2>Valores</h2>
      <p>Cargando contenido...</p>
    </div>
    <div id="objetivos" class="section hidden">
      <h2>Objetivos</h2>
      <p>Cargando contenido...</p>
    </div>
    <div id="nosotros" class="section hidden">
      <h2>Nosotros</h2>
      <p>Cargando contenido...</p>
    </div>
    <div id="contacto" class="section hidden">
      <h2>Contacto</h2>
      <p>Cargando contenido...</p>
    </div>
  </div>
  <div class="footer">
    <p>&copy; 2024 JASIL</p>
  </div>
</body>

</html>