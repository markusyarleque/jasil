<?php
$page_title = 'Compras diarias';
require_once('../../includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(3);

$year  = date('Y');
$month = date('m');
$day = date('d');

// Si la solicitud es AJAX, procesar y devolver solo JSON
if (isset($_POST['day']) && isset($_POST['month']) && isset($_POST['year'])) {
    $year = (int)$_POST['year'];
    $month = (int)$_POST['month'];
    $day = (int)$_POST['day'];
    $provider = isset($_POST['p_id']) ? (int)$_POST['p_id'] : null;
    $mes_anio = name_month($month) . ' ' . $year;
    if ($provider != null && $provider != 0) {
        $incomes = dailyIncomesxProvider($year, $month, $day, $provider);
    } else {
        $incomes = dailyIncomes($year, $month, $day);
    }

    $table_data = '';
    $sum_importe = 0;
    $sum_igv = 0;
    $sum_total = 0;
    if (empty($incomes)) {
        $table_data .= '<tr><td colspan="12" class="text-center">No se encontraron registros.</td></tr>';
    } else {
        foreach ($incomes as $income) {
            $table_data .= '<tr>';
            $table_data .= '<td class="text-center">' . count_id() . '</td>';
            $table_data .= '<td class="text-center">' . date("d/m/Y", strtotime($income['date'])) . '</td>';
            $table_data .= '<td class="text-center">' . date("H:i:s", strtotime($income['date'])) . '</td>';
            $table_data .= '<td>' . remove_junk($income['name_provider']) . '</td>';
            $table_data .= '<td class="text-center">' . remove_junk($income['document_provider']) . '</td>';
            $table_data .= '<td>' . remove_junk($income['name']) . '</td>';
            $table_data .= '<td class="text-center">' . (int)$income['qty'] . '</td>';
            $table_data .= '<td class="text-center">' . (int)$income['buy_price'] . '</td>';
            $table_data .= '<td class="text-right">' . remove_junk($income['subtotal']) . '</td>';
            $table_data .= '<td class="text-right">' . remove_junk($income['igv']) . '</td>';
            $table_data .= '<td class="text-right">' . remove_junk($income['total_buying_price']) . '</td>';
            $table_data .= '</tr>';
            $sum_importe += $income['subtotal'];
            $sum_igv += $income['igv'];
            $sum_total += $income['total_buying_price'];
        }
    }

    // Devolver solo los datos de la tabla en JSON
    header('Content-Type: application/json');
    echo json_encode([
        'table_data' => $table_data,
        'year' => $year,
        'month' => $month,
        'day' => $day,
        'provider' => $provider,
        'sum_importe' => number_format($sum_importe, 2),
        'sum_igv' => number_format($sum_igv, 2),
        'sum_total' => number_format($sum_total, 2)
    ]);
    exit; // Detener la ejecución aquí para evitar incluir HTML
}
if (isset($_POST['SSC'])) {
    $provider = isset($_POST['p_id']) ? (int)$_POST['p_id'] : null;
    if ($provider != null && $provider != 0) {
        $incomes = dailyIncomesxProvider($year, $month, $day, $provider);
    } else {
        $incomes = dailyIncomes($year, $month, $day);
    }
} else {
    $incomes = dailyIncomes($year, $month, $day);
}
?>
<?php include_once('../../layouts/header.php'); ?>
<div class="row">
    <div class="col-md-6">
        <?php echo display_msg($msg); ?>
        <form method="post" action="ajax_p.php" autocomplete="off" id="prov-form">
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-primary">Proveedor</button>
                    </span>
                    <input type="text" id="prov_input" class="form-control" name="title" placeholder="Buscar por proveedor">
                </div>
                <div id="result" class="list-group"></div>
            </div>
        </form>
    </div>
    <div class="col-md-6">
        <form method="post" action="daily_income.php" autocomplete="off" id="search-prov">
            <div class="form-group">
                <div class="input-group">
                    <input type="hidden" name="p_id" id="incomesxprov">
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
                                <select class="form-control" name="select_day_i" id="s_day">
                                    <?php for ($i = 1; $i <= 30; $i++): ?>
                                        <option <?php if ($i == $day) echo 'selected="selected"'; ?> value="<?php echo $i; ?>">
                                            <?php echo $i; ?>
                                        </option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <select class="form-control" name="select_month_daily_i" id="s_month_daily">
                                    <?php for ($i = 1; $i <= 12; $i++): ?>
                                        <option <?php if ($i == $month) echo 'selected="selected"'; ?> value="<?php echo $i; ?>">
                                            <?php echo name_month($i); ?>
                                        </option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <select class="form-control" name="select_year_daily_i" id="s_year_daily">
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
                <p class="tittle_table">Registro de compras</p>
                <div class="tittle_prov" id="idProvider">
                    <!-- Aquí se cargará el cliente buscado -->
                </div>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 3%;" rowspan="2">#</th>
                            <th class="text-center" style="width: 8%;" rowspan="2">Fecha</th>
                            <th class="text-center" style="width: 8%;" rowspan="2">Hora</th>
                            <th class="text-center" style="width: 26%;" colspan="2">Proveedor</th>
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
                        <?php if (empty($incomes)): ?>
                            <tr>
                                <td colspan="12" class="text-center">No se encontraron registros.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($incomes as $income): ?>
                                <tr>
                                    <td class="text-center"><?php echo count_id(); ?></td>
                                    <td class="text-center"><?php echo date("d/m/Y", strtotime($income['date'])); ?></td>
                                    <td class="text-center"><?php echo date("H:i:s", strtotime($income['date'])); ?></td>
                                    <td><?php echo remove_junk($income['name_provider']); ?></td>
                                    <td class="text-center"><?php echo remove_junk($income['document_provider']); ?></td>
                                    <td><?php echo remove_junk($income['name']); ?></td>
                                    <td class="text-center"><?php echo (int)$income['qty']; ?></td>
                                    <td class="text-center"><?php echo (int)$income['buy_price']; ?></td>
                                    <td class="text-right"><?php echo remove_junk($income['subtotal']); ?></td>
                                    <td class="text-right"><?php echo remove_junk($income['igv']); ?></td>
                                    <td class="text-right"><?php echo remove_junk($income['total_buying_price']); ?></td>
                                </tr>
                                <?php
                                // Acumular los valores de subtotal, igv y total
                                $sum_importe += $income['subtotal'];
                                $sum_igv += $income['igv'];
                                $sum_total += $income['total_buying_price'];
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