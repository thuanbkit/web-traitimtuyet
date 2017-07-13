<?php
 // HTTP
    define('HTTP', $_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']));
    define('HTTP_SERVER', 'http://'.HTTP);
    define('HTTP_IMAGE', 'http://'.HTTP.'image/');
    define('HTTP_ADMIN', 'http://'.HTTP.'admin/');
 
    // HTTPS
    define('HTTPS_SERVER', 'http://'.HTTP);
    define('HTTPS_IMAGE', 'http://'.HTTP.'image/');
 
    // DIR
    define('BASE_DIR', realpath(dirname(__FILE__)));
    define('DIR_APPLICATION', BASE_DIR.'/catalog/');
    define('DIR_SYSTEM', BASE_DIR.'/system/');
    define('DIR_DATABASE', BASE_DIR.'/system/database/');
    define('DIR_LANGUAGE', BASE_DIR.'/catalog/language/');
    define('DIR_TEMPLATE', BASE_DIR.'/catalog/view/theme/');
    define('DIR_CONFIG', BASE_DIR.'/system/config/');
    define('DIR_IMAGE', BASE_DIR.'/image/');
    define('DIR_CACHE', BASE_DIR.'/system/cache/');
    define('DIR_DOWNLOAD', BASE_DIR.'/download/');
    define('DIR_LOGS', BASE_DIR.'/system/logs/');

// DB
define('DB_DRIVER', 'mysqli');
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'gxbfjsif_thuan');
define('DB_PASSWORD', '123go.vn');
define('DB_DATABASE', 'gxbfjsif_traitimtuyet');
define('DB_PREFIX', 'dta_');
?>