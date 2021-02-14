<?php

require_once SYSTEM_ROOT."/BaseController.php";
require_once APP_ROOT."/models/GalleryModel.php";


class GalleryController extends BaseController {

    function __construct() {
        parent::__construct(static::class);
    }

    public function actionIndex() {
        $model = new GalleryModel();
        $images = $model->get_all();
        $this->render("index", ['images' => $images]);
    }

    public function actionView() {
        if ($this->get()) {
            $img_id = !isset($this->get()['id']) ? 0 : $this->get()['id'];
            $model  = new GalleryModel();
            $image  = $model->get_by_id($img_id);
            $this->render("view", ['image' => $image]);
        }
        $this->redirect("/gallery");
    }

    public function actionDelete() {
        if (empty(get_logged_user())) {
            $this->redirect("/gallery");
        }

        if ($this->get()) {
            $img_id = !isset($this->get()['id']) ? 0 : $this->get()['id'];
            $model  = new GalleryModel();
            $model->delete_by_id($img_id);
        }

        $this->redirect("/gallery");
    }

    public function actionMyPhotos() {
        if (empty(get_logged_user())) {
            $this->redirect("/gallery");
        }
        $model = new GalleryModel(NULL, get_logged_user()['id']);
        $images = $model->get_my_photos();
        $this->render("index", ['images' => $images]);
    }

    public function actionUpload() {
        
        if (empty(get_logged_user())) {
            $this->redirect("/gallery");
        }

        $params = [];
        if ($this->post()) {
            try {
                $model = new GalleryModel($this->files()['image'], $this->post()['user_id']);
                $model->validate();
                $model->save();
                $this->redirect("/gallery");
            } catch (\Exception $e) {
                // TODO: Implement logger
                $params['error'] = $e->getMessage();
            }
            
        }
        $this->render("upload", $params);
    }
}
?>