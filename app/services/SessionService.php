<?php
require_once(__DIR__ . "/../services/ImportService.php");
ImportService::importPhpModules();

/**
 * Client session utils service
 */
class SessionService {

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
        SessionService::start();
        $_SESSION[$key] = $value;
    }

    /**
     * Get session value
     * @param string $key
     */
    public static function get($key) {
        SessionService::start();
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
        return null;
    }

    /**
     * Destroy session
     */
    public static function destroy() {
        SessionService::start();
        $_SESSION = array();
        session_destroy();
    }
}
