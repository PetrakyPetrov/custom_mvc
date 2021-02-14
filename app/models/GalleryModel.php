<?php 

require_once SYSTEM_ROOT."/BaseModel.php";

class GalleryModel extends BaseModel{

    public $image;
    public $user_id;
    public $image_types = [IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_BMP];

    function __construct($image = NULL, $user_id = NULL) {
        parent::__construct();
        $this->image   = $image;
        $this->user_id = $user_id;
    }

    public static function table_name(): string {
        return 'images';
    }

    public function validate() {

        switch ($this->image['error']) {
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_NO_FILE:
                throw new Exception('No file sent.');
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                throw new Exception('Exceeded filesize limit.');
            default:
                throw new Exception('Unknown errors.');
        }

        if (empty(exif_imagetype($this->image['tmp_name']))) {
            throw new \Exception("Incorrect image type");
        }

        if (empty(exif_imagetype($this->image['tmp_name']))) {
            throw new \Exception("Incorrect image type");
        }

        if (!in_array(exif_imagetype($this->image['tmp_name']), $this->image_types)) {
            throw new \Exception("Incorrect image type");
        }  
    }

    public function save() {

        $this->db->beginTransaction();
        try {
            $new_image_name = time().$this->image['name'];
            $web_img_url = "/uploads/gallery/".$this->user_id."/{$new_image_name}";
            $img_size = $this->image['size']/1000;
            $sql = "INSERT INTO images(name, size_KB, path, user_id) VALUES(?, ?, ?, ?);";
            $query = $this->db->prepare($sql);
            $query->bindParam(1, $new_image_name, PDO::PARAM_STR);
            $query->bindParam(2, $img_size, PDO::PARAM_STR);
            $query->bindParam(3, $web_img_url, PDO::PARAM_STR);
            $query->bindParam(4, $this->user_id, PDO::PARAM_STR);
            $query->execute();

            $dir = UPLOADS_PATH.'/gallery/'.$this->user_id.'/';
            if (!file_exists($dir)) {
                mkdir($dir, 0755, true);
            }

            
            if (!move_uploaded_file($this->image['tmp_name'], $dir.$new_image_name)) {
                $this->db->rollback();
                throw new Exception('Failed to move uploaded file.');
            }

            $this->db->commit();
        } catch (\Exception $e) {
            $this->db->rollback();
            throw $e;
        }
    }

    public function get_all() {
        $sql = "SELECT * FROM images;";
        try {
            $query = $this->db->prepare($sql);
            $query->execute(); 
            $images = $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw $e;
        }

        return $images;
    }

    public function get_by_id($id) {
        $sql = "SELECT img.*, u.username FROM images img JOIN users u ON img.user_id=u.id WHERE img.id=?  LIMIT 1;";
        try {
            $query = $this->db->prepare($sql);
            $query->bindParam(1, $id, PDO::PARAM_STR);
            $query->execute(); 
            $image = $query->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            // TODO: implement logger
            throw $e;
        }

        return $image;
    }

    public function get_my_photos() {
        $sql = "SELECT * FROM images WHERE user_id = ?;";
        try {
            $query = $this->db->prepare($sql);
            $query->bindParam(1, $this->user_id, PDO::PARAM_STR);
            $query->execute(); 
            $images = $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw $e;
        }

        return $images;
    }

    public function delete_by_id($id) {
        $image = $this->get_by_id($id);
        try {
            $sql = "DELETE FROM images WHERE id=? LIMIT 1;"; 
            $query = $this->db->prepare($sql);
            $query->bindParam(1, $image['id'], PDO::PARAM_STR);
            $query->execute();
            unlink(ROOT.$image['path']);
        } catch (Exception $e) {
            throw $e;
        }
        return true;
    }
}

?>