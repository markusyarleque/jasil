<?php
$page_title = 'Reporte de compras';
require_once('../../includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(3);
?>
<?php include_once('../../layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="panel">
      <div class="panel-body">
        <form class="clearfix" method="post" action="income_report_process.php" target="_blank">
          <div class="form-group">
            <span class="glyphicon glyphicon-th"></span>
            <label class="form-label">Rango de fechas:</label>
            <div class="input-group">
              <input type="text" class="datepicker form-control" name="start-date" placeholder="Desde">
              <span class="input-group-addon"><i class="glyphicon glyphicon-menu-right"></i></span>
              <input type="text" class="datepicker form-control" name="end-date" placeholder="Hasta">
            </div>
          </div>
          <div class="form-group">
            <button type="submit" name="submit" class="btn btn-primary">Generar Reporte</button>
          </div>
        </form>
      </div>

    </div>
  </div>

</div>
<?php include_once('../../layouts/footer.php'); ?>