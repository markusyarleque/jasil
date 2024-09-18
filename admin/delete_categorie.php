<?php
require_once('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(1);
?>
<?php
$categorie = find_by_id('categories', (int)$_GET['id']);
if (!$categorie) {
  $session->msg("d", "ID de la categoría falta.");
  redirect('categorie.php');
}
?>
<?php
try {
  $delete_id = delete_by_id('categories', (int)$categorie['id']);
  if ($delete_id) {
    $session->msg("s", "Categoría eliminada");
    redirect('categorie.php');
  } else {
    $session->msg("d", "Eliminación falló");
    redirect('categorie.php');
  }
} catch (mysqli_sql_exception $e) {
  // Captura el error y establece un mensaje en la sesión
  $session->msg("d", "No puedes eliminar esta categoría porque tiene productos relacionados.");
  redirect('categorie.php');
}
?>
