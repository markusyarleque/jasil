
<?php
// -----------------------------------------------------------------------
// DEFINE SEPERATOR ALIASES
// -----------------------------------------------------------------------
define("URL_SEPARATOR", '/');
define("DS", DIRECTORY_SEPARATOR);

// -----------------------------------------------------------------------
// DEFINE ROOT HTTP
// -----------------------------------------------------------------------
define('HTTP_SERVER_ROOT', '/inventax');

// -----------------------------------------------------------------------
// DEFINE ROOT PATHS
// -----------------------------------------------------------------------
defined('SITE_ROOT') ? null : define('SITE_ROOT', realpath(dirname(__FILE__) . '/..'));
define("LIB_PATH_INC", SITE_ROOT . DS . 'includes' . DS);

// -----------------------------------------------------------------------
// DEFINE ROOT PATHS
// -----------------------------------------------------------------------
// Obtener el protocolo (http o https)
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

// Obtener el nombre del dominio/host
$host = $_SERVER['HTTP_HOST'];

// Construir la URL de la raíz
$root_url = $protocol . $host . HTTP_SERVER_ROOT;

// Almacenar la URL de la raíz
define('ROOT_URL', $root_url);

require_once(LIB_PATH_INC . 'functions.php');
require_once(LIB_PATH_INC . 'config.php');
require_once(LIB_PATH_INC . 'session.php');
require_once(LIB_PATH_INC . 'upload.php');
require_once(LIB_PATH_INC . 'database.php');
require_once(LIB_PATH_INC . 'sql.php');

?>
