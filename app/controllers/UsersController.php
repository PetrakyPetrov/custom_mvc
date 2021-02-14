<?php

require_once SYSTEM_ROOT."/BaseController.php";

class UsersController extends BaseController {

    function __construct() {
        parent::__construct(static::class);
    }

    public function actionLogin() {
        if ($this->post()) {
            // session_start();
            $_SESSION['logged_user'] = [
                'username' => $this->post()['username']
            ];
            $this->redirect("/gallery");
        }

        $this->render("login");
    }

    public function actionLogout() {
        session_destroy();
        $this->redirect("/gallery");
    }
}
?>