<?php
$page_title = 'Editar Proveedor';
require_once('../../includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(1);
$user = current_user();
$e_provider = find_by_id('providers', (int)$_GET['id']);
$documents = find_all('document_type');
if (!$e_provider) {
    $session->msg("d", "Missing user id.");
    redirect('providers.php');
}
$fechaHora = date('Y-m-d H:i:s');
?>

<?php
//Update User basic info
if (isset($_POST['update'])) {
    $req_fields = array('document', 'name');
    validate_fields($req_fields);
    if (empty($errors)) {
        $id = (int)$e_provider['id'];
        $document_type = (int)$db->escape($_POST['type']);
        $document   = remove_junk($db->escape($_POST['document']));
        $name   = remove_junk($db->escape($_POST['name']));
        $address   = remove_junk($db->escape($_POST['address']));
        $user_id    = (int)$user['id'];
        $sql = "UPDATE providers SET document_type ='{$document_type}', document ='{$document}',name='{$name}',address='{$address}',modified_by='{$user_id}', modification_date='{$fechaHora}' WHERE id='{$db->escape($id)}'";
        $result = $db->query($sql);
        if ($result && $db->affected_rows() === 1) {
            $session->msg('s', "EL proveedor ha sido actualizado.");
            redirect('providers.php', false);
        } else {
            $session->msg('d', ' Lo siento no se actualizó los datos.');
            redirect('edit.php?id=' . (int)$e_provider['id'], false);
        }
    } else {
        $session->msg("d", $errors);
        redirect('edit.php?id=' . (int)$e_provider['id'], false);
    }
}
?>
<?php include_once('../../layouts/header.php'); ?>
<div class="row">
    <div class="col-md-12"> <?php echo display_msg($msg); ?> </div>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>
                    <span class="glyphicon glyphicon-th"></span>
                    Actualiza proveedor: <?php echo remove_junk(ucwords($e_provider['document'])); ?>
                </strong>
            </div>
            <div class="panel-body">
                <form method="post" action="edit.php?id=<?php echo (int)$e_provider['id']; ?>" class="clearfix">
                    <div class="form-group">
                        <label for="type"><span class="glyphicon glyphicon-th-list"></span> Tipo de documento</label>
                        <select class="form-control" name="type">
                            <?php foreach ($documents as $type) : ?>
                                <option <?php if ($type['id'] === $e_provider['document_type']) echo 'selected="selected"'; ?> value="<?php echo $type['id']; ?>"><?php echo ucwords($type['short_description']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="document"><span class="glyphicon glyphicon-credit-card"></span> N° Documento</label>
                        <input type="text" class="form-control" name="document" value="<?php echo remove_junk(ucwords($e_provider['document'])); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="name"><span class="glyphicon glyphicon-user"></span> Proveedor</label>
                        <input type="text" class="form-control" name="name" value="<?php echo remove_junk(ucwords($e_provider['name'])); ?>">
                    </div>
                    <div class="form-group">
                        <label for="address"><span class="glyphicon glyphicon-map-marker"></span> Dirección</label>
                        <textarea class="form-control" name="address" rows="3" cols="50"><?php echo remove_junk(ucwords($e_provider['address'])); ?></textarea>
                    </div>
                    <div class="form-group clearfix">
                        <button type="submit" name="update" class="btn btn-info">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<?php include_once('../../layouts/footer.php'); ?>