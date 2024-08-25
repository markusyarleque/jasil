<?php
$page_title = 'Lista de proveedores';
require_once('../../includes/load.php');
?>
<?php
// Checkin What level user has permission to view this page
page_require_level(1);
//pull out all user form database
$all_customers = find_all_customer();
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
                    <span>Proveedores</span>
                </strong>
                <a href="add.php" class="btn btn-info pull-right">Agregar cliente</a>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 50px;">#</th>
                            <th>Nombre</th>
                            <th class="text-center" style="width: 15%;">Tipo Doc.</th>
                            <th>N° Doc.</th>
                            <th class="text-center" style="width: 15%;">Fecha de registro</th>
                            <th class="text-center" style="width: 10%;">Usuario de registro</th>
                            <th class="text-center" style="width: 20%;">Fecha de modificación</th>
                            <th class="text-center" style="width: 20%;">Usuario de modificación</th>
                            <th class="text-center" style="width: 100px;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($all_customers as $a_customer) : ?>
                            <tr>
                                <td class="text-center"><?php echo count_id(); ?></td>
                                <td><?php echo remove_junk(ucwords($a_customer['name'])) ?></td>
                                <td class="text-center"><?php echo remove_junk(ucwords($a_customer['short_description'])) ?></td>
                                <td><?php echo remove_junk(ucwords($a_customer['document'])) ?></td>
                                <td class="text-center"><?php echo read_date($a_customer['registration_date']) ?></td>
                                <td class="text-center"><?php echo remove_junk(ucwords($a_customer['registered_by'])) ?>
                                </td>
                                <td class="text-center"><?php echo read_date($a_customer['modification_date']) ?></td>
                                <td class="text-center"><?php echo remove_junk(ucwords($a_customer['modified_by'])) ?>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="edit.php?id=<?php echo (int)$a_customer['id']; ?>" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Editar">
                                            <i class="glyphicon glyphicon-pencil"></i>
                                        </a>
                                        <a href="delete.php?id=<?php echo (int)$a_customer['id']; ?>" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Eliminar">
                                            <i class="glyphicon glyphicon-remove"></i>
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