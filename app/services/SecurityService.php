<?php
require_once(__DIR__ . "/../services/ImportService.php");
ImportService::importPhpModules();

/**
 * Service with security validations for access to pages, actions, ajax, etc.
 * This service has util functions to check permissions, licenses, modules and 
 * other kind of private resources. The session service is used to get session
 * parameters to validate some access rights. @see SessionService
 */
class SecurityService {
 
    /**
     * Validate input params. Use INPUT constants to define the input type to
     * check
     * @param type $type
     * @param type $names
     * @param type $return
     * @param type $message
     * @param type $errorCode
     * @return boolean
     */
    public static function validateInputParams($type, $names, $return = false, $message = HttpMessageEnum::UNAUTHORIZED, $errorCode = 401) {
        foreach ($names as $name) {
            $value = filter_input($type, $name);
            if($value == null) {
                if($return) {
                    return false;
                }
                SecurityService::unauthorized($message, $errorCode);
            }
        }
        return true;
    }


    /**
     * Validate GET params
     * @param array $names
     * @param string $message
     */
    public static function validateGetParams($names, $return = false, $message = HttpMessageEnum::UNAUTHORIZED, $errorCode = 401) {
        foreach ($names as $name) {
            $value = filter_input(INPUT_GET, $name);
            if($value == null) {
                if($return) {
                    return false;
                }
                SecurityService::unauthorized($message, $errorCode);
            }
        }
        return true;
    }
    
    /**
     * Validate POST params
     * @param array $names
     * @param boolean $return
     * @param string $message
     * @param int $errorCode
     * @return boolean
     */
    public static function validatePostParams($names, $return = false, $message = HttpMessageEnum::UNAUTHORIZED, $errorCode = 401) {
        foreach ($names as $name) {
            $value = filter_input(INPUT_POST, $name);
            if($value == null) {
                if($return) {
                    return false;
                }
                SecurityService::unauthorized($message, $errorCode);
            }
        }
        return true;
    }

    /**
     * Validate session checking the session keys. Example:<br>
     * <code>
     * SecurityService::validateSession([SessionEnum::USER_ID_KEY]); // Unauthorized
     * SessionService::set(SessionEnum::USER_ID_KEY, 1);
     * SecurityService::validateSession([SessionEnum::USER_ID_KEY]); // Access allowed
     * </code>
     * @param array $keys
     * @param boolean $return
     * @param string $message
     * @param int $errorCode
     * @return boolean
     * @see SessionService
     * @see SessionEnum
     */
    public static function validateSessionKeys($keys, $return = false, $message = HttpMessageEnum::UNAUTHORIZED, $errorCode = 401) {
        foreach($keys as $key) {
            if(!isset($_SESSION[$key])) {
                if($return) {
                    return false;
                } else {
                    SecurityService::unauthorized($message, $errorCode);
                }
            }
        }
        if($return) {
            return true;
        }
    }

    /**
     * Validate session parameter<br>
     * <code>
     * SessionService::set(SessionEnum::USER_ID_KEY, 1);<br>
     * SecurityService::validateSessionValue(SessionEnum::USER_ID_KEY, 1); // Access allowed<br>
     * SecurityService::validateSessionValue(SessionEnum::USER_ID_KEY, 2); // Unauthorized
     * </code>
     * @param SessionEnum $key
     * @param $value
     * @param boolean $return
     * @param string $message
     * @param int $errorCode
     * @return boolean
     * @see SessionService::set
     * @see SessionEnum
     */
    public static function validateSessionValue($key, $value, $return = false, $message = HttpMessageEnum::UNAUTHORIZED, $errorCode = 401) {
        $valid = true;
        if(!isset($_SESSION[$key])) {
            $valid = false;
        } else if($_SESSION[$key] != $value) {
            $valid = false;
        }
        if($return) {
            return $valid;
        }
        if(!$valid) {
            SecurityService::unauthorized($message, $errorCode);
        }
    }
    
    /**
     * Validate user login.
     * @param boolean $return
     * @param string $message
     * @param int $errorCode
     * @return boolean
     */
    public static function validateLogin($return = false, $message = HttpMessageEnum::UNAUTHORIZED, $errorCode = 401) {
        $userId = SessionService::get(SessionEnum::USER_ID_KEY);
        if($userId == null) {
            if($return) {
                return false;
            } else {
                SecurityService::unauthorized($message, $errorCode);
            }
        }
        if(!DatabaseService::checkUserActive($userId)) {
            if($return) {
                return false;
            } else {
                SecurityService::unauthorized($message, $errorCode);
            }
        }
        if($return) {
            return true;
        }
    }
    
    /**
     * Return unauthorized
     * @param string $message
     * @param int $errorCode
     */
    public static function unauthorized($message = HttpMessageEnum::UNAUTHORIZED, $errorCode = 401) {
        ?>
        <html>
            <head>
                <?php HtmlService::metatags() ?>
            </head>
            <body>
                <?=$message?><br>
                <a href="javascript:history.back()">Back</a>
            </body>
        </html>
        <?php
        http_response_code($errorCode);
        die;
    }
}

