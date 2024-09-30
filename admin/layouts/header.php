<?php $user = current_user(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title><?php if (!empty($page_title))
            echo remove_junk($page_title);
          elseif (!empty($user))
            echo ucfirst($user['name']);
          else echo "Jasil"; ?>
  </title>
  <?php
  $images_url = HTTP_SERVER_ROOT . '/libs/images';
  ?>
  <link rel="icon" href="<?php echo $images_url; ?>/favicon-16.png" sizes="16x16" type="image/png">
  <link rel="icon" href="<?php echo $images_url; ?>/favicon-32.png" sizes="32x32" type="image/png">
  <link rel="icon" href="<?php echo $images_url; ?>/favicon-96.png" sizes="96x96" type="image/png">
  <link rel="icon" href="<?php echo $images_url; ?>/favicon-192.png" sizes="192x192" type="image/png">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" />
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
  <?php
  $css_url = HTTP_SERVER_ROOT . '/libs/css/main.css';
  ?>
  <link rel="stylesheet" href="<?php echo $css_url; ?>" />
</head>

<body>
  <?php if ($session->isUserLoggedIn(true)) : ?>
    <header id="header">
      <div class="logo pull-left">JASIL</div>
      <div class="header-content">
        <div class="header-date pull-left">
          <strong><span id="clock"><?php echo date("d/m/Y  g:i a"); ?></span></strong>
        </div>
        <div class="pull-right clearfix">
          <ul class="info-menu list-inline list-unstyled">
            <li class="profile">
              <a href="#" data-toggle="dropdown" class="toggle" aria-expanded="false">
                <img src="<?php echo HTTP_SERVER_ROOT; ?>/uploads/users/<?php echo $user['image']; ?>" alt="user-image" class="img-circle img-inline">
                <span><?php echo remove_junk(ucfirst($user['name'])); ?> <i class="caret"></i></span>
              </a>
              <ul class="dropdown-menu">
                <li>
                  <a href="<?php echo HTTP_SERVER_ROOT; ?>/profile.php?id=<?php echo (int)$user['id']; ?>">
                    <i class="glyphicon glyphicon-user"></i>
                    Perfil
                  </a>
                </li>
                <li>
                  <a href="<?php echo HTTP_SERVER_ROOT; ?>/edit_account.php" title="edit account">
                    <i class="glyphicon glyphicon-cog"></i>
                    Configuración
                  </a>
                </li>
                <li class="last">
                  <a href="<?php echo HTTP_SERVER_ROOT; ?>/logout.php">
                    <i class="glyphicon glyphicon-off"></i>
                    Salir
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </header>
    <div class="sidebar">
      <?php if ($user['user_level'] === '1') : ?>
        <!-- admin menu -->
        <?php include_once('admin_menu.php'); ?>

      <?php elseif ($user['user_level'] === '2') : ?>
        <!-- Special user -->
        <?php include_once('special_menu.php'); ?>

      <?php elseif ($user['user_level'] === '3') : ?>
        <!-- User menu -->
        <?php include_once('user_menu.php'); ?>

      <?php endif; ?>

    </div>
  <?php endif; ?>

  <div class="page">
    <div class="container-fluid">