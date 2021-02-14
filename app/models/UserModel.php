<?php 

require_once SYSTEM_ROOT."/BaseModel.php";

class UserModel extends BaseModel{

    public $username;
    public $password;

    public static function table_name(): string {
        return 'users';
    }

    public function validate() {

        $usernme_len = strlen(trim($this->username));
        $pass_len = strlen(trim($this->password));

        if ($usernme_len <= 2 || $usernme_len > 25) {
            throw new \Exception("Incorrect username");
        }

        if ($pass_len <= 8 || $pass_len > 25) {
            throw new \Exception("Incorrect password");
        }
    }

    public function get_all() {
        $sql = "SELECT * FROM users;";
        try {
            $query = $this->db->prepare($sql);
            $query->execute(); 
            $users = $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw $e;
        }

        return $users;
    }

    public function get_by_username($username) {
        $sql = "SELECT * FROM users WHERE username=? LIMIT 1;";
        try {
            $query = $this->db->prepare($sql);
            $query->bindParam(1, $username, PDO::PARAM_STR);
            $query->execute(); 
            $user = $query->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            // TODO: implement logger
            throw $e;
        }

        return $user;
    }

    public function save() {
        $sql = "INSERT INTO users(username, password) VALUES(?, ?);";
        try {
            $query = $this->db->prepare($sql);
            $query->bindParam(1, $this->username, PDO::PARAM_STR);
            $query->bindParam(2, $this->password, PDO::PARAM_STR);
            $query->execute();
        } catch (Exception $e) {
            throw $e;
        }
        return $this->db->lastInsertId();
    }

    public function pass_hash() {
        return pass_hash($this->password);
    }

    public function pass_verify($pass) {
        if (!pass_verify($this->password, $pass)) {
            throw new \Exception("Wrong password");
        }
        return true;
    }
}

?>