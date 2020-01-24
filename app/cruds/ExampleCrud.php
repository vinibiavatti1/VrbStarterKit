<?php
require_once(__DIR__ . "/../services/ImportService.php");
ImportService::importPhpModules();

/**
 * Example CRUD implementation
 */
class ExampleCrud implements Crud {
    
    public static function insert($data) {
        $sql = "INSERT INTO users VALUES ('$data[name]', '$data[email]', '$data[password]')";
        return DatabaseService::executeUpdate($sql);
    }
    
    public static function get($id) {
        $sql = "SELECT * FROM users WHERE id = $id";
        $rs = DatabaseService::executeQuery($sql);
        return DatabaseService::fetch($rs);
    }
    
    public static function list($filters = null) {
        $conditions = "";
        if(isset($filters[active])) {
            $conditions .= " AND active = $filters[active]";
        }
        $sql = "SELECT * FROM users WHERE 1 = 1 $conditions";
        return DatabaseService::executeQuery($sql);
    }

    public static function update($id, $data) {
        $sql = "UPDATE users SET name = '$data[name]' WHERE id = $id";
        return DatabaseService::executeUpdate($sql);
    }

    public static function delete($id) {
        $sql = "UPDATE users SET active = 0 WHERE id = $id";
        return DatabaseService::executeUpdate($sql);
    }

}