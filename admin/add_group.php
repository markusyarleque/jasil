<?php
$page_title = 'Agregar grupo';
require_once('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(1);
?>
<?php
if (isset($_POST['add'])) {

  $req_fields = array('group-name', 'group-level');
  validate_fields($req_fields);

  if (find_by_groupName($_POST['group-name']) === false) {
    $session->msg('d', '<b>Error!</b> El nombre de grupo realmente existe en la base de datos');
    redirect('add_group.php', false);
  } elseif (find_by_groupLevel($_POST['group-level']) === false) {
    $session->msg('d', '<b>Error!</b> El nombre de grupo realmente existe en la base de datos ');
    redirect('add_group.php', false);
  }
  if (empty($errors)) {
    $name = remove_junk($db->escape($_POST['group-name']));
    $level = remove_junk($db->escape($_POST['group-level']));
    $status = remove_junk($db->escape($_POST['status']));

    $query  = "INSERT INTO user_groups (";
    $query .= "group_name,group_level,group_status";
    $query .= ") VALUES (";
    $query .= " '{$name}', '{$level}','{$status}'";
    $query .= ")";
    if ($db->query($query)) {
      //sucess
      $session->msg('s', "El grupo ha sido creado! ");
      redirect('add_group.php', false);
    } else {
      //failed
      $session->msg('d', 'Lamentablemente no se pudo crear el grupo!');
      redirect('add_group.php', false);
    }
  } else {
    $session->msg("d", $errors);
    redirect('add_group.php', false);
  }
}
?>
<?php include_once('layouts/header.php'); ?>
<div class="login-page">
  <div class="text-center">
    <a href="group.php" class="close-button pull-right btn-xs" title="Cerrar"><span class="	glyphicon glyphicon-remove"></span></a>
    <h3>Crear nuevo grupo de usuarios</h3>
  </div>
  <hr style="height:2px;border-width:0;color:gray;background-color:gray">
  <?php echo display_msg($msg); ?>
  <form method="post" action="add_group.php" class="clearfix">
    <div class="form-group">
      <label for="name" class="control-label"><span class="glyphicon glyphicon-menu-hamburger"></span> Nombre del grupo</label>
      <input type="name" class="form-control" name="group-name" required>
    </div>
    <div class="form-group">
      <label for="level" class="control-label"><span class="glyphicon glyphicon-level-up"></span> Nivel del grupo</label>
      <input type="number" class="form-control" name="group-level">
    </div>
    <div class="form-group">
      <label for="status"><span class="glyphicon glyphicon-unchecked"></span> Estado</label>
      <select class="form-control" name="status">
        <option value="1">Activo</option>
        <option value="0">Inactivo</option>
      </select>
    </div>
    <div class="form-group clearfix">
      <button type="submit" name="add" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-saved"></span> Guardar</button>
    </div>
  </form>
</div>

<?php include_once('layouts/footer.php'); ?>