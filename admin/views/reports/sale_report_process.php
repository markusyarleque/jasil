<?php
$page_title = 'Reporte de ventas';
$results = '';
$fecha_desde = '';
$fecha_hasta = '';
require_once('../../includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(3);
?>
<?php
if (isset($_POST['submit'])) {
  $req_dates = array('start-date', 'end-date');
  validate_fields($req_dates);

  if (empty($errors)):
    $start_date   = remove_junk($db->escape($_POST['start-date']));
    $end_date     = remove_junk($db->escape($_POST['end-date']));
    $results      = find_sale_by_dates($start_date, $end_date);
    $fecha_desde  = date("d/m/Y", strtotime($start_date));
    $fecha_hasta  = date("d/m/Y", strtotime($end_date));
  else:
    $session->msg("d", $errors);
    redirect('sales_report.php', false);
  endif;
} else {
  $session->msg("d", "Select dates");
  redirect('sales_report.php', false);
}
?>
<!doctype html>
<html lang="en-US">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Reporte de ventas</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" />
  <style>
    @media print {

      html,
      body {
        font-size: 9.5pt;
        margin: 0;
        padding: 0;
      }

      .page-break {
        page-break-before: always;
        width: auto;
        margin: auto;
      }
    }

    .page-break {
      width: 980px;
      margin: 0 auto;
    }

    .sale-head {
      margin: 40px 0;
      text-align: center;
    }

    .sale-head h1,
    .sale-head strong {
      padding: 10px 20px;
      display: block;
    }

    .sale-head h1 {
      margin: 0;
      border-bottom: 1px solid #212121;
    }

    .table>thead:first-child>tr:first-child>th {
      border-top: 1px solid #000;
    }

    table thead tr th {
      text-align: center;
      border: 1px solid #ededed;
    }

    table tbody tr td {
      vertical-align: middle;
    }

    .sale-head,
    table.table thead tr th,
    table tbody tr td,
    table tfoot tr td {
      border: 1px solid #212121;
      white-space: nowrap;
    }

    .sale-head h1,
    table thead tr th,
    table tfoot tr td {
      background-color: #f8f8f8;
    }

    tfoot {
      color: #000;
      text-transform: uppercase;
      font-weight: 500;
    }
  </style>
</head>

<body>
  <?php if ($results): ?>
    <div class="page-break">
      <div class="sale-head pull-right">
        <h1>Reporte de ventas</h1>
        <strong><?php if (isset($fecha_desde)) {
                  echo $fecha_desde;
                } ?> a <?php if (isset($fecha_hasta)) {
                          echo $fecha_hasta;
                        } ?> </strong>
      </div>
      <table class="table table-border">
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
          <?php foreach ($results as $result): ?>
            <tr>
              <td class="text-center"><?php echo count_id(); ?></td>
              <td class="text-center"><?php echo date("d/m/Y", strtotime($result['date'])); ?></td>
              <td class="text-center"><?php echo date("H:i:s", strtotime($result['date'])); ?></td>
              <td><?php echo remove_junk(ucfirst($result['name_client'])); ?></td>
              <td class="text-center"><?php echo remove_junk(ucfirst($result['document_client'])); ?></td>
              <td><?php echo remove_junk(ucfirst($result['name'])); ?></td>
              <td class="text-center"><?php echo (int)$result['qty']; ?></td>
              <td class="text-center"><?php echo (int)$result['sale_price']; ?></td>
              <td class="text-right"><?php echo remove_junk($result['subtotal']); ?></td>
              <td class="text-right"><?php echo remove_junk($result['igv']); ?></td>
              <td class="text-right"><?php echo remove_junk($result['total_saleing_price']); ?></td>
            </tr>
            <?php
            // Acumular los valores de subtotal, igv y total
            $sum_importe += $result['subtotal'];
            $sum_igv += $result['igv'];
            $sum_total += $result['total_saleing_price'];
            ?>
          <?php endforeach; ?>
        </tbody>
        <tfoot>
          <tr class="text-right">
            <td class="text-right" colspan="8">Total</td>
            <td class="text-right"> S/ <?php echo number_format($sum_importe, 2); ?></td>
            <td class="text-right"> S/ <?php echo number_format($sum_igv, 2); ?></td>
            <td class="text-right"> S/ <?php echo number_format(@total_price($results)[0], 2); ?>
            </td>
          </tr>
          <tr class="text-right">
            <td class="text-right" colspan="8">Utilidad</td>
            <td class="text-right" colspan="3"> S/ <?php echo number_format(@total_price($results)[1], 2); ?></td>
          </tr>
        </tfoot>
      </table>
    </div>
  <?php
  else:
    $session->msg("d", "No se encontraron ventas. ");
    redirect('sales_report.php', false);
  endif;
  ?>
</body>

</html>
<?php if (isset($db)) {
  $db->db_disconnect();
} ?>