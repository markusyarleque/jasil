<?php
$page_title = 'Login';
require_once('includes/load.php');
if ($session->isUserLoggedIn(true)) {
  redirect('home.php', false);
}
?>
<?php include_once('layouts/header.php'); ?>
<div class="login-page">
  <div class="text-center">
    <h1>Bienvenido</h1>
    <p><b>Iniciar sesión</b></p>
    <br>
  </div>
  <?php echo display_msg($msg); ?>
  <form method="post" action="auth.php" class="clearfix">
    <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
      <input type="name" class="form-control" name="username" placeholder="Username">
    </div>
    <br>
    <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
      <input type="password" name="password" class="form-control" placeholder="Password">
    </div>
    <br>
    <a href="mailto:soporte@lacasaderepuestos.com.pe?cc=markus.yarleque@gmail.com&subject=Soporte%20Inventax&body=Hola,%0A%0AHe%20olvidado%20mi%20contrase%C3%B1a,%20mi%20usuario%20y%20documento%20son:%0A%0ASaludos,">
      <p style="text-align: center;">¿Has olvidado la contraseña?</p>
    </a>
    <br>
    <div class="form-group">
      <button type="submit" class="btn btn-primary  pull-right">
        Login <span class="glyphicon glyphicon-log-in"></span></button>
    </div>
  </form>
</div>
<?php include_once('layouts/footer.php'); ?>