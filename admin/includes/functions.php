<?php
$errors = array();

/*--------------------------------------------------------------*/
/* Function for Remove escapes special
 /* characters in a string for use in an SQL statement
 /*--------------------------------------------------------------*/
function real_escape($str)
{
  global $con;
  $escape = mysqli_real_escape_string($con, $str);
  return $escape;
}
/*--------------------------------------------------------------*/
/* Function for Remove html characters
/*--------------------------------------------------------------*/
function remove_junk($str)
{
  $str = nl2br($str);
  $str = htmlspecialchars(strip_tags($str, ENT_QUOTES));
  return $str;
}
/*--------------------------------------------------------------*/
/* Function for Uppercase first character
/*--------------------------------------------------------------*/
function first_character($str)
{
  $val = str_replace('-', " ", $str);
  $val = ucfirst($val);
  return $val;
}
/*--------------------------------------------------------------*/
/* Function for Checking input fields not empty
/*--------------------------------------------------------------*/
function validate_fields($var)
{
  global $errors;
  foreach ($var as $field) {
    $val = remove_junk($_POST[$field]);
    if (isset($val) && $val == '') {
      $errors = $field . " - No puede estar en blanco.";
      return $errors;
    }
  }
}
/*--------------------------------------------------------------*/
/* Function for Display Session Message
   Ex echo displayt_msg($message);
/*--------------------------------------------------------------*/
function display_msg($msg = '')
{
  $output = array();
  if (!empty($msg)) {
    foreach ($msg as $key => $value) {
      $output  = "<div class=\"alert alert-{$key}\">";
      $output .= "<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>";
      $output .= remove_junk(first_character($value));
      $output .= "</div>";
    }
    // Agregar el script para el cierre automático
    $output .= "<script>
                  setTimeout(function() {
                    var alerts = document.querySelectorAll('.alert');
                    alerts.forEach(function(alert) {
                      alert.classList.add('fade');
                      alert.addEventListener('transitionend', function() {
                        alert.remove();
                      });
                    });
                  }, 2000); // 5000 milisegundos = 5 segundos
                </script>";
    return $output;
  } else {
    return "";
  }
}
/*--------------------------------------------------------------*/
/* Function for redirect
/*--------------------------------------------------------------*/
function redirect($url, $permanent = false)
{
  if (headers_sent() === false) {
    header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
  }

  exit();
}
/*--------------------------------------------------------------*/
/* Function for find out total saleing price, buying price and profit
/*--------------------------------------------------------------*/
function total_price($totals)
{
  $sum = 0;
  $sub = 0;
  foreach ($totals as $total) {
    $sum += $total['total_saleing_price'];
    $sub += $total['total_buying_price'];
    $profit = $sum - $sub;
  }
  return array($sum, $profit);
}
function subtotales($subtotales)
{
  $sum = 0;
  $igv = 0;
  $og = 0;
  foreach ($subtotales as $subtotal) {
    $sum += $subtotal['subtotal'];
  }
  $igv = $sum * 0.18;
  $og = $sum - $igv;
  return array($og, $igv, $sum);
}
/*--------------------------------------------------------------*/
/* Function for Readable date time
/*--------------------------------------------------------------*/
function read_date($str)
{
  if ($str)
    return date('d/m/Y g:i:s a', strtotime($str));
  else
    return null;
}
/*--------------------------------------------------------------*/
/* Function for  Readable Make date time
/*--------------------------------------------------------------*/
function make_date()
{
  return strftime("%Y-%m-%d %H:%M:%S", time());
}
/*--------------------------------------------------------------*/
/* Function for  Readable date time
/*--------------------------------------------------------------*/
function count_id()
{
  static $count = 1;
  return $count++;
}
/*--------------------------------------------------------------*/
/* Function for Creting random string
/*--------------------------------------------------------------*/
function randString($length = 5)
{
  $str = '';
  $cha = "0123456789abcdefghijklmnopqrstuvwxyz";

  for ($x = 0; $x < $length; $x++)
    $str .= $cha[mt_rand(0, strlen($cha))];
  return $str;
}
/*--------------------------------------------------------------*/
/* Function for concatenar Num Boleta
/*--------------------------------------------------------------*/
function conca0($valor)
{
  // Convertir el valor a cadena (string) por si es un número
  $valor_str = (string)$valor;

  // Usar str_pad para completar con ceros a la izquierda hasta tener 8 caracteres
  $valor_completado = str_pad($valor_str, 8, '0', STR_PAD_LEFT);

  return $valor_completado;
}
// Array con los nombres de los meses en español
function name_month($mes)
{
  // Array de meses
  $meses = array(
    1 => 'Enero',
    2 => 'Febrero',
    3 => 'Marzo',
    4 => 'Abril',
    5 => 'Mayo',
    6 => 'Junio',
    7 => 'Julio',
    8 => 'Agosto',
    9 => 'Septiembre',
    10 => 'Octubre',
    11 => 'Noviembre',
    12 => 'Diciembre'
  );

  // Retorna el nombre del mes correspondiente
  return isset($meses[$mes]) ? $meses[$mes] : 'Enero';
}
/*--------------------------------------------------------------*/
/* Function for load file .env
/*--------------------------------------------------------------*/
function loadEnv($filePath)
{
  if (!file_exists($filePath)) {
    throw new Exception("El archivo .env no existe.");
  }

  $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

  foreach ($lines as $line) {
    // Saltar los comentarios y las líneas vacías
    if (strpos(trim($line), '#') === 0 || strpos(trim($line), '=') === false) {
      continue;
    }

    // Separar la clave y el valor
    list($name, $value) = explode('=', $line, 2);

    // Eliminar espacios innecesarios
    $name = trim($name);
    $value = trim($value);

    // Quitar comillas dobles o simples si están presentes
    if (preg_match('/^["\'](.*)["\']$/', $value, $matches)) {
      $value = $matches[1];
    }

    // Establecer la variable de entorno
    putenv("$name=$value");
    $_ENV[$name] = $value;
  }
}
