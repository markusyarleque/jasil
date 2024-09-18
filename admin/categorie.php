<?php
$page_title = 'Lista de categorías';
require_once('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(1);

$all_categories = find_all('categories')
?>
<?php
if (isset($_POST['add_cat'])) {
  $req_field = array('categorie-name');
  validate_fields($req_field);
  $cat_name = remove_junk($db->escape($_POST['categorie-name']));
  if (empty($errors)) {
    $sql  = "INSERT INTO categories (name)";
    $sql .= " VALUES ('{$cat_name}')";
    if ($db->query($sql)) {
      $session->msg("s", "Categoría agregada exitosamente.");
      redirect('categorie.php', false);
    } else {
      $session->msg("d", "Lo siento, registro falló");
      redirect('categorie.php', false);
    }
  } else {
    $session->msg("d", $errors);
    redirect('categorie.php', false);
  }
}
?>
<?php include_once('layouts/header.php'); ?>

<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>
<div class="row">
  <div class="col-md-5">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Agregar categoría</span>
        </strong>
      </div>
      <div class="panel-body">
        <form method="post" action="categorie.php">
          <div class="form-group">
            <input type="text" class="form-control" name="categorie-name" placeholder="Nombre de la categoría" required>
          </div>
          <button type="submit" name="add_cat" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-saved"></span> Agregar categoría</button>
        </form>
      </div>
    </div>
  </div>
  <div class="col-md-7">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Lista de categorías</span>
        </strong>
      </div>
      <div class="panel-body">
        <table class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th class="text-center" style="width: 50px;">#</th>
              <th><span class="	glyphicon glyphicon-list-alt"></span> Categorías</th>
              <th class="text-center" style="width: 120px;"><span class="glyphicon glyphicon-exclamation-sign"></span> Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($all_categories as $cat): ?>
              <tr>
                <td class="text-center"><?php echo count_id(); ?></td>
                <td><?php echo remove_junk(ucfirst($cat['name'])); ?></td>
                <td class="text-center">
                  <div class="btn-group">
                    <a href="edit_categorie.php?id=<?php echo (int)$cat['id']; ?>" class="btn btn-xs btn-info" data-toggle="tooltip" title="Editar">
                      <span class="glyphicon glyphicon-pencil"></span>
                    </a>
                    <a href="javascript:void(0);" data-id="<?php echo (int)$cat['id']; ?>" class="btn btn-xs btn-danger delete-categorie" data-toggle="tooltip" title="Eliminar">
                      <span class="glyphicon glyphicon-trash"></span>
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
</div>
<!-- Modal de Confirmación -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="confirmDeleteModalLabel">Confirmar Eliminación</h4>
      </div>
      <div class="modal-body">
        ¿Estás seguro de que deseas eliminar esta categoría?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" id="confirmDeleteBtnCategorie">Eliminar</button>
      </div>
    </div>
  </div>
</div>
<?php include_once('layouts/footer.php'); ?>