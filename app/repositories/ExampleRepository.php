<?php
require_once(__DIR__ . "/../services/ImportService.php");
ImportService::importPhpModules();

/**
 * Example Repository implementation
 */
class ExampleRepository {
    
    public static function insert($name, $email, $password) {
        $sql = "INSERT INTO users VALUES ('$name', '$email', '$password')";
        DatabaseService::executeUpdate($sql);
    }
    
}