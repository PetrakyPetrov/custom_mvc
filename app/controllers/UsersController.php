<?php

require_once SYSTEM_ROOT."/BaseController.php";

class UsersController extends BaseController {

    function __construct($query_params) {
        parent::__construct(static::class, $query_params);
    }

    public function actionLogin() {
        print_r($_SESSION);
        $this->render("login");
    }
}
?>