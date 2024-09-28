<?php
$page_title = '404';
// Obtener el nombre del archivo actual
$current_page = basename($_SERVER['PHP_SELF']);
// Verificar si es index.php
if ($current_page !== 'index.php') {
    include_once('layouts/header.php');
}
?>
<!-- 404 section start -->
<div class="container-404">
    <h1 class="error404_title">Error 404</h1>
    <p class="error404_text">Lo sentimos, la página que buscas no se ha encontrado.</p>
</div>
<div class="error404_img">
    <div class="error404_bt">
        <div class="error404_icon"></div>
    </div>
    <br>
</div>
<div class="footer_404">
    <a href="javascript:void(0);" onclick="goBack()">
        <i class="glyphicon glyphicon-chevron-left"></i>
        Volver
    </a>
    <br>
</div>
<br>
<!-- 404 section end -->
<!-- footer section start -->
<?php
// Verificar si es index.php
if ($current_page !== 'index.php') {
    include_once('layouts/footer.php');
}
?>