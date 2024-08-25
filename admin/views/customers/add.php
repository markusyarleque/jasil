<?php
$page_title = 'Agregar clientes';
require_once('../../includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(1);
$user = current_user();
$documents = find_all('document_type');
$fechaHora = date('Y-m-d H:i:s');
?>
<?php
if (isset($_POST['add_customer'])) {

    $req_fields = array('document', 'name');
    validate_fields($req_fields);

    if (empty($errors)) {
        $document_type = (int)$db->escape($_POST['type']);
        $document   = remove_junk($db->escape($_POST['document']));
        $name   = remove_junk($db->escape($_POST['name']));
        $user_id    = (int)$user['id'];
        $e_customer = find_customer_by_doc($document_type, $document);
        if ($e_customer) {
            $session->msg("d", "El número de documento ya se encuentra registrado.");
            redirect('add.php', false);
        } else {
            $query = "INSERT INTO customers (";
            $query .= "document_type, document,name,registered_by,registration_date,modified_by,modification_date";
            $query .= ") VALUES (";
            $query .= " '{$document_type}', '{$document}', '{$name}', '{$user_id}', '{$fechaHora}', '{$user_id}','{$fechaHora}'";
            $query .= ")";
            if ($db->query($query)) {
                //sucess
                $session->msg('s', " El cliente ha sido registrado");
                redirect('add.php', false);
            } else {
                //failed
                $session->msg('d', ' No se pudo registrar al cliente.');
                redirect('add.php', false);
            }
        }
    } else {
        $session->msg("d", $errors);
        redirect('add.php', false);
    }
}
?>
<?php include_once('../../layouts/header.php'); ?>
<?php echo display_msg($msg); ?>
<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong>
                <span class="glyphicon glyphicon-th"></span>
                <span>Agregar cliente</span>
                <a href="customers.php" class="btn pull-right btn-xs" title="Cerrar"><span class="	glyphicon glyphicon-remove"></span></a>
            </strong>
        </div>
        <div class="panel-body">
            <div class="col-md-6">
                <form method="post" action="add.php">
                    <div class="form-group">
                        <label for="type"><span class="glyphicon glyphicon-th-list"></span> Tipo de documento</label>
                        <select class="form-control" name="type">
                            <?php foreach ($documents as $type) : ?>
                                <option value="<?php echo $type['id']; ?>"><?php echo ucwords($type['short_description']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="document"><span class="glyphicon glyphicon-credit-card"></span> N° Documento</label>
                        <input type="text" class="form-control" name="document" placeholder="Número de documento" required>
                    </div>
                    <div class="form-group">
                        <label for="name"><span class="glyphicon glyphicon-user"></span> Cliente</label>
                        <input type="text" class="form-control" name="name" placeholder="Nombre de cliente">
                    </div>
                    <div class="form-group">
                        <label for="address"><span class="glyphicon glyphicon-map-marker"></span> Dirección</label>
                        <textarea class="form-control" name="address" placeholder="Dirección de cliente" rows="3" cols="50"></textarea>
                    </div>
                    <div class="form-group clearfix">
                        <button type="submit" name="add_customer" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-saved"></span> Guardar</button>
                    </div>
                </form>
            </div>

        </div>

    </div>
</div>

<?php include_once('../../layouts/footer.php'); ?>