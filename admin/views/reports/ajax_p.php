<?php
require_once('../../includes/load.php');
if (!$session->isUserLoggedIn(true)) {
  redirect('index.php', false);
}

// Auto suggestion
$html = '';
if (isset($_POST['provider']) && strlen($_POST['provider'])) {
  $providers = find_providers($_POST['provider']);
  if ($providers) {
    foreach ($providers as $provider):
      $html .= "<li class=\"list-group-item\">";
      $html .= $provider['name'];
      $html .= "</li>";
    endforeach;
  } else {
    $html .= '<li class="list-group-item">Proveedor no encontrado</li>';
  }
  echo json_encode($html);
}

// Find all providers
if (isset($_POST['p_name']) && strlen($_POST['p_name'])) {
  $provider = remove_junk($db->escape($_POST['p_name']));
  if ($results = find_providers($provider)) {
    foreach ($results as $result) {
      $response = array(
        'prov_value' => $result['name'], // Valor para #prov_input
        'prov_id' => $result['id'] // Valor para #otro_contenedor
      );
    }
  } else {
    $response = array(
      'prov_value' => 'El proveedor no se encuentra registrado en la base de datos',
      'prov_id' => ''
    );
  }
  echo json_encode($response);
}
