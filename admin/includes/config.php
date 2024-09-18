<?php
/*
|--------------------------------------------------------------------------
| Jasil V1
|--------------------------------------------------------------------------
| Author: Markus Yarleque
| Project Name: Jasil
| Version: v1
| Official page: http://github.com/markusyarleque
| Repository: http://github.com/markusyarleque/jasil
|
|
|
*/
define('SITE_ROOT_RAIZ', realpath(dirname(__FILE__) . '/../../'));
// Cargar el archivo .env
loadEnv(SITE_ROOT_RAIZ . '/.env');

// Ahora puedes usar las variables de entorno en cualquier lugar de tu código
$dbHost = getenv('DB_HOST');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$dbName = getenv('DB_NAME');
$version = getenv('VERSION');
$maps_api_key = getenv('MAPS_API_KEY');
$recaptcha_site_key = getenv('RECAPTCHA_SITE_KEY');

define('DB_HOST', $dbHost);          // Set database host
define('DB_USER', $dbUser);             // Set database user
define('DB_PASS', $dbPassword);             // Set database password
define('DB_NAME', $dbName);        // Set database name
date_default_timezone_set('America/Lima'); //Zona horaria
define('VERSION', $version); //Version