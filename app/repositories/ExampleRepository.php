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
    
    public static function findAllActive() {
      $sql = "SELECT `id`, `name`, `active`, `age`, `description`, `id_school`, `birth_date`, `insert_date_time` FROM `example` WHERE `active` = '1'";
      return DatabaseUtil::executeSql($sql);
   }
    
}