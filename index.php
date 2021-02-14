<?php
session_start();
// $_SESSION['time'] = time();
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));
define('APP_ROOT', ROOT."/app");
define('SYSTEM_ROOT', ROOT."/system");
define('VIEWS_PATH', ROOT."/app/views");
define('UPLOADS_PATH', ROOT."/uploads");

function error_handler($errno, $errstr, $errfile, $errline) {
    echo "<b>Custom error:</b> [$errno] $errstr<br>";
    echo " Error on line $errline in $errfile<br>";
}

function exception_handler($exception) {
    echo "Uncaught exception: " , $exception->getMessage(), "\n";
}

function get_logged_user() {
    if (isset($_SESSION['logged_user'])) {
        return $_SESSION['logged_user'];
    }
    return [];
}

function clear_session() {
    $_SESSION = [];
    $_SESSION['logged_user'] = [];
}

set_error_handler("error_handler");
set_exception_handler('exception_handler');

$controller = "GalleryController";
$action     = "actionIndex";
if(isset($_SERVER['PATH_INFO'])){
    $path     = $_SERVER['PATH_INFO'];
    $path_arr = explode('/', ltrim($path));

    if (!empty($path_arr[2])) {
        $action  = $path_arr[2];
        $$action = strtolower($action);
        $action  = str_replace(" ", "", $action);  
        $action  = "action".ucfirst($action);  
    }
    // Do a path split
    $controller = $path_arr[1];
    $controller = strtolower($controller);
    $controller = str_replace(" ", "", $controller);
    $controller = ucfirst($controller)."Controller";
}

$filename = APP_ROOT."/controllers/{$controller}.php";
if (!file_exists($filename)) {
    echo "Unknown {$controller}";
    die();
}

require_once $filename;

try {
    $Controller = new $controller();
    $Controller->$action();
} catch (\Exception $e) {
    echo $e->getMessage();
    die();
}

?>