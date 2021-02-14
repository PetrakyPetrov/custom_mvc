<?php

require_once SYSTEM_ROOT."/BaseController.php";


class GalleryController extends BaseController {

    function __construct() {
        parent::__construct(static::class);
    }

    public function actionIndex() {
        $this->render("index");
    }

    public function actionUpload() {

        if ($this->post()) {
            echo "<pre>";
            print_r($_FILES);
            die();
        }
        $this->render("upload");
    }
}
?>