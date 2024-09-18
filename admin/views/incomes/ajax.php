<?php
require_once('../../includes/load.php');
if (!$session->isUserLoggedIn(true)) {
  redirect('index.php', false);
}

// Auto suggestion
$html = '';
if (isset($_POST['product_name']) && strlen($_POST['product_name'])) {
  $products = find_product_by_title($_POST['product_name']);
  if ($products) {
    foreach ($products as $product):
      $html .= "<li class=\"list-group-item\">";
      $html .= $product['name'];
      $html .= "</li>";
    endforeach;
  } else {
    $html .= '<li class="list-group-item">No encontrado</li>';
  }
  echo json_encode($html);
}

// Find all products
if (isset($_POST['p_name']) && strlen($_POST['p_name'])) {
  $product_title = remove_junk($db->escape($_POST['p_name']));
  if ($results = find_all_product_info_by_title($product_title)) {
    foreach ($results as $result) {
      $html .= "<tr>";
      $html .= "<td>" . $result['name'] . "</td>";
      $html .= "<input type=\"hidden\" name=\"s_id\" value=\"{$result['id']}\">";
      $html .= "<td><input type=\"text\" id=\"stock\" class=\"form-control\" name=\"stock\" value=\"{$result['stock']}\" readonly></td>";
      $html .= "<td><input type=\"text\" class=\"form-control\" name=\"price\" value=\"{$result['buy_price']}\" readonly></td>";
      $html .= "<td><input type=\"number\" id=\"c\" class=\"form-control\" name=\"qty\" value=\"1\" min=\"1\" max=\"{$result['stock']}\"></td>";
      $html .= "<td><input type=\"text\" class=\"form-control\" name=\"total\" readonly></td>";
      $html .= "<td><button type=\"button\" id=\"add-product\" class=\"btn btn-primary add-product\">Agregar</button></td>";
      $html .= "</tr>";
    }
  } else {
    $html = '<tr><td>El producto no se encuentra registrado en la base de datos</td></tr>';
  }
  echo json_encode($html);
}
