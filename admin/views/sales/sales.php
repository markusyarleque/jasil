<?php
$page_title = 'Lista de ventas';
require_once('../../includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(3);
//pull out all sales form database
$sales = find_all_sale();
?>
<?php include_once('../../layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Todas la ventas</span>
        </strong>
        <div class="pull-right">
          <a href="add.php" class="btn btn-info pull-right btn-sm"><span class="glyphicon glyphicon-new-window"></span> Agregar</a>
        </div>
      </div>
      <div class="panel-body">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th class="text-center" style="width: 40px;"><b>#</b></th>
              <th style="width: 50%;"><span class="glyphicon glyphicon-tag"></span> Cliente </th>
              <th style="width: 50%;"><span class="glyphicon glyphicon-shopping-cart"></span> Producto </th>
              <th class="text-center" style="width: 18%;"><span class="glyphicon glyphicon-bullhorn"></span> Cantidad</th>
              <th class="text-center" style="width: 15%;">Precio (S/)</th>
              <th class="text-center" style="width: 15%;">Total (S/)</th>
              <th class="text-center" style="width: 15%;"><span class="glyphicon glyphicon-calendar"></span> Fecha </th>
              <th class="text-center" style="width: 15%;"><span class="glyphicon glyphicon-user"></span> Vendedor </th>
              <th class="text-center" style="width: 120px;"><span class="glyphicon glyphicon-exclamation-sign"></span> Acciones </th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($sales as $sale) : ?>
              <tr>
                <td class="text-center"><?php echo $sale['id']; ?></td>
                <td><?php echo remove_junk($sale['customer']); ?></td>
                <td><?php echo remove_junk($sale['name']); ?></td>
                <td class="text-center"><?php echo (int)$sale['qty']; ?></td>
                <td class="text-right"><?php echo remove_junk($sale['sale_price']); ?></td>
                <td class="text-right"><?php echo remove_junk($sale['subtotal']); ?></td>
                <td class="text-center"><?php echo $sale['date']; ?></td>
                <td><?php echo remove_junk($sale['saler']); ?></td>
                <td class="text-center">
                  <div class="btn-group">
                    <!--<a href="edit.php?id=<?php echo (int)$sale['id']; ?>" class="btn btn-warning btn-xs" title="Editar" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-pencil"></span>
                    </a>-->
                    <a href="javascript:void(0);" class="btn btn-danger btn-xs delete-sale" data-id="<?php echo (int)$sale['id']; ?>" title="Eliminar" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-trash"></span>
                    </a>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- Modal de Confirmación -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="confirmDeleteModalLabel">Confirmar Eliminación</h4>
      </div>
      <div class="modal-body">
        ¿Estás seguro de que deseas eliminar esta venta?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" id="confirmDeleteBtnSale">Eliminar</button>
      </div>
    </div>
  </div>
</div>
<?php include_once('../../layouts/footer.php'); ?>