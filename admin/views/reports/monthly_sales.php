<?php
$page_title = 'Ventas mensuales';
require_once('../../includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(3);

$year  = date('Y');
$month = date('m');
$mes_anio = name_month((int)date('m')) . ' ' . $year;

// Si la solicitud es AJAX, procesar y devolver solo JSON
if (isset($_POST['month']) && isset($_POST['year'])) {
  $year = (int)$_POST['year'];
  $month = (int)$_POST['month'];
  $customer = isset($_POST['c_id']) ? (int)$_POST['c_id'] : null;
  $mes_anio = name_month($month) . ' ' . $year;
  if ($customer != null && $customer != 0) {
    $sales = monthlySalesxCustomer($year, $month, $customer);
  } else {
    $sales = monthlySales($year, $month);
  }

  $table_data = '';
  $sum_importe = 0;
  $sum_igv = 0;
  $sum_total = 0;
  if (empty($sales)) {
    $table_data .= '<tr><td colspan="12" class="text-center">No se encontraron registros.</td></tr>';
  } else {
    foreach ($sales as $sale) {
      $table_data .= '<tr>';
      $table_data .= '<td class="text-center">' . count_id() . '</td>';
      $table_data .= '<td class="text-center">' . date("d/m/Y", strtotime($sale['date'])) . '</td>';
      $table_data .= '<td class="text-center">' . date("H:i:s", strtotime($sale['date'])) . '</td>';
      $table_data .= '<td>' . remove_junk($sale['name_client']) . '</td>';
      $table_data .= '<td class="text-center">' . remove_junk($sale['document_client']) . '</td>';
      $table_data .= '<td>' . remove_junk($sale['name']) . '</td>';
      $table_data .= '<td class="text-center">' . (int)$sale['qty'] . '</td>';
      $table_data .= '<td class="text-center">' . (int)$sale['sale_price'] . '</td>';
      $table_data .= '<td class="text-right">' . remove_junk($sale['subtotal']) . '</td>';
      $table_data .= '<td class="text-right">' . remove_junk($sale['igv']) . '</td>';
      $table_data .= '<td class="text-right">' . remove_junk($sale['total_saleing_price']) . '</td>';
      $table_data .= '</tr>';
      $sum_importe += $sale['subtotal'];
      $sum_igv += $sale['igv'];
      $sum_total += $sale['total_saleing_price'];
    }
  }

  // Devolver solo los datos de la tabla en JSON
  header('Content-Type: application/json');
  echo json_encode([
    'table_data' => $table_data,
    'year' => $year,
    'month' => $month,
    'customer' => $customer,
    'sum_importe' => number_format($sum_importe, 2),
    'sum_igv' => number_format($sum_igv, 2),
    'sum_total' => number_format($sum_total, 2)
  ]);
  exit; // Detener la ejecución aquí para evitar incluir HTML
}
if (isset($_POST['SSC'])) {
  $customer = isset($_POST['c_id']) ? (int)$_POST['c_id'] : null;
  if ($customer != null && $customer != 0) {
    $sales = monthlySalesxCustomer($year, $month, $customer);
  } else {
    $sales = monthlySales($year, $month);
  }
} else {
  $sales = monthlySales($year, $month);
}
?>
<?php include_once('../../layouts/header.php'); ?>
<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
    <form method="post" action="ajax.php" autocomplete="off" id="clie-form">
      <div class="form-group">
        <div class="input-group">
          <span class="input-group-btn">
            <button type="submit" class="btn btn-primary">Cliente</button>
          </span>
          <input type="text" id="clie_input" class="form-control" name="title" placeholder="Buscar por cliente">
        </div>
        <div id="result" class="list-group"></div>
      </div>
    </form>
  </div>
  <div class="col-md-6">
    <form method="post" action="monthly_sales.php" autocomplete="off" id="search-clie">
      <div class="form-group">
        <div class="input-group">
          <input type="hidden" name="c_id" id="salesxclie">
          <span class="input-group-btn">
            <button type="submit" class="btn btn-primary" name="SSC">🔍</button>
          </span>
        </div>
      </div>
    </form>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>
          <form>
            <div class="form-row">
              <div class="form-group col-md-2">
                <span class="glyphicon glyphicon-th"></span>
                <span>Periodo: </span>
              </div>
              <div class="form-group col-md-2">
                <select class="form-control" name="select_month" id="s_month">
                  <?php for ($i = 1; $i <= 12; $i++): ?>
                    <option <?php if ($i == $month) echo 'selected="selected"'; ?> value="<?php echo $i; ?>">
                      <?php echo name_month($i); ?>
                    </option>
                  <?php endfor; ?>
                </select>
              </div>
              <div class="form-group col-md-2">
                <select class="form-control" name="select_year_month" id="s_year">
                  <?php for ($i = 2023; $i <= 2030; $i++): ?>
                    <option <?php if ($i == $year) echo 'selected="selected"'; ?> value="<?php echo $i; ?>">
                      <?php echo $i; ?>
                    </option>
                  <?php endfor; ?>
                </select>
              </div>
            </div>
          </form>
        </strong>
      </div>
      <div class="panel-body">
        <p class="tittle_table">Registro de ventas</p>
        <div class="tittle_client" id="idCliente">
          <!-- Aquí se cargará el cliente buscado -->
        </div>
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th class="text-center" style="width: 3%;" rowspan="2">#</th>
              <th class="text-center" style="width: 8%;" rowspan="2">Fecha</th>
              <th class="text-center" style="width: 8%;" rowspan="2">Hora</th>
              <th class="text-center" style="width: 26%;" colspan="2">Cliente</th>
              <th class="text-center" style="width: 27%;" colspan="3">Producto</th>
              <th class="text-center" style="width: 9%;" rowspan="2">Importe</th>
              <th class="text-center" style="width: 9%;" rowspan="2">IGV</th>
              <th class="text-center" style="width: 10%;" rowspan="2">Total</th>
            </tr>
            <tr>
              <th class="text-center" style="width: 13%;">Nombre</th>
              <th class="text-center" style="width: 13%;">Documento</th>
              <th class="text-center" style="width: 9%;">Desc.</th>
              <th class="text-center" style="width: 9%;">Cantidad</th>
              <th class="text-center" style="width: 9%;">Precio</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sum_importe = 0;
            $sum_igv = 0;
            $sum_total = 0;
            ?>
            <?php if (empty($sales)): ?>
              <tr>
                <td colspan="12" class="text-center">No se encontraron registros.</td>
              </tr>
            <?php else: ?>
              <?php foreach ($sales as $sale): ?>
                <tr>
                  <td class="text-center"><?php echo count_id(); ?></td>
                  <td class="text-center"><?php echo date("d/m/Y", strtotime($sale['date'])); ?></td>
                  <td class="text-center"><?php echo date("H:i:s", strtotime($sale['date'])); ?></td>
                  <td><?php echo remove_junk($sale['name_client']); ?></td>
                  <td class="text-center"><?php echo remove_junk($sale['document_client']); ?></td>
                  <td><?php echo remove_junk($sale['name']); ?></td>
                  <td class="text-center"><?php echo (int)$sale['qty']; ?></td>
                  <td class="text-center"><?php echo (int)$sale['sale_price']; ?></td>
                  <td class="text-right"><?php echo remove_junk($sale['subtotal']); ?></td>
                  <td class="text-right"><?php echo remove_junk($sale['igv']); ?></td>
                  <td class="text-right"><?php echo remove_junk($sale['total_saleing_price']); ?></td>
                </tr>
                <?php
                // Acumular los valores de subtotal, igv y total
                $sum_importe += $sale['subtotal'];
                $sum_igv += $sale['igv'];
                $sum_total += $sale['total_saleing_price'];
                ?>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
          <tfoot class="tfoot_table">
            <th class="text-right" colspan="8">Totales</th>
            <th class="text-right sum_importe"><?php echo number_format($sum_importe, 2); ?></th>
            <th class="text-right sum_igv"><?php echo number_format($sum_igv, 2); ?></th>
            <th class="text-right sum_total"><?php echo number_format($sum_total, 2); ?></th>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>

<?php include_once('../../layouts/footer.php'); ?>