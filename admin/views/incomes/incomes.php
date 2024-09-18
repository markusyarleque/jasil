<?php
$page_title = 'Lista de compras';
require_once('../../includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(3);
//pull out all incomes form database
$incomes = find_all_income();
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
          <span>Todas la compras</span>
        </strong>
        <div class="pull-right">
          <a href="add.php" class="btn btn-info pull-right btn-sm"><span class="glyphicon glyphicon-new-window"></span> Agregar</a>
        </div>
      </div>
      <div class="panel-body">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th class="text-center" style="width: 3%;"><b>#</b></th>
              <th style="width: 13%;"><span class="glyphicon glyphicon-file"></span> N° Voucher </th>
              <th style="width: 13%;"><span class="glyphicon glyphicon-tag"></span> Proveedor </th>
              <th style="width: 15%;"><span class="glyphicon glyphicon-shopping-cart"></span> Producto </th>
              <th class="text-center" style="width: 8%;"><span class="glyphicon glyphicon-bullhorn"></span> Cantidad</th>
              <th class="text-center" style="width: 8%;">Precio (S/)</th>
              <th class="text-center" style="width: 8%;">Total (S/)</th>
              <th class="text-center" style="width: 11%;"><span class="glyphicon glyphicon-calendar"></span> Fecha </th>
              <th class="text-center" style="width: 11%;"><span class="glyphicon glyphicon-user"></span> Comprador </th>
              <th class="text-center" style="width: 10%;"><span class="glyphicon glyphicon-exclamation-sign"></span> Acciones </th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($incomes as $income) : ?>
              <tr>
                <td class="text-center"><?php echo count_id(); ?></td>
                <td><?php echo remove_junk($income['num_voucher']); ?></td>
                <td><?php echo remove_junk($income['provider']); ?></td>
                <td><?php echo remove_junk($income['name']); ?></td>
                <td class="text-center"><?php echo (int)$income['qty']; ?></td>
                <td class="text-center"><?php echo remove_junk($income['buy_price']); ?></td>
                <td class="text-right"><?php echo remove_junk($income['subtotal']); ?></td>
                <td class="text-center"><?php echo $income['date']; ?></td>
                <td><?php echo remove_junk($income['buyer']); ?></td>
                <td class="text-center">
                  <div class="btn-group">
                    <!--<a href="edit.php?id=<?php echo (int)$income['id']; ?>" class="btn btn-warning btn-xs" title="Edit" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-pencil"></span>
                    </a>-->
                    <a href="javascript:void(0);" data-id="<?php echo (int)$income['id']; ?>" class="btn btn-danger btn-xs delete-income" title="Eliminar" data-toggle="tooltip">
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
        ¿Estás seguro de que deseas eliminar esta compra?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" id="confirmDeleteBtnIncome">Eliminar</button>
      </div>
    </div>
  </div>
</div>
<?php include_once('../../layouts/footer.php'); ?>