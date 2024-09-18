<?php
$page_title = 'Comprobante de venta';
require_once('../../includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(3);
$user = current_user();
?>
<?php
if (isset($_SESSION['post_data'])) {
  $post_data = $_SESSION['post_data'];
  $product_ids   = $post_data['product_id'];
  $quantities   = $post_data['stock'];
  $subtotals   = $post_data['subtotal'];
  $customer   = $post_data['c_id'];
  $user_id    = (int)$user['id'];
  echo '<script>console.log(' . $product_ids . ');</script>';
} else {
  $session->msg("d", "No hay registros enviados");
  redirect('sales.php', false);
}
?>
<!doctype html>
<html lang="es">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Comprobante de venta</title>
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
      margin: 10px 0;
      text-align: center;
    }

    .sale-head h1,
    .sale-head strong {
      padding: 10px 20px;
      display: block;
    }

    .sale-head h1 {
      margin: 0;
      border-bottom: 0px solid #212121;
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
      border: 0px solid #212121;
      white-space: nowrap;
    }

    .sale-head h1,
    table thead tr th,
    table tfoot tr td {
      background-color: #f8f8f8;
    }

    .sale-ticket {
      margin: 10px 0;
      text-align: center;
      border-top: 1px solid #212121;
      white-space: nowrap;
    }

    .sale-ticket h2 {
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
  <?php if (!empty($product_ids)): ?>
    <div class="page-break">
      <div class="sale-head pull-center">
        <h1>LA CASA DE REPUESTOS</h1>
        <h3>La casa de repuestos EIRL<br>RUC 12345678900<br>Av. Perú 123, San Isidro<br>Lima - Perú</h3>
        <strong><?php echo date('Y-m-d H:i:s'); ?> </strong>
      </div>
      <div class="sale-ticket">
        <h3><strong>TICKET<br>N° </strong></h3>
      </div>
      <table class="table table-border">
        <thead>
          <tr>
            <th>Cod.</th>
            <th>Descripción</th>
            <th>Cant.</th>
            <th>P. Unit.</th>
            <th>Dscto.</th>
            <th>Importe</th>
          </tr>
        </thead>
        <tbody>
          <?php for ($i = 0; $i < count($product_ids); $i++):
          ?>
            <tr>
              <td class="text-center">#</td>
              <td class="desc">
                <?php echo remove_junk(ucfirst($product_ids[$i])); ?>
              </td>
              <td class="text-center"><?php echo remove_junk($quantities[$i]); ?></td>
              <td class="text-right"><?php echo remove_junk(ucfirst($subtotals[$i] / $quantities[$i])); ?></td>
              <td class="text-right">0.00</td>
              <td class="text-right"><?php echo remove_junk($subtotals[$i]); ?></td>
            </tr>
          <?php endfor; ?>
        </tbody>
        <tfoot>
          <tr class="text-right">
            <td colspan="3"></td>
            <td colspan="1"> Op. Gravadas </td>
            <td> S/
              <?php echo number_format(@subtotales($subtotals)[2], 2); ?>
            </td>
          </tr>
          <tr class="text-right">
            <td colspan="3"></td>
            <td colspan="1"> IGV-18% </td>
            <td> S/
              <?php echo number_format(@subtotales($subtotals)[1], 2); ?>
            </td>
          </tr>
          <tr class="text-right">
            <td colspan="3"></td>
            <td colspan="1"> Total Dsctos :</td>
            <td> S/ 0.00
            </td>
          </tr>
          <tr class="text-right">
            <td colspan="3"></td>
            <td colspan="1"> Importe Total :</td>
            <td> S/
              <?php echo number_format(@subtotales($subtotals)[0], 2); ?>
            </td>
          </tr>
        </tfoot>
      </table>
    </div>
  <?php
    unset($_SESSION['post_data']);
  else:
    $session->msg("d", "No se encontraron ventas. ");
    redirect('sales.php', false);
  endif;
  ?>
</body>

</html>
<?php if (isset($db)) {
  $db->db_disconnect();
} ?>