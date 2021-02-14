<?php 

ini_set('upload_max_filesize', '15M');

session_start();
// $_SESSION['time'] = time();
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));
define('APP_ROOT', ROOT."/app");
define('SYSTEM_ROOT', ROOT."/system");
define('VIEWS_PATH', ROOT."/app/views");
define('UPLOADS_PATH', ROOT."/uploads");

$http = "http://";
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'){
    $http = "https://";
}
define('SERVER_URL', $http.$_SERVER['HTTP_HOST']);



require_once ROOT."/helpers/system.php";
require_once ROOT."/config/db.php";

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