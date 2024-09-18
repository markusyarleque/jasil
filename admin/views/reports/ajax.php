<?php
require_once('../../includes/load.php');
if (!$session->isUserLoggedIn(true)) {
  redirect('index.php', false);
}

// Auto suggestion
$html = '';
if (isset($_POST['customer']) && strlen($_POST['customer'])) {
  $customers = find_customers($_POST['customer']);
  if ($customers) {
    foreach ($customers as $customer):
      $html .= "<li class=\"list-group-item\">";
      $html .= $customer['name'];
      $html .= "</li>";
    endforeach;
  } else {
    $html .= '<li class="list-group-item">Cliente no encontrado</li>';
  }
  echo json_encode($html);
}

// Find all customers
if (isset($_POST['c_name']) && strlen($_POST['c_name'])) {
  $customer = remove_junk($db->escape($_POST['c_name']));
  if ($results = find_customers($customer)) {
    foreach ($results as $result) {
      $response = array(
        'clie_value' => $result['name'], // Valor para #clie_input
        'clie_id' => $result['id'] // Valor para #otro_contenedor
      );
      /*$html .= "<input type=\"hidden\" name=\"c_id\" value=\"{$result['id']}\" id=\"c_id\">";
      $html .= "<p> Cliente: <span>" . $result['name'] . "</span></p>";
      $html .= "<p>" . $result['short_description'] . ": <span>" . $result['document'] . "</span></p>";*/
    }
  } else {
    $response = array(
      'clie_value' => 'El cliente no se encuentra registrado en la base de datos',
      'clie_id' => ''
    );
  }
  echo json_encode($response);
}
