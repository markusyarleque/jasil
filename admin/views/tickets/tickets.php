<?php
$page_title = 'Lista de tickets';
require_once('../../includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(3);
//pull out all sales form database
$tickets = find_all_ticket();
?>
<?php include_once('../../layouts/header.php'); ?>
<div class="row">
    <div class="col-md-6">
        <?php echo display_msg($msg); ?>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <strong>
                    <span class="glyphicon glyphicon-th"></span>
                    <span>Boletas</span>
                </strong>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 40px;"><b>#</b></th>
                            <th style="width: 50%;"><span class="glyphicon glyphicon-link"></span> URL </th>
                            <th class="text-center" style="width: 25%;"><span class="glyphicon glyphicon-calendar"></span> Fecha de registro</th>
                            <th class="text-center" style="width: 15%;"><span class="glyphicon glyphicon-user"></span> Vendedor </th>
                            <th class="text-center" style="width: 120px;"><span class="glyphicon glyphicon-file"></span> Ver </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tickets as $ticket) : ?>
                            <tr>
                                <td class="text-center"><?php echo count_id(); ?></td>
                                <td><?php echo remove_junk($ticket['url']); ?></td>
                                <td class="text-center"><?php echo $ticket['registration_date']; ?></td>
                                <td><?php echo remove_junk($ticket['name']); ?></td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="<?php echo remove_junk($ticket['url']); ?>" class="btn btn-lg" title="Imprimir" data-toggle="tooltip" target="_blank">
                                            <img src="../../libs/images/pdf.png" alt="Imprimir" style="width: 32px; height: 32px;">
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
<?php include_once('../../layouts/footer.php'); ?>