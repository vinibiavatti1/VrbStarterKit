<?php
require_once(__DIR__ . "/../services/ImportService.php");
ImportService::importPhpModules();

/**
 * Service that provides util functions for cookies.
 */
class CookieService {
    
    /**
     * Get cookie value.
     * @param string $name
     * @param mixed $else
     * @return mixed
     */
    public static function get($name, $else = null) {
        return isset($_COOKIE[$name]) ? $_COOKIE[$name] : $else;
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
     * @param string $email
     * @param mixed $value
     */
    public static function set($name, $value) {
        setcookie($name, $value);
    }
}