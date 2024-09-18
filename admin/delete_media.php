<?php
require_once('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(2);
?>
<?php
try {
  $find_media = find_by_id('media', (int)$_GET['id']);
  $photo = new Media();
  if ($photo->media_destroy($find_media['id'], $find_media['file_name'])) {
    $session->msg("s", "Se ha eliminado la foto.");
    redirect('media.php');
  } else {
    $session->msg("d", "Se ha producido un error en la eliminación de fotografías.");
    redirect('media.php');
  }
} catch (mysqli_sql_exception $e) {
  // Captura el error y establece un mensaje en la sesión
  $session->msg("d", "No puedes eliminar esta imagen porque tiene productos relacionados.");
  redirect('media.php');
}
?>
