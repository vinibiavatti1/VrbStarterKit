<?php
require_once(__DIR__ . "/ImportUtil.php");
ImportUtil::importPhpModules();

/**
 * Class with security validations for access to pages, actions, ajax, etc.
 * This class has util functions to check permissions, licenses, modules and 
 * other kind of private resources. The session util is used to get session
 * parameters to validate some access rights. @see SessionUtil
 */
class SecurityUtil {
 
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
                SecurityUtil::unauthorized($message, $errorCode);
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
                SecurityUtil::unauthorized($message, $errorCode);
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
                SecurityUtil::unauthorized($message, $errorCode);
            }
        }
        return true;
    }

    /**
     * Validate session checking the session keys. Example:<br>
     * <code>
     * SecurityUtil::validateSession([SessionEnum::USER_ID]); // Unauthorized
     * SessionUtil::set(SessionEnum::USER_ID, 1);
     * SecurityUtil::validateSession([SessionEnum::USER_ID]); // Access allowed
     * </code>
     * @param array $keys
     * @param boolean $return
     * @param string $message
     * @param int $errorCode
     * @return boolean
     * @see SessionUtil
     * @see SessionEnum
     */
    public static function validateSessionKeys($keys, $return = false, $message = HttpMessageEnum::UNAUTHORIZED, $errorCode = 401) {
        foreach($keys as $key) {
            if(!isset($_SESSION[$key])) {
                if($return) {
                    return false;
                } else {
                    SecurityUtil::unauthorized($message, $errorCode);
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
     * SessionUtil::set(SessionEnum::USER_ID, 1);<br>
     * SecurityUtil::validateSessionValue(SessionEnum::USER_ID, 1); // Access allowed<br>
     * SecurityUtil::validateSessionValue(SessionEnum::USER_ID, 2); // Unauthorized
     * </code>
     * @param SessionEnum $key
     * @param $value
     * @param boolean $return
     * @param string $message
     * @param int $errorCode
     * @return boolean
     * @see SessionUtil::set
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
            SecurityUtil::unauthorized($message, $errorCode);
        }
    }
    
    /**
     * Validate user login.
     * @param boolean $return
     * @param string $message
     * @param int $errorCode
     * @return boolean
     */
    public static function validateLogin($validateDatabaseUser = true, $return = false, $message = HttpMessageEnum::UNAUTHORIZED, $errorCode = 401) {
        $userId = SessionUtil::get(SessionEnum::USER_ID);
        if($userId == null) {
            if($return) {
                return false;
            } else {
                SecurityUtil::unauthorized($message, $errorCode);
            }
        }
        if($validateDatabaseUser) {
            if(!DatabaseUtil::checkUserActive($userId)) {
                if($return) {
                    return false;
                } else {
                    SecurityUtil::unauthorized($message, $errorCode);
                }
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
                <?php HtmlUtil::metatags() ?>
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

