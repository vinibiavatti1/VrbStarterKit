<?php
require_once(__DIR__ . "/../utils/ImportUtil.php");
ImportUtil::importPhpModules();

/**
 * Validator superclass
 */
class Validator {
    
    /**
     * Invalidate the action form and create a error message
     * @param type $message
     * @param type $errorCode
     */
    public static function invalidate($message = "The form data is invalid", $errorCode = 400) {
        HtmlUtil::errorMessage($message, $errorCode);
    }
    
}

