<?php
// HTTP
    define('HTTP', $_SERVER['HTTP_HOST'].str_replace('/admin', '',dirname($_SERVER['PHP_SELF'])));
    define('HTTP_SERVER', 'http://'.HTTP.'/admin/');
    define('HTTP_CATALOG', 'http://'.HTTP.'/');
    define('HTTP_IMAGE', 'http://'.HTTP.'/image/');
 
    // HTTPS
    define('HTTPS_SERVER', 'http://'.HTTP.'/admin/');
    define('HTTPS_IMAGE', 'http://'.HTTP.'/image/');
 
    // DIR
    define('BASE_DIR', str_replace(DIRECTORY_SEPARATOR.'admin', '', realpath(dirname(__FILE__))));
    define('DIR_APPLICATION', BASE_DIR.'/admin/');
    define('DIR_SYSTEM', BASE_DIR.'/system/');
    define('DIR_DATABASE', BASE_DIR.'/system/database/');
    define('DIR_LANGUAGE', BASE_DIR.'/admin/language/');
    define('DIR_TEMPLATE', BASE_DIR.'/admin/view/template/');
    define('DIR_CONFIG', BASE_DIR.'/system/config/');
    define('DIR_IMAGE', BASE_DIR.'/image/');
    define('DIR_CACHE', BASE_DIR.'/system/cache/');
    define('DIR_DOWNLOAD', BASE_DIR.'/download/');
    define('DIR_LOGS', BASE_DIR.'/system/logs/');
    define('DIR_CATALOG', BASE_DIR.'/catalog/');

// DB
define('DB_DRIVER', 'mysql');
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'hangducx_billy');
define('DB_PASSWORD', '2531989');
define('DB_DATABASE', 'hangducx_billy');
define('DB_PREFIX', 'dta_');
?>