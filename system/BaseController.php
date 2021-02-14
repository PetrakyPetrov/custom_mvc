<?php 

class BaseController {
     
    protected $_controller;
    public $query_params;
     
    public function __construct($controller, $query_params) {
        $this->_controller = str_replace("controller", "", strtolower($controller));
        $this->query_params = $query_params;
    }
     
    function render($view, $params=[]) {
        $params['view'] = VIEWS_PATH."/{$this->_controller}/".$view.".php";
        extract($params);
        include (VIEWS_PATH."/layout.php");
        // $view = 
        //     if (file_exists(ROOT . DS . 'application' . DS . 'views' . DS . $this->_controller . DS . 'header.php')) {
        //         include (ROOT . DS . 'application' . DS . 'views' . DS . $this->_controller . DS . 'header.php');
        //     } else {
        //         include (ROOT . DS . 'application' . DS . 'views' . DS . 'header.php');
        //     }
 
        // include (ROOT . DS . 'application' . DS . 'views' . DS . $this->_controller . DS . $this->_action . '.php');       
             
        //     if (file_exists(ROOT . DS . 'application' . DS . 'views' . DS . $this->_controller . DS . 'footer.php')) {
        //         include (ROOT . DS . 'application' . DS . 'views' . DS . $this->_controller . DS . 'footer.php');
        //     } else {
        //         include (ROOT . DS . 'application' . DS . 'views' . DS . 'footer.php');
        //     }
    }
 
}
?>