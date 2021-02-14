<?php

require_once SYSTEM_ROOT."/BaseController.php";


class GalleryController extends BaseController {

    function __construct($query_params) {
        parent::__construct(static::class, $query_params);
    }

    public function actionIndex(){
        $this->render("index", ["asdasd" => "ebago"]);
    }
}
?>