<?php
$page_title = 'Procesos';
// Obtener el nombre del archivo actual
$current_page = basename($_SERVER['PHP_SELF']);
// Verificar si es index.php
if ($current_page !== 'index.php') {
    include_once('layouts/header.php');
}
?>
<!-- process section start -->
<div class="container process-container">
    <div class="row">
        <div class="col-sm-12">
            <h1 class="process_tittle">Procesos de Purificación</h1>
        </div>
    </div>
    <br>
    <div class="process-diagram">
        <ul class="process-steps">
            <li>
                <div class="step-number">1</div>
                <div class="process-info">Filtro Sedimentador</div>
                <div class="connector"></div>
                <div class="step-number">2</div>
                <div class="process-info">Filtro Multimedia</div>
            </li>
            <li>
                <div class="step-number">3</div>
                <div class="process-info">Carbón Activo</div>
                <div class="connector"></div>
                <div class="step-number">4</div>
                <div class="process-info">Ablandador</div>
            </li>
            <li>
                <div class="step-number">5</div>
                <div class="process-info">Ósmosis Inversa</div>
                <div class="connector"></div>
                <div class="step-number">6</div>
                <div class="process-info">Luz Ultravioleta</div>
            </li>
            <li>
                <div class="step-number">7</div>
                <div class="process-info">Iones de Planta</div>
                <div class="connector"></div>
                <div class="step-number">8</div>
                <div class="process-info">Filtro Pulidores</div>
            </li>
            <li>
                <div class="step-number">9</div>
                <div class="process-info">Ozonificación</div>
            </li>
        </ul>
    </div>
</div>
<!-- process section end -->
<!-- footer section start -->
<?php
// Verificar si es index.php
if ($current_page !== 'index.php') {
    include_once('layouts/footer.php');
}
?>