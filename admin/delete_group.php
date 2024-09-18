<?php
require_once('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(1);
?>
<?php
try {
  $delete_id = delete_by_id('user_groups', (int)$_GET['id']);
  if ($delete_id) {
    $session->msg("s", "Grupo eliminado");
    redirect('group.php');
  } else {
    $session->msg("d", "Eliminación falló");
    redirect('group.php');
  }
} catch (mysqli_sql_exception $e) {
  // Captura el error y establece un mensaje en la sesión
  $session->msg("d", "No puedes eliminar este grupo porque tiene usuarios relacionados.");
  redirect('group.php');
}
?>