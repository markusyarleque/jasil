<?php
$page_title = 'Lista de productos';
require_once('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(2);
$products = join_product_table();
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Productos</span>
        </strong>
        <div class="pull-right">
          <a href="add_product.php" class="btn btn-info pull-right btn-sm"><span class="glyphicon glyphicon-new-window"></span> Agregar</a>
        </div>
      </div>
      <div class="panel-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th class="text-center" style="width: 50px;"><b>#</b></th>
              <th><span class="glyphicon glyphicon-picture"></span> Imagen</th>
              <th><span class="glyphicon glyphicon-menu-hamburger"></span> Descripción </th>
              <th class="text-center" style="width: 12%;"><span class="glyphicon glyphicon-list-alt"></span> Categoría </th>
              <th class="text-center" style="width: 10%;"><span class="glyphicon glyphicon-bullhorn"></span> Stock </th>
              <th class="text-center" style="width: 10%;">Precio de compra (S/)</th>
              <th class="text-center" style="width: 10%;">Precio de venta (S/)</th>
              <th class="text-center" style="width: 12%;"><span class="glyphicon glyphicon-calendar"></span> Agregado </th>
              <th class="text-center" style="width: 120px;"><span class="glyphicon glyphicon-exclamation-sign"></span> Acciones </th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($products as $product): ?>
              <tr>
                <td class="text-center"><?php echo count_id(); ?></td>
                <td>
                  <?php if ($product['media_id'] === '0'): ?>
                    <img class="img-avatar img-circle" src="uploads/products/no_image.jpg" alt="">
                  <?php else: ?>
                    <img class="img-avatar img-circle" src="uploads/products/<?php echo $product['image']; ?>" alt="">
                  <?php endif; ?>
                </td>
                <td> <?php echo remove_junk($product['name']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['categorie']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['stock']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['buy_price']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['sale_price']); ?></td>
                <td class="text-center"> <?php echo read_date($product['date']); ?></td>
                <td class="text-center">
                  <div class="btn-group">
                    <a href="edit_product.php?id=<?php echo (int)$product['id']; ?>" class="btn btn-info btn-xs" title="Editar" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-pencil"></span>
                    </a>
                    <a href="javascript:void(0);" data-id="<?php echo (int)$product['id']; ?>" class="btn btn-danger btn-xs delete-product" title="Eliminar" data-toggle="tooltip">
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
        ¿Estás seguro de que deseas eliminar este producto?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" id="confirmDeleteBtnProduct">Eliminar</button>
      </div>
    </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>