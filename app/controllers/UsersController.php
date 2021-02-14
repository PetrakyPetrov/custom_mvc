<?php

require_once SYSTEM_ROOT."/BaseController.php";
require_once APP_ROOT."/models/UserModel.php";


class UsersController extends BaseController {

    function __construct() {
        parent::__construct(static::class);
    }

    public function actionLogin() {
        $params = [];
        if ($this->post()) {
            try {
                $model = new UserModel();
                $model->load($this->post());
                $model->validate();
                $result = $model->get_by_username($model->username);
                if (!empty($result)) {
                    $model->pass_verify($result['password']);
                    $_SESSION['logged_user'] = [
                        'id'       => $result['id'],
                        'username' => $result['username']
                    ];
                    $this->redirect("/gallery");
                }
                $params['error'] = "Wrong username or password";
            } catch (\Exception $e) {
                $params['error'] = $e->getMessage();
            }
        }
        $this->render("login", $params);
    }

    public function actionRegister() {
        $params = [];
        if ($this->post()) {
            try {
                $model = new UserModel();
                $model->load($this->post());
                $model->validate();
                $model->password = $model->pass_hash($model->password);
                $user_id = $model->save();
                if ($user_id) {
                    $_SESSION['logged_user'] = [
                        'id'       => $user_id,
                        'username' => $model->username
                    ];
                    $this->redirect("/gallery");
                }   
            } catch (\Exception $e) {
                $params['error'] = $e->getMessage();
            }
        }

        $this->render("register", $params);
    }

    public function actionLogout() {
        session_destroy();
        $this->redirect("/gallery");
    }
}
?>