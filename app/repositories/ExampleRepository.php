<?php
require_once(__DIR__ . "/../utils/ImportUtil.php");
ImportUtil::importPhpModules();

/**
 * Example Repository implementation
 */
class ExampleRepository {
    
    public static function insert($name, $email, $password) {
        $sql = "INSERT INTO users VALUES ('$name', '$email', '$password')";
        DatabaseUtil::executeSql($sql);
    }
    
}