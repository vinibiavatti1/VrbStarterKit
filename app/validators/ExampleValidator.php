<?php
require_once(__DIR__ . "/../utils/ImportUtil.php");
ImportUtil::importPhpModules();

/**
 * Example Validator implementation
 */
class ExampleValidator extends Validator {
    
    public static function validateInsert($name, $email, $password) {
        if($name == null) {
            self::invalidate("The name must be set");
        }
        if($email == null) {
            self::invalidate("The email must be set");
        }
        if($password == null) {
            self::invalidate("The password must be set");
        }
    }
    
}