<?php
require_once(__DIR__ . "/ImportUtil.php");
ImportUtil::importPhpModules();

/**
 * Class that provides util functions for cookies
 */
class CookieUtil {
    
    /**
     * Get cookie value.
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public static function get($name, $default = null) {
        return isset($_COOKIE[$name]) ? $_COOKIE[$name] : $default;
    }
    
    /**
     * Delete cookie.
     * @param string $name
     */
    public static function delete($name) {
        if (isset($_COOKIE[$name])) {
            unset($_COOKIE[$name]);
            setcookie($name, null, -1, '/');
        }
    }
    
    /**
     * Set cookie value.
     * @param string $name
     * @param mixed $value
     */
    public static function set($name, $value) {
        setcookie($name, $value);
    }
}