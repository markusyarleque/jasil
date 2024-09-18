<?php
$page_title = 'Agregar compra';
require_once('../../includes/load.php');
page_require_level(3);
$user = current_user();
$products = find_all('products');
$providers = find_all('providers');
$default_provider_id = 1;
$fecha_hora = date('dmyHis');
$fechaHora = date('Y-m-d H:i:s');
?>
<?php
if (isset($_POST['add_incomes'])) {
  $_SESSION['post_data'] = $_POST;
  $n_voucher = $_POST['n_v'];
  $product_ids = $_POST['product_id'];
  $quantities = $_POST['qty'];
  $subtotals = $_POST['subtotal'];
  $user_id    = (int)$user['id'];
  $provider =    (int)$_POST['p_id'];
  $datetime = $fecha_hora;
  echo '<script>console.log("Valor de provider: ' . $n_voucher . '");</script>';
  if (!empty($product_ids)) {
    $query_values = [];
    for ($i = 0; $i < count($product_ids); $i++) {
      $product_id = (int)$db->escape($product_ids[$i]);
      $qty = remove_junk($db->escape($quantities[$i]));
      $subtotal   = remove_junk($db->escape($subtotals[$i]));

      $igv = round($subtotal * 0.18, 2);

      $query_values[] = "('{$n_voucher}','{$provider}', '{$product_id}', '{$qty}', '{$subtotal}', '{$igv}', '{$fechaHora}', '{$user_id}')";
    }
    if (!empty($query_values)) {
      if (empty($errors)) {
        $query = "INSERT INTO incomes (num_voucher, provider, product_id, qty, subtotal, igv, date, buyer) VALUES ";
        $query .= implode(", ", $query_values);
        if ($db->query($query)) {
          echo '<script type="text/javascript">',
          'window.onload = function() {',
          '$("#saleModal").modal("show");',
          '};',
          '</script>';
        } else {
          $session->msg('d', ' No se pudo registrar la compra.');
          redirect('add.php', false);
        }
      } else {
        $session->msg("d", $errors);
        redirect('add.php', false);
      }
    }
  } else {
    $session->msg("d", "No se seleccionaron productos.");
    redirect('add.php', false);
  }
}
?>
<?php include_once('../../layouts/header.php'); ?>
<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
    <form method="post" action="ajax.php" autocomplete="off" id="sug-form_i">
      <div class="form-group">
        <div class="input-group">
          <span class="input-group-btn">
            <button type="submit" class="btn btn-primary">Producto</button>
          </span>
          <input type="text" id="sug_input_i" class="form-control" name="title" placeholder="Buscar por el nombre del producto">
        </div>
        <div id="result" class="list-group"></div>
      </div>
    </form>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Agregar compra</span>
          <a href="incomes.php" class="btn pull-right btn-xs" title="Cerrar"><span class="	glyphicon glyphicon-remove"></span></a>
        </strong>
      </div>
      <div class="panel-body">
        <form method="post" action="">
          <div class="form-group" id="provider">
            <label for="provider">Proveedor: </label>
            <select class="form-control" name="provider">
              <?php foreach ($providers as $provider) :
                $selected = ($provider['id'] == $default_provider_id) ? 'selected' : ''; ?>
                <option value="<?php echo $provider['id']; ?>" <?php echo $selected; ?>><?php echo ucwords($provider['name']); ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="n_voucher">N° comprobante: </label>
            <input class="form-control" type="text" name="n_voucher" id="n_voucher">
          </div>
          <table class="table table-bordered">
            <thead>
              <th><span class="glyphicon glyphicon-shopping-cart"></span> Producto </th>
              <th><span class="glyphicon glyphicon-bullhorn"></span> Stock </th>
              <th> Precio Compra (S/ )</th>
              <th><span class="glyphicon glyphicon-tags"></span> Cantidad </th>
              <th> Total (S/)</th>
              <th><span class="glyphicon glyphicon-exclamation-sign"></span> Acciones</th>
            </thead>
            <tbody id="product_list_i">
              <!-- Aquí se cargarán los productos buscados -->
            </tbody>
          </table>
        </form>
        <br>
        <div>
          <h3><b>Compras acumuladas:</b></h3>
          <br>
          <form method="post" action="add.php">
            <p id="num_voucher"></p>
            <p id="idProvider"></p>
            <table class="table table-bordered">
              <thead>
                <th><span class="glyphicon glyphicon-shopping-cart"></span> Producto </th>
                <th> Precio Compra (S/)</th>
                <th><span class="glyphicon glyphicon-tags"></span> Cantidad </th>
                <th> Total (S/)</th>
                <th><span class="glyphicon glyphicon-exclamation-sign"></span> Acciones</th>
              </thead>
              <tbody id="product_info_i"> <!-- Esta es la tabla que acumula los productos seleccionados -->
                <!-- Aquí se agregarán los productos seleccionados para la venta -->
                <input type="hidden" name="p_id" id="provider_id">
                <input type="hidden" name="n_v" id="n_vouch">
              </tbody>
              <tfoot id="subtotal"></tfoot>
            </table>
            <button type="submit" id="save-income" class="btn btn-primary" name="add_incomes" disabled><span class="glyphicon glyphicon-floppy-saved"></span> Registrar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Modal para mostrar mensaje de venta registrada -->
<div class="modal fade" id="saleModal" tabindex="-1" role="dialog" aria-labelledby="saleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="saleModalLabel">Compra Registrada</h4>
      </div>
      <div class="modal-body">
        La compra ha sido registrada exitosamente.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<?php include_once('../../layouts/footer.php'); ?>