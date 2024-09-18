<?php
$page_title = 'Lista de imagenes';
require_once('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(2);
?>
<?php $media_files = find_all('media'); ?>
<?php
if (isset($_POST['submit'])) {
  $photo = new Media();
  $photo->upload($_FILES['file_upload']);
  if ($photo->process_media()) {
    $session->msg('s', 'Imagen subida al servidor.');
    redirect('media.php');
  } else {
    $session->msg('d', join($photo->errors));
    redirect('media.php');
  }
}

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>

  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>
          <span class="glyphicon glyphicon-camera"></span>
          <span>Lista de imágenes</span>
        </strong>
        <div class="pull-right">
          <form class="form-inline" action="media.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <div class="input-group">
                <!-- Nuevo elemento para mostrar el nombre del archivo -->
                <span id="file-name" style="margin-left: 10px;margin-right:5px"> </span>
                <label class="btn btn-default btn-file">
                  Seleccionar archivo <input type="file" name="file_upload" multiple="multiple" style="display: none;" />
                </label>
                <button type="submit" name="submit" class="btn btn-info">Subir</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="panel-body">
        <table class="table">
          <thead>
            <tr>
              <th class="text-center" style="width: 20px;"><b>#</b></th>
              <th class="text-center"><span class="glyphicon glyphicon-picture"></span> Imagen</th>
              <th class="text-center"><span class="glyphicon glyphicon-menu-hamburger"></span> Descripción</th>
              <th class="text-center" style="width: 20%;"><span class="glyphicon glyphicon-camera"></span> Tipo</th>
              <th class="text-center" style="width: 120px;"><span class="glyphicon glyphicon-exclamation-sign"></span> Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($media_files as $media_file): ?>
              <tr class="list-inline">
                <td class="text-center"><?php echo count_id(); ?></td>
                <td class="text-center">
                  <img src="uploads/products/<?php echo $media_file['file_name']; ?>" class="img-thumbnail" />
                </td>
                <td class="text-center">
                  <?php echo $media_file['file_name']; ?>
                </td>
                <td class="text-center">
                  <?php echo $media_file['file_type']; ?>
                </td>
                <td class="text-center">
                  <a href="javascript:void(0);" data-id="<?php echo (int) $media_file['id']; ?>" class="btn btn-danger btn-xs delete-media" title="Eliminar">
                    <span class="glyphicon glyphicon-trash"></span>
                  </a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
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
        ¿Estás seguro de que deseas eliminar esta imagen?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" id="confirmDeleteBtnMedia">Eliminar</button>
      </div>
    </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>