<?php
$page_title = 'Agregar venta';
require_once('../../includes/load.php');
page_require_level(3);
$user = current_user();
$products = find_all('products');
$customers = find_all('customers');
$default_customer_id = 999999;
//obtener el siguiente autoincrement
$ai = get_next_ai('tickets');
$ai = conca0($ai);
$fecha_hora = date('dmyHis');
$nombre_archivo = 'BV' . (isset($ai) ? $ai : '999999') . '-' . $fecha_hora . '.pdf';
$ruta_archivo = ROOT_URL . '/uploads/tickets/' . $nombre_archivo;
$fechaHora = date('Y-m-d H:i:s');
?>
<?php
if (isset($_POST['add_sales'])) {
  $_SESSION['post_data'] = $_POST;
  $product_ids = $_POST['product_id'];
  $quantities = $_POST['quantity'];
  $subtotals = $_POST['subtotal'];
  $user_id    = (int)$user['id'];
  $customer =    (int)$_POST['c_id'];
  $datetime = $fecha_hora;
  echo '<script>console.log("Valor de customer: ' . $customer . '");</script>';
  if (!empty($product_ids)) {
    $query_values = [];
    for ($i = 0; $i < count($product_ids); $i++) {
      $product_id = (int)$db->escape($product_ids[$i]);
      $quantity = remove_junk($db->escape($quantities[$i]));
      $subtotal   = remove_junk($db->escape($subtotals[$i]));

      $query_values[] = "('{$customer}', '{$product_id}', '{$quantity}', '{$subtotal}', '{$fechaHora}', '{$user_id}')";
    }
    if (!empty($query_values)) {
      if (empty($errors)) {
        $query = "INSERT INTO sales (customer, product_id, qty, subtotal, date, saler) VALUES ";
        $query .= implode(", ", $query_values);
        $query_tickets = "INSERT INTO tickets (url, registered_by, registration_date) VALUES ";
        $query_tickets .= "('{$ruta_archivo}', '{$user_id}', '{$fechaHora}'";
        $query_tickets .= ")";

        if ($db->query($query)) {
          //sucess
          if ($db->query($query_tickets)) {
            echo '<script type="text/javascript">',
            'window.onload = function() {',
            '$("#saleModal").modal("show");',
            '};',
            '</script>';
          } else {
            //failed
            $session->msg('d', ' No se pudo registrar el ticket.');
          }
        } else {
          //failed
          $session->msg('d', ' No se pudo registrar la venta.');
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
    <form method="post" action="ajax.php" autocomplete="off" id="sug-form">
      <div class="form-group">
        <div class="input-group">
          <span class="input-group-btn">
            <button type="submit" class="btn btn-primary">Búsqueda</button>
          </span>
          <input type="text" id="sug_input" class="form-control" name="title" placeholder="Buscar por el nombre del producto">
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
          <span>Agregar venta</span>
          <a href="sales.php" class="btn pull-right btn-xs" title="Cerrar"><span class="	glyphicon glyphicon-remove"></span></a>
        </strong>
      </div>
      <div class="panel-body">
        <form method="post" action="">
          <div class="form-group" id="customer">
            <label for="customer">Cliente: </label>
            <select class="form-control" name="customer">
              <?php foreach ($customers as $customer) :
                $selected = ($customer['id'] == $default_customer_id) ? 'selected' : ''; ?>
                <option value="<?php echo $customer['id']; ?>" <?php echo $selected; ?>><?php echo ucwords($customer['name']); ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <table class="table table-bordered">
            <thead>
              <th><span class="glyphicon glyphicon-shopping-cart"></span> Producto </th>
              <th><span class="glyphicon glyphicon-bullhorn"></span> Stock </th>
              <th> Precio (S/)</th>
              <th><span class="glyphicon glyphicon-tags"></span> Cantidad </th>
              <th> Total (S/)</th>
              <th><span class="glyphicon glyphicon-exclamation-sign"></span> Acciones</th>
            </thead>
            <tbody id="product_list">
              <!-- Aquí se cargarán los productos buscados -->
            </tbody>
          </table>
        </form>
        <br>
        <div>
          <h3><b>Ventas acumuladas:</b></h3>
          <br>
          <p id="idCliente"></p>
          <form method="post" action="add.php">
            <table class="table table-bordered">
              <thead>
                <th><span class="glyphicon glyphicon-shopping-cart"></span> Producto </th>
                <th> Precio (S/)</th>
                <th><span class="glyphicon glyphicon-tags"></span> Cantidad </th>
                <th> Total (S/)</th>
                <th><span class="glyphicon glyphicon-exclamation-sign"></span> Acciones</th>
              </thead>
              <tbody id="product_info"> <!-- Esta es la tabla que acumula los productos seleccionados -->
                <!-- Aquí se agregarán los productos seleccionados para la venta -->
                <input type="hidden" name="c_id" id="customer_id">
              </tbody>
              <tfoot id="subtotal"></tfoot>
            </table>
            <button type="submit" id="save-sale" class="btn btn-primary" name="add_sales" disabled><span class="glyphicon glyphicon-floppy-saved"></span> Registrar</button>
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
        <h4 class="modal-title" id="saleModalLabel">Venta Registrada</h4>
      </div>
      <div class="modal-body">
        La venta ha sido registrada exitosamente.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="view-receipt">Ver Boleta</button>
      </div>
    </div>
  </div>
</div>
<?php include_once('../../layouts/footer.php'); ?>