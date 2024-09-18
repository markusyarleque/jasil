<?php
$page_title = 'Lista de grupos';
require_once('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(1);
$all_groups = find_all('user_groups');
?>
<?php include_once('layouts/header.php'); ?>
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
          <span>Grupos</span>
        </strong>
        <a href="add_group.php" class="btn btn-info pull-right btn-sm"><span class="glyphicon glyphicon-new-window"></span> Agregar</a>
      </div>
      <div class="panel-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th class="text-center" style="width: 50px;"><b>#</b></th>
              <th><span class="glyphicon glyphicon-menu-hamburger"></span> Nombre</th>
              <th class="text-center" style="width: 20%;"><span class="glyphicon glyphicon-level-up"></span> Nivel</th>
              <th class="text-center" style="width: 15%;"><span class="glyphicon glyphicon-unchecked"></span> Estado</th>
              <th class="text-center" style="width: 120px;"><span class="glyphicon glyphicon-exclamation-sign"></span> Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($all_groups as $a_group): ?>
              <tr>
                <td class="text-center"><?php echo count_id(); ?></td>
                <td><?php echo remove_junk(ucwords($a_group['group_name'])) ?></td>
                <td class="text-center">
                  <?php echo remove_junk(ucwords($a_group['group_level'])) ?>
                </td>
                <td class="text-center">
                  <?php if ($a_group['group_status'] === '1'): ?>
                    <span class="label label-success"><?php echo "Activo"; ?></span>
                  <?php else: ?>
                    <span class="label label-danger"><?php echo "Inactivo"; ?></span>
                  <?php endif; ?>
                </td>
                <td class="text-center">
                  <div class="btn-group">
                    <a href="edit_group.php?id=<?php echo (int)$a_group['id']; ?>" class="btn btn-xs btn-info" data-toggle="tooltip" title="Editar">
                      <i class="glyphicon glyphicon-pencil"></i>
                    </a>
                    <a href="delete_group.php?id=<?php echo (int)$a_group['id']; ?>" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Eliminar">
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
<?php include_once('layouts/footer.php'); ?>