<?php
require_once(__DIR__ . "/ImportUtil.php");
ImportUtil::importPhpModules();

/**
 * Class that provides some client session utilities
 */
class SessionUtil {

    /**
     * Start session processing
     */
    public static function start() {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    /**
     * Set session value
     * @param string $key
     * @param mixed $value
     */
    public static function set($key, $value) {
        SessionUtil::start();
        $_SESSION[$key] = $value;
    }

    /**
     * Get session value
     * @param string $key
     */
    public static function get($key) {
        SessionUtil::start();
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
        return null;
    }

    /**
     * Destroy session
     */
    public static function destroy() {
        SessionUtil::start();
        $_SESSION = array();
        session_destroy();
    }
}
