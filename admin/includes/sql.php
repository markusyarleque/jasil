<?php
require_once('load.php');

/*--------------------------------------------------------------*/
/* Function for find all database table rows by table name
/*--------------------------------------------------------------*/
function find_all($table)
{
  global $db;
  if (tableExists($table)) {
    return find_by_sql("SELECT * FROM " . $db->escape($table));
  }
}
/*--------------------------------------------------------------*/
/* Function for Perform queries
/*--------------------------------------------------------------*/
function find_by_sql($sql)
{
  global $db;
  $result = $db->query($sql);
  if ($result === false) {
    echo "Error en la consulta find_by_sql: " . $db->error;
    return false;
  }
  $result_set = $db->while_loop($result);
  return $result_set;
}
/*--------------------------------------------------------------*/
/*  Function for Find data from table by id
/*--------------------------------------------------------------*/
function find_by_id($table, $id)
{
  global $db;
  $id = (int)$id;
  if (tableExists($table)) {
    $sql = $db->query("SELECT * FROM {$db->escape($table)} WHERE id='{$db->escape($id)}' LIMIT 1");
    if ($result = $db->fetch_assoc($sql))
      return $result;
    else
      return null;
  }
}
/*--------------------------------------------------------------*/
/* Function for Delete data from table by id
/*--------------------------------------------------------------*/
function delete_by_id($table, $id)
{
  global $db;
  if (tableExists($table)) {
    $sql = "DELETE FROM " . $db->escape($table);
    $sql .= " WHERE id=" . $db->escape($id);
    $sql .= " LIMIT 1";
    $db->query($sql);
    return ($db->affected_rows() === 1) ? true : false;
  }
}
/*--------------------------------------------------------------*/
/* Function for Count id  By table name
/*--------------------------------------------------------------*/

function count_by_id($table)
{
  global $db;
  if (tableExists($table)) {
    $sql    = "SELECT COUNT(id) AS total FROM " . $db->escape($table);
    $result = $db->query($sql);
    if ($result === false) {
      echo "Error en la consulta count by table: " . $db->error;
      return false;
    }
    return ($db->fetch_assoc($result));
  }
}
/*--------------------------------------------------------------*/
/* Determine if database table exists
/*--------------------------------------------------------------*/
function tableExists($table)
{
  global $db;
  $table_exit = $db->query('SHOW TABLES FROM ' . DB_NAME . ' LIKE "' . $db->escape($table) . '"');
  if ($table_exit) {
    if ($db->num_rows($table_exit) > 0)
      return true;
    else
      return false;
  }
}
/*--------------------------------------------------------------*/
/* Login with the data provided in $_POST,
 /* coming from the login form.
/*--------------------------------------------------------------*/
function authenticate($username = '', $password = '')
{
  global $db;
  $username = $db->escape($username);
  $password = $db->escape($password);
  $sql  = sprintf("SELECT id,username,password,user_level FROM users WHERE username ='%s' LIMIT 1", $username);
  $result = $db->query($sql);
  if ($db->num_rows($result)) {
    $user = $db->fetch_assoc($result);
    $password_request = sha1($password);
    if ($password_request === $user['password']) {
      return $user['id'];
    }
  }
  return false;
}
/*--------------------------------------------------------------*/
/* Login with the data provided in $_POST,
  /* coming from the login_v2.php form.
  /* If you used this method then remove authenticate function.
 /*--------------------------------------------------------------*/
function authenticate_v2($username = '', $password = '')
{
  global $db;
  $username = $db->escape($username);
  $password = $db->escape($password);
  $sql  = sprintf("SELECT id,username,password,user_level FROM users WHERE username ='%s' LIMIT 1", $username);
  $result = $db->query($sql);
  if ($db->num_rows($result)) {
    $user = $db->fetch_assoc($result);
    $password_request = sha1($password);
    if ($password_request === $user['password']) {
      return $user;
    }
  }
  return false;
}


/*--------------------------------------------------------------*/
/* Find current log in user by session id
  /*--------------------------------------------------------------*/
function current_user()
{
  static $current_user;
  global $db;
  if (!$current_user) {
    if (isset($_SESSION['user_id'])) :
      $user_id = intval($_SESSION['user_id']);
      $current_user = find_by_id('users', $user_id);
    endif;
  }
  return $current_user;
}
/*--------------------------------------------------------------*/
/* Find all user by
  /* Joining users table and user gropus table
  /*--------------------------------------------------------------*/
function find_all_user()
{
  global $db;
  $results = array();
  $sql = "SELECT u.id,u.name,u.username,u.user_level,u.status,u.last_login,";
  $sql .= "g.group_name ";
  $sql .= "FROM users u ";
  $sql .= "LEFT JOIN user_groups g ";
  $sql .= "ON g.group_level=u.user_level ORDER BY u.name ASC";
  $result = find_by_sql($sql);
  if ($result === false) {
    echo "Error en la consulta para obtener todos los users: " . $db->error;
    return false;
  }
  return $result;
}
/*--------------------------------------------------------------*/
/* Function to update the last log in of a user
  /*--------------------------------------------------------------*/

function updateLastLogIn($user_id)
{
  global $db;
  $date = make_date();
  $sql = "UPDATE users SET last_login='{$date}' WHERE id ='{$user_id}' LIMIT 1";
  $result = $db->query($sql);
  if ($result === false) {
    echo "Error en la consulta para obtener el último login: " . $db->error;
    return false;
  }

  return ($result && $db->affected_rows() === 1 ? true : false);
}

/*--------------------------------------------------------------*/
/* Find all Group name
  /*--------------------------------------------------------------*/
function find_by_groupName($val)
{
  global $db;
  $sql = "SELECT group_name FROM user_groups WHERE group_name = '{$db->escape($val)}' LIMIT 1 ";
  $result = $db->query($sql);
  return ($db->num_rows($result) === 0 ? true : false);
}
/*--------------------------------------------------------------*/
/* Find group level
  /*--------------------------------------------------------------*/
function find_by_groupLevel($level)
{
  global $db;
  $sql = "SELECT * FROM user_groups WHERE group_level = '{$db->escape($level)}' LIMIT 1 ";
  $result = find_by_sql($sql);
  if ($result === false) {
    echo "Error en la consulta para obtener el groupLevel: " . $db->error;
    return false;
  }
  return $result;
}
/*--------------------------------------------------------------*/
/* Function for cheaking which user level has access to page
  /*--------------------------------------------------------------*/
function page_require_level($require_level)
{
  global $session;
  $current_user = current_user();
  $login_level = find_by_groupLevel($current_user['user_level']);
  //if user not login
  if (!$session->isUserLoggedIn(true)) :
    $session->msg('d', 'Por favor, inicia sesión...');
    redirect('index.php', false);
  //if Group status Desactive
  elseif ($login_level[0]['group_status'] === 0) :
    $session->msg('d', 'Este nivel de usuario está inactivo!');
    redirect('home.php', false);
  //cheacking log in User level and Require level is Less than or equal to
  elseif ($current_user['user_level'] <= (int)$require_level) :
    return true;
  else :
    $session->msg("d", "¡Lo siento!  No tienes permiso para ver la página.");
    redirect('home.php', false);
  endif;
}
/*--------------------------------------------------------------*/
/* Function for Finding all product name
   /* JOIN with categorie  and media database table
   /*--------------------------------------------------------------*/
function join_product_table()
{
  global $db;
  $sql  = " SELECT p.id,p.name,p.stock,p.buy_price,p.sale_price,p.media_id,p.date,c.name";
  $sql  .= " AS categorie,m.file_name AS image";
  $sql  .= " FROM products p";
  $sql  .= " LEFT JOIN categories c ON c.id = p.categorie_id";
  $sql  .= " LEFT JOIN media m ON m.id = p.media_id";
  $sql  .= " ORDER BY p.id ASC";
  return find_by_sql($sql);
}
/*--------------------------------------------------------------*/
/* Function for Finding all product name
  /* Request coming from ajax.php for auto suggest
  /*--------------------------------------------------------------*/

function find_product_by_title($product_name)
{
  global $db;
  $p_name = remove_junk($db->escape($product_name));
  $sql = "SELECT name FROM products WHERE name like '%$p_name%' LIMIT 5";
  $result = find_by_sql($sql);
  return $result;
}

/*--------------------------------------------------------------*/
/* Function for Finding all product info by product title
  /* Request coming from ajax.php
  /*--------------------------------------------------------------*/
function find_all_product_info_by_title($title)
{
  global $db;
  $sql  = "SELECT * FROM products ";
  $sql .= " WHERE name ='{$title}'";
  $sql .= " LIMIT 1";
  return find_by_sql($sql);
}

/*--------------------------------------------------------------*/
/* Function for Update product stock
  /*--------------------------------------------------------------*/
function update_product_qty($qty, $p_id)
{
  global $db;
  $qty = (int) $qty;
  $id  = (int)$p_id;
  $sql = "UPDATE products SET stock=stock -'{$qty}' WHERE id = '{$id}'";
  $result = $db->query($sql);
  return ($db->affected_rows() === 1 ? true : false);
}
/*--------------------------------------------------------------*/
/* Function for Display Recent product Added
  /*--------------------------------------------------------------*/
function find_recent_product_added($limit)
{
  global $db;
  $sql   = " SELECT p.id,p.name,p.sale_price,p.media_id,c.name AS categorie,";
  $sql  .= "m.file_name AS image FROM products p";
  $sql  .= " LEFT JOIN categories c ON c.id = p.categorie_id";
  $sql  .= " LEFT JOIN media m ON m.id = p.media_id";
  $sql  .= " ORDER BY p.id DESC LIMIT " . $db->escape((int)$limit);
  return find_by_sql($sql);
}
/*--------------------------------------------------------------*/
/* Function for Find Highest saleing Product
 /*--------------------------------------------------------------*/
function find_higest_saleing_product($limit)
{
  global $db;
  $sql  = "SELECT p.name, SUM(s.subtotal) AS totalSold, SUM(s.qty) AS totalQty";
  $sql .= " FROM sales s";
  $sql .= " LEFT JOIN products p ON p.id = s.product_id ";
  $sql .= " GROUP BY s.product_id";
  $sql .= " ORDER BY SUM(s.qty) DESC LIMIT " . $db->escape((int)$limit);
  return $db->query($sql);
}
/*--------------------------------------------------------------*/
/* Function for find all sales
 /*--------------------------------------------------------------*/
function find_all_sale()
{
  global $db;
  $sql  = "SELECT s.id,c.name AS customer,s.qty,s.subtotal,s.date,p.name, p.sale_price,u.name AS saler";
  $sql .= " FROM sales s";
  $sql .= " JOIN products p ON s.product_id = p.id";
  $sql .= " JOIN customers c ON s.customer = c.id";
  $sql .= " JOIN users u ON s.saler = u.id";
  $sql .= " ORDER BY s.date DESC";
  return find_by_sql($sql);
}
/*--------------------------------------------------------------*/
/* Function for Display Recent sale
 /*--------------------------------------------------------------*/
function find_recent_sale_added($limit)
{
  global $db;
  $sql  = "SELECT s.id,s.qty,s.subtotal,s.date,p.name";
  $sql .= " FROM sales s";
  $sql .= " LEFT JOIN products p ON s.product_id = p.id";
  $sql .= " ORDER BY s.date DESC LIMIT " . $db->escape((int)$limit);
  return find_by_sql($sql);
}
/*--------------------------------------------------------------*/
/* Function for Generate sales report by two dates
/*--------------------------------------------------------------*/
function find_sale_by_dates($start_date, $end_date)
{
  global $db;
  $start_date  = date("Y-m-d", strtotime($start_date));
  $end_date    = date("Y-m-d", strtotime($end_date));
  $end_date = date("Y-m-d", strtotime($end_date . ' +1 day'));
  $sql = "SELECT s.qty,";
  $sql .= " s.date,p.name, ROUND(p.sale_price, 2) as sale_price, ROUND(p.buy_price, 2) as buy_price, ROUND(s.subtotal * 0.18, 2) as igv, ";
  $sql .= " ROUND(p.sale_price * s.qty, 2) as total_saleing_price, ";
  $sql .= " ROUND(p.buy_price * s.qty, 2) as total_buying_price, ";
  $sql .= "ROUND(s.subtotal - (s.subtotal * 0.18), 2) as subtotal, ";
  $sql .= " c.document as document_client, c.name as name_client, d.short_description as document_type ";
  $sql .= " FROM sales s";
  $sql .= " INNER JOIN products p ON s.product_id = p.id";
  $sql .= " INNER JOIN customers c ON s.customer = c.id";
  $sql .= " INNER JOIN document_type d ON c.document_type = d.id";
  $sql .= " WHERE s.date BETWEEN '{$start_date}' AND '{$end_date}'";
  //$sql .= " GROUP BY DATE(s.date),p.name";
  $sql .= " ORDER BY DATE(s.date) DESC";
  $result = $db->query($sql);
  if ($result === false) {
    echo "Error en la consulta para obtener las ventas por fecha: " . $db->error;
    return false;
  }

  return $db->while_loop($result);
}
/*--------------------------------------------------------------*/
/* Function for Generate Daily sales report
/*--------------------------------------------------------------*/
function  dailySales($year, $month, $day)
{
  global $db;
  // Asegurarse de que el mes tenga dos dígitos
  $month = str_pad($month, 2, '0', STR_PAD_LEFT);
  $day = str_pad($day, 2, '0', STR_PAD_LEFT);

  $sql  = "SELECT s.qty,";
  $sql .= " s.date,p.name, ROUND(p.sale_price, 2) as sale_price, ROUND(s.subtotal * 0.18, 2) as igv, ";
  $sql .= " ROUND(s.subtotal, 2) as total_saleing_price, ";
  $sql .= "ROUND(s.subtotal - (s.subtotal * 0.18), 2) as subtotal, ";
  $sql .= " c.document as document_client, c.name as name_client, d.short_description as document_type ";
  $sql .= " FROM sales s";
  $sql .= " INNER JOIN products p ON s.product_id = p.id";
  $sql .= " INNER JOIN customers c ON s.customer = c.id";
  $sql .= " INNER JOIN document_type d ON c.document_type = d.id";
  $sql .= " WHERE DATE_FORMAT(s.date, '%Y-%m-%d' ) = '{$year}-{$month}-{$day}'";
  //$sql .= " GROUP BY DATE_FORMAT( s.date,  '%e' ),s.product_id";
  return find_by_sql($sql);
}
/*--------------------------------------------------------------*/
/* Function for Generate Daily sales report x customer
/*--------------------------------------------------------------*/
function dailySalesxCustomer($year, $month, $day, $customer)
{
  global $db;
  // Asegurarse de que el mes tenga dos dígitos
  $month = str_pad($month, 2, '0', STR_PAD_LEFT);
  $day = str_pad($day, 2, '0', STR_PAD_LEFT);

  $sql  = "SELECT s.qty,";
  $sql .= " s.date,p.name, ROUND(p.sale_price, 2) as sale_price, ROUND(s.subtotal * 0.18, 2) as igv, ";
  $sql .= " ROUND(s.subtotal, 2) as total_saleing_price, ";
  $sql .= "ROUND(s.subtotal - (s.subtotal * 0.18), 2) as subtotal, ";
  $sql .= " c.document as document_client, c.name as name_client, d.short_description as document_type ";
  $sql .= " FROM sales s";
  $sql .= " INNER JOIN products p ON s.product_id = p.id";
  $sql .= " INNER JOIN customers c ON s.customer = c.id";
  $sql .= " INNER JOIN document_type d ON c.document_type = d.id";
  $sql .= " WHERE DATE_FORMAT(s.date, '%Y-%m-%d' ) = '{$year}-{$month}-{$day}'";
  $sql .= " AND c.id = '{$customer}'";
  //$sql .= " GROUP BY DATE_FORMAT( s.date,  '%e' ),s.product_id";
  return find_by_sql($sql);
}
/*--------------------------------------------------------------*/
/* Function for Generate Monthly sales report
/*--------------------------------------------------------------*/
function  monthlySales($year, $month)
{
  global $db;
  // Asegurarse de que el mes tenga dos dígitos
  $month = str_pad($month, 2, '0', STR_PAD_LEFT);

  $sql  = "SELECT s.qty,";
  $sql .= " s.date,p.name, ROUND(p.sale_price, 2) as sale_price, ROUND(s.subtotal * 0.18, 2) as igv, ";
  $sql .= " ROUND(s.subtotal, 2) as total_saleing_price, ";
  $sql .= "ROUND(s.subtotal - (s.subtotal * 0.18), 2) as subtotal, ";
  $sql .= " c.document as document_client, c.name as name_client, d.short_description as document_type ";
  $sql .= " FROM sales s";
  $sql .= " INNER JOIN products p ON s.product_id = p.id";
  $sql .= " INNER JOIN customers c ON s.customer = c.id";
  $sql .= " INNER JOIN document_type d ON c.document_type = d.id";
  $sql .= " WHERE DATE_FORMAT(s.date, '%Y-%m' ) = '{$year}-{$month}'";
  //$sql .= " GROUP BY DATE_FORMAT( s.date,  '%e' ),s.product_id";
  return find_by_sql($sql);
}
/*--------------------------------------------------------------*/
/* Function for Generate Monthly sales report x customer
/*--------------------------------------------------------------*/
function monthlySalesxCustomer($year, $month, $customer)
{
  global $db;
  // Asegurarse de que el mes tenga dos dígitos
  $month = str_pad($month, 2, '0', STR_PAD_LEFT);

  $sql  = "SELECT s.qty,";
  $sql .= " s.date,p.name, ROUND(p.sale_price, 2) as sale_price, ROUND(s.subtotal * 0.18, 2) as igv, ";
  $sql .= " ROUND(s.subtotal, 2) as total_saleing_price, ";
  $sql .= "ROUND(s.subtotal - (s.subtotal * 0.18), 2) as subtotal, ";
  $sql .= " c.document as document_client, c.name as name_client, d.short_description as document_type ";
  $sql .= " FROM sales s";
  $sql .= " INNER JOIN products p ON s.product_id = p.id";
  $sql .= " INNER JOIN customers c ON s.customer = c.id";
  $sql .= " INNER JOIN document_type d ON c.document_type = d.id";
  $sql .= " WHERE DATE_FORMAT(s.date, '%Y-%m' ) = '{$year}-{$month}'";
  $sql .= " AND c.id = '{$customer}'";
  //$sql .= " GROUP BY DATE_FORMAT( s.date,  '%e' ),s.product_id";
  return find_by_sql($sql);
}
/*--------------------------------------------------------------*/
/* Function for Generate Annually sales report
/*--------------------------------------------------------------*/
function  annuallySales($year)
{
  global $db;
  $sql  = "SELECT s.qty,";
  $sql .= " s.date, p.name, ROUND(p.buy_price, 2) as buy_price, ROUND(p.sale_price, 2) as sale_price, ROUND(s.subtotal * 0.18, 2) as igv, ";
  $sql .= " ROUND(s.subtotal, 2) as total_saleing_price, ";
  $sql .= "ROUND(s.subtotal - (s.subtotal * 0.18), 2) as subtotal, ";
  $sql .= " c.document as document_client, c.name as name_client, d.short_description as document_type ";
  $sql .= " FROM sales s";
  $sql .= " INNER JOIN products p ON s.product_id = p.id";
  $sql .= " INNER JOIN customers c ON s.customer = c.id";
  $sql .= " INNER JOIN document_type d ON c.document_type = d.id";
  $sql .= " WHERE DATE_FORMAT(s.date, '%Y' ) = '{$year}'";
  $sql .= " ORDER BY date_format(s.date, '%c' ) ASC";
  return find_by_sql($sql);
}
/*--------------------------------------------------------------*/
/* Function for Generate Annually sales report x Customer
/*--------------------------------------------------------------*/
function  annuallySalesxCustomer($year, $customer)
{
  global $db;
  $sql  = "SELECT s.qty,";
  $sql .= " s.date, p.name, ROUND(p.buy_price, 2) as buy_price, ROUND(p.sale_price, 2) as sale_price, ROUND(s.subtotal * 0.18, 2) as igv, ";
  $sql .= " ROUND(s.subtotal, 2) as total_saleing_price, ";
  $sql .= "ROUND(s.subtotal - (s.subtotal * 0.18), 2) as subtotal, ";
  $sql .= " c.document as document_client, c.name as name_client, d.short_description as document_type ";
  $sql .= " FROM sales s";
  $sql .= " INNER JOIN products p ON s.product_id = p.id";
  $sql .= " INNER JOIN customers c ON s.customer = c.id";
  $sql .= " INNER JOIN document_type d ON c.document_type = d.id";
  $sql .= " WHERE DATE_FORMAT(s.date, '%Y' ) = '{$year}'";
  $sql .= " AND c.id = '{$customer}'";
  $sql .= " ORDER BY date_format(s.date, '%c' ) ASC";
  return find_by_sql($sql);
}
/*--------------------------------------------------------------*/
/* Find all customer by
  /* Joining users table
  /*--------------------------------------------------------------*/
function find_all_customer()
{
  global $db;
  $results = array();
  $sql = "SELECT c.id,t.short_description,c.document,c.name,c.registration_date,c.modification_date,c.address,";
  $sql .= "u.name AS registered_by, m.name AS modified_by ";
  $sql .= "FROM customers c ";
  $sql .= "JOIN users u ";
  $sql .= "ON u.id=c.registered_by ";
  $sql .= "JOIN users m ";
  $sql .= "ON m.id=c.modified_by ";
  $sql .= "JOIN document_type t ";
  $sql .= "ON t.id = c.document_type ORDER BY c.name ASC";
  $result = find_by_sql($sql);
  return $result;
}
/*--------------------------------------------------------------*/
/*  Function for Find customers by document
/*--------------------------------------------------------------*/
function find_customer_by_doc($type, $doc)
{
  global $db;
  $sql = $db->query("SELECT * FROM customers WHERE document_type='{$db->escape($type)}' and document='{$db->escape($doc)}' LIMIT 1");
  if ($result = $db->fetch_assoc($sql))
    return $result;
  else
    return null;
}
function get_next_ai($table)
{
  global $db;
  if (tableExists($table)) {
    $table = $db->escape($table);
    $sql    = "SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME='$table'";
    $result = $db->query($sql);
    if ($result === false) {
      echo "Error en la consulta get_next_ai: " . $db->error;
      return false;
    }
    $row = $db->fetch_assoc($result);
    return $row ? $row['AUTO_INCREMENT'] : false;
  }
  return false;
}
/*--------------------------------------------------------------*/
/* Function for find all tickets
 /*--------------------------------------------------------------*/
function find_all_ticket()
{
  global $db;
  $sql  = "SELECT t.id,t.url,u.name,t.registration_date,";
  $sql .= "SUBSTRING_INDEX(SUBSTRING_INDEX(t.url, '/', -1), '-', 1) AS n_boleta ";
  $sql .= " FROM tickets t";
  $sql .= " JOIN users u ON t.registered_by = u.id";
  $sql .= " ORDER BY t.registration_date DESC";
  return find_by_sql($sql);
}

/*--------------------------------------------------------------*/
/* Function for Finding all customers
  /* Request coming from ajax.php for auto suggest
  /*--------------------------------------------------------------*/

function find_customers($customer)
{
  global $db;
  $p_name = remove_junk($db->escape($customer));
  $sql = "SELECT c.*, d.short_description FROM customers c INNER JOIN document_type d ON c.document_type = d.id WHERE c.name like '%$p_name%' OR c.document like '%$p_name%' LIMIT 5 ";
  $result = find_by_sql($sql);
  return $result;
}
/*--------------------------------------------------------------*/
/* Function for find all incomes
 /*--------------------------------------------------------------*/
function find_all_income()
{
  global $db;
  $sql  = "SELECT i.id,pr.name AS provider,i.qty,i.subtotal,i.date, i.num_voucher, i.igv,p.name, p.sale_price, p.buy_price,u.name AS buyer";
  $sql .= " FROM incomes i";
  $sql .= " JOIN products p ON i.product_id = p.id";
  $sql .= " JOIN providers pr ON i.provider = pr.id";
  $sql .= " JOIN users u ON i.buyer = u.id";
  $sql .= " ORDER BY i.date DESC";
  return find_by_sql($sql);
}
/*--------------------------------------------------------------*/
/* Find all provider by
  /* Joining users table
  /*--------------------------------------------------------------*/
function find_all_provider()
{
  global $db;
  $results = array();
  $sql = "SELECT p.id,t.short_description,p.document,p.name,p.registration_date,p.modification_date,p.address,";
  $sql .= "u.name AS registered_by, m.name AS modified_by ";
  $sql .= "FROM providers p ";
  $sql .= "JOIN users u ";
  $sql .= "ON u.id=p.registered_by ";
  $sql .= "JOIN users m ";
  $sql .= "ON m.id=p.modified_by ";
  $sql .= "JOIN document_type t ";
  $sql .= "ON t.id = p.document_type ORDER BY p.name ASC";
  $result = find_by_sql($sql);
  return $result;
}
/*--------------------------------------------------------------*/
/*  Function for Find providers by document
/*--------------------------------------------------------------*/
function find_provider_by_doc($type, $doc)
{
  global $db;
  $sql = $db->query("SELECT * FROM providers WHERE document_type='{$db->escape($type)}' and document='{$db->escape($doc)}' LIMIT 1");
  if ($result = $db->fetch_assoc($sql))
    return $result;
  else
    return null;
}
/*--------------------------------------------------------------*/
/*  Function for Find incomes by num_voucher
/*--------------------------------------------------------------*/
function find_incomes_by_voucher($num)
{
  global $db;
  $sql = $db->query("SELECT * FROM incomes WHERE num_voucher='{$db->escape($num)}' LIMIT 1");
  if ($result = $db->fetch_assoc($sql))
    return $result;
  else
    return null;
}
/*--------------------------------------------------------------*/
/* Function for Generate incomes report by two dates
/*--------------------------------------------------------------*/
function find_income_by_dates($start_date, $end_date)
{
  global $db;
  $start_date  = date("Y-m-d", strtotime($start_date));
  $end_date    = date("Y-m-d", strtotime($end_date));
  $end_date = date("Y-m-d", strtotime($end_date . ' +1 day'));
  $sql = "SELECT i.qty,";
  $sql .= " i.date,p.name, ROUND(p.sale_price, 2) as sale_price, ROUND(p.buy_price, 2) as buy_price, i.igv, ";
  $sql .= " ROUND(p.sale_price * i.qty, 2) as total_saleing_price, ";
  $sql .= " ROUND(p.buy_price * i.qty, 2) as total_buying_price, ";
  $sql .= "ROUND(i.subtotal - (i.subtotal * 0.18), 2) as subtotal, ";
  $sql .= " pr.document as document_provider, pr.name as name_provider, d.short_description as document_type ";
  $sql .= " FROM incomes i";
  $sql .= " INNER JOIN products p ON i.product_id = p.id";
  $sql .= " INNER JOIN providers pr ON i.provider = pr.id";
  $sql .= " INNER JOIN document_type d ON pr.document_type = d.id";
  $sql .= " WHERE i.date BETWEEN '{$start_date}' AND '{$end_date}'";
  //$sql .= " GROUP BY DATE(s.date),p.name";
  $sql .= " ORDER BY DATE(i.date) DESC";
  $result = $db->query($sql);
  if ($result === false) {
    echo "Error en la consulta para obtener las ventas por fecha: " . $db->error;
    return false;
  }

  return $db->while_loop($result);
}
/*--------------------------------------------------------------*/
/* Function for Generate Daily incomes report
/*--------------------------------------------------------------*/
function  dailyIncomes($year, $month, $day)
{
  global $db;
  // Asegurarse de que el mes tenga dos dígitos
  $month = str_pad($month, 2, '0', STR_PAD_LEFT);
  $day = str_pad($day, 2, '0', STR_PAD_LEFT);

  $sql = "SELECT i.qty,";
  $sql .= " i.date,p.name, ROUND(p.sale_price, 2) as sale_price, ROUND(p.buy_price, 2) as buy_price, i.igv, ";
  $sql .= " ROUND(p.sale_price * i.qty, 2) as total_saleing_price, ";
  $sql .= " ROUND(p.buy_price * i.qty, 2) as total_buying_price, ";
  $sql .= "ROUND(i.subtotal - (i.subtotal * 0.18), 2) as subtotal, ";
  $sql .= " pr.document as document_provider, pr.name as name_provider, d.short_description as document_type ";
  $sql .= " FROM incomes i";
  $sql .= " INNER JOIN products p ON i.product_id = p.id";
  $sql .= " INNER JOIN providers pr ON i.provider = pr.id";
  $sql .= " INNER JOIN document_type d ON pr.document_type = d.id";
  $sql .= " WHERE DATE_FORMAT(i.date, '%Y-%m-%d' ) = '{$year}-{$month}-{$day}'";
  //$sql .= " GROUP BY DATE_FORMAT( s.date,  '%e' ),s.product_id";
  return find_by_sql($sql);
}
/*--------------------------------------------------------------*/
/* Function for Generate Daily sales report x provider
/*--------------------------------------------------------------*/
function dailyIncomesxProvider($year, $month, $day, $provider)
{
  global $db;
  // Asegurarse de que el mes tenga dos dígitos
  $month = str_pad($month, 2, '0', STR_PAD_LEFT);
  $day = str_pad($day, 2, '0', STR_PAD_LEFT);

  $sql = "SELECT i.qty,";
  $sql .= " i.date,p.name, ROUND(p.sale_price, 2) as sale_price, ROUND(p.buy_price, 2) as buy_price, i.igv, ";
  $sql .= " ROUND(p.sale_price * i.qty, 2) as total_saleing_price, ";
  $sql .= " ROUND(p.buy_price * i.qty, 2) as total_buying_price, ";
  $sql .= "ROUND(i.subtotal - (i.subtotal * 0.18), 2) as subtotal, ";
  $sql .= " pr.document as document_provider, pr.name as name_provider, d.short_description as document_type ";
  $sql .= " FROM incomes i";
  $sql .= " INNER JOIN products p ON i.product_id = p.id";
  $sql .= " INNER JOIN providers pr ON i.provider = pr.id";
  $sql .= " INNER JOIN document_type d ON pr.document_type = d.id";
  $sql .= " WHERE DATE_FORMAT(i.date, '%Y-%m-%d' ) = '{$year}-{$month}-{$day}'";
  $sql .= " AND pr.id = '{$provider}'";
  //$sql .= " GROUP BY DATE_FORMAT( s.date,  '%e' ),s.product_id";
  return find_by_sql($sql);
}
/*--------------------------------------------------------------*/
/* Function for Generate Monthly incomes report
/*--------------------------------------------------------------*/
function  monthlyIncomes($year, $month)
{
  global $db;
  // Asegurarse de que el mes tenga dos dígitos
  $month = str_pad($month, 2, '0', STR_PAD_LEFT);

  $sql = "SELECT i.qty,";
  $sql .= " i.date,p.name, ROUND(p.sale_price, 2) as sale_price, ROUND(p.buy_price, 2) as buy_price, i.igv, ";
  $sql .= " ROUND(p.sale_price * i.qty, 2) as total_saleing_price, ";
  $sql .= " ROUND(p.buy_price * i.qty, 2) as total_buying_price, ";
  $sql .= "ROUND(i.subtotal - (i.subtotal * 0.18), 2) as subtotal, ";
  $sql .= " pr.document as document_provider, pr.name as name_provider, d.short_description as document_type ";
  $sql .= " FROM incomes i";
  $sql .= " INNER JOIN products p ON i.product_id = p.id";
  $sql .= " INNER JOIN providers pr ON i.provider = pr.id";
  $sql .= " INNER JOIN document_type d ON pr.document_type = d.id";
  $sql .= " WHERE DATE_FORMAT(i.date, '%Y-%m' ) = '{$year}-{$month}'";
  //$sql .= " GROUP BY DATE_FORMAT( s.date,  '%e' ),s.product_id";
  return find_by_sql($sql);
}
/*--------------------------------------------------------------*/
/* Function for Generate Monthly incomes report x provider
/*--------------------------------------------------------------*/
function monthlyIncomesxProvider($year, $month, $provider)
{
  global $db;
  // Asegurarse de que el mes tenga dos dígitos
  $month = str_pad($month, 2, '0', STR_PAD_LEFT);

  $sql = "SELECT i.qty,";
  $sql .= " i.date,p.name, ROUND(p.sale_price, 2) as sale_price, ROUND(p.buy_price, 2) as buy_price, i.igv, ";
  $sql .= " ROUND(p.sale_price * i.qty, 2) as total_saleing_price, ";
  $sql .= " ROUND(p.buy_price * i.qty, 2) as total_buying_price, ";
  $sql .= "ROUND(i.subtotal - (i.subtotal * 0.18), 2) as subtotal, ";
  $sql .= " pr.document as document_provider, pr.name as name_provider, d.short_description as document_type ";
  $sql .= " FROM incomes i";
  $sql .= " INNER JOIN products p ON i.product_id = p.id";
  $sql .= " INNER JOIN providers pr ON i.provider = pr.id";
  $sql .= " INNER JOIN document_type d ON pr.document_type = d.id";
  $sql .= " WHERE DATE_FORMAT(i.date, '%Y-%m' ) = '{$year}-{$month}'";
  $sql .= " AND pr.id = '{$provider}'";
  //$sql .= " GROUP BY DATE_FORMAT( s.date,  '%e' ),s.product_id";
  return find_by_sql($sql);
}
/*--------------------------------------------------------------*/
/* Function for Generate Annually incomes report
/*--------------------------------------------------------------*/
function  annuallyIncomes($year)
{
  global $db;
  $sql = "SELECT i.qty,";
  $sql .= " i.date,p.name, ROUND(p.sale_price, 2) as sale_price, ROUND(p.buy_price, 2) as buy_price, i.igv, ";
  $sql .= " ROUND(p.sale_price * i.qty, 2) as total_saleing_price, ";
  $sql .= " ROUND(p.buy_price * i.qty, 2) as total_buying_price, ";
  $sql .= "ROUND(i.subtotal - (i.subtotal * 0.18), 2) as subtotal, ";
  $sql .= " pr.document as document_provider, pr.name as name_provider, d.short_description as document_type ";
  $sql .= " FROM incomes i";
  $sql .= " INNER JOIN products p ON i.product_id = p.id";
  $sql .= " INNER JOIN providers pr ON i.provider = pr.id";
  $sql .= " INNER JOIN document_type d ON pr.document_type = d.id";
  $sql .= " WHERE DATE_FORMAT(i.date, '%Y' ) = '{$year}'";
  $sql .= " ORDER BY date_format(i.date, '%c' ) ASC";
  return find_by_sql($sql);
}
/*--------------------------------------------------------------*/
/* Function for Generate Annually incomes report x Provider
/*--------------------------------------------------------------*/
function  annuallyIncomesxProvider($year, $provider)
{
  global $db;
  $sql = "SELECT i.qty,";
  $sql .= " i.date,p.name, ROUND(p.sale_price, 2) as sale_price, ROUND(p.buy_price, 2) as buy_price, i.igv, ";
  $sql .= " ROUND(p.sale_price * i.qty, 2) as total_saleing_price, ";
  $sql .= " ROUND(p.buy_price * i.qty, 2) as total_buying_price, ";
  $sql .= "ROUND(i.subtotal - (i.subtotal * 0.18), 2) as subtotal, ";
  $sql .= " pr.document as document_provider, pr.name as name_provider, d.short_description as document_type ";
  $sql .= " FROM incomes i";
  $sql .= " INNER JOIN products p ON i.product_id = p.id";
  $sql .= " INNER JOIN providers pr ON i.provider = pr.id";
  $sql .= " INNER JOIN document_type d ON pr.document_type = d.id";
  $sql .= " WHERE DATE_FORMAT(i.date, '%Y' ) = '{$year}'";
  $sql .= " AND pr.id = '{$provider}'";
  $sql .= " ORDER BY date_format(i.date, '%c' ) ASC";
  return find_by_sql($sql);
}

/*--------------------------------------------------------------*/
/* Function for Finding all providers
  /* Request coming from ajax_p.php for auto suggest
  /*--------------------------------------------------------------*/

function find_providers($provider)
{
  global $db;
  $p_name = remove_junk($db->escape($provider));
  $sql = "SELECT p.*, d.short_description FROM providers p INNER JOIN document_type d ON p.document_type = d.id WHERE p.name like '%$p_name%' OR p.document like '%$p_name%' LIMIT 5 ";
  $result = find_by_sql($sql);
  return $result;
}
/*--------------------------------------------------------------*/
/* Function for find content from sections
 /*--------------------------------------------------------------*/
function find_content($section)
{
  global $db;
  $sql  = "SELECT * FROM sections WHERE name = '$section'";
  return find_by_sql($sql);
}
/*--------------------------------------------------------------*/
/* Function for find emails from sections
 /*--------------------------------------------------------------*/
function find_emails($email)
{
  global $db;
  $sql = $db->query("SELECT * FROM emails_suscriptions WHERE email='{$db->escape($email)}'");
  if ($result = $db->fetch_assoc($sql))
    return $result;
  else
    return null;
}
/*--------------------------------------------------------------*/
/* Function for find ip from sections
 /*--------------------------------------------------------------*/
function find_ip($ip)
{
  global $db;
  $sql = $db->query("SELECT count(*) AS total FROM emails_suscriptions WHERE ip_address='{$db->escape($ip)}' AND created_at > NOW() - INTERVAL 10 MINUTE");
  if ($result = $db->fetch_assoc($sql))
    return $result['total'];
  else
    return null;
}
