<?php
$page_title = 'Lista de usuarios';
require_once('includes/load.php');
?>
<?php
// Checkin What level user has permission to view this page
page_require_level(1);
//pull out all user form database
$all_users = find_all_user();
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
          <span>Usuarios</span>
        </strong>
        <a href="add_user.php" class="btn btn-info pull-right btn-sm"><span class="glyphicon glyphicon-new-window"></span> Agregar</a>
      </div>
      <div class="panel-body">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th class="text-center" style="width: 50px;"><b>#</b></th>
              <th><span class="glyphicon glyphicon-menu-hamburger"></span> Nombre</th>
              <th><span class="glyphicon glyphicon-user"></span> Usuario</th>
              <th class="text-center" style="width: 15%;"><span class="glyphicon glyphicon-signal"></span> Rol</th>
              <th class="text-center" style="width: 10%;"><span class="glyphicon glyphicon-unchecked"></span> Estado</th>
              <th style="width: 20%;"><span class="glyphicon glyphicon-time"></span> Último login</th>
              <th class="text-center" style="width: 120px;"><span class="glyphicon glyphicon-exclamation-sign"></span> Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($all_users as $a_user) : ?>
              <tr>
                <td class="text-center"><?php echo count_id(); ?></td>
                <td><?php echo remove_junk(ucwords($a_user['name'])) ?></td>
                <td><?php echo remove_junk(ucwords($a_user['username'])) ?></td>
                <td class="text-center"><?php echo remove_junk(ucwords($a_user['group_name'])) ?></td>
                <td class="text-center">
                  <?php if ($a_user['status'] === '1') : ?>
                    <span class="label label-success"><?php echo "Activo"; ?></span>
                  <?php else : ?>
                    <span class="label label-danger"><?php echo "Inactivo"; ?></span>
                  <?php endif; ?>
                </td>
                <td><?php echo read_date($a_user['last_login']) ?></td>
                <td class="text-center">
                  <div class="btn-group">
                    <a href="edit_user.php?id=<?php echo (int)$a_user['id']; ?>" class="btn btn-xs btn-info" data-toggle="tooltip" title="Editar">
                      <i class="glyphicon glyphicon-pencil"></i>
                    </a>
                    <a href="javascript:void(0);" data-id="<?php echo (int)$a_user['id']; ?>" class="btn btn-xs btn-danger delete-user" data-toggle="tooltip" title="Eliminar">
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
<!-- Modal de Confirmación -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="confirmDeleteModalLabel">Confirmar Eliminación</h4>
      </div>
      <div class="modal-body">
        ¿Estás seguro de que deseas eliminar este usuario?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" id="confirmDeleteBtnUser">Eliminar</button>
      </div>
    </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>