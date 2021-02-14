<?php 
require_once SYSTEM_ROOT."/Db.php";

abstract class BaseModel
{
    abstract public static function table_name(): string;

    function __construct($dbh=NULL) {
        if (is_null($dbh)) {
            $db = new Db();
            $this->db = $db->connect();
        } else {
            $this->db = $dbh;
        }
    }

    public function load($data) {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }
}