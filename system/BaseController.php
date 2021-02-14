<?php 

class BaseController {
     
    protected $_controller;
     
    public function __construct($controller) {
        $this->_controller = str_replace("controller", "", strtolower($controller));
    }

    public function get() {
        return $_GET;
    }

    public function post() {
        return $_POST;
    }

    public function files() {
        return $_FILES;
    }

    public function clear_session() {
        $_SESSION = [];
        $_SESSION['logged_user'] = [];
    }
     
    public function render($view, $params=[]) {
        $params['view'] = VIEWS_PATH."/{$this->_controller}/{$view}.php";
        extract($params);
        include (VIEWS_PATH."/layout.php");
        exit();
    }

    public function redirect($url, $statusCode = 303) {
        header('location: ' . $url, true, $statusCode);
        exit();
    }
}
?>