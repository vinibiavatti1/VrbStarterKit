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
    
    /**
     * Set session as active
     */
    public static function setActiveSession() {
        SessionService::set(SessionTypes::SESSION_KEY, true);
    }
    
    /**
     * Set session user id
     * @param mixed $userId
     */
    public static function setUserId($userId) {
        SessionService::set(SessionTypes::USER_ID_KEY, $userId);
    }
    
    /**
     * Set session user access modules
     * @param array $modules
     */
    public static function setModules(array $modules) {
        SessionService::set(SessionTypes::MODULES_KEY, $modules);
    }
    
    /**
     * Set session user rights
     * @param array $permissions
     */
    public static function setPermissions(array $permissions) {
        SessionService::set(SessionTypes::PERMISSIONS_KEY, $permissions);
    }
    
    /**
     * Set session user license
     * @param LicenseTypes $license
     */
    public static function setLicense($license) {
        SessionService::set(SessionTypes::LICENSE_KEY, $license);
    }
    
    /**
     * Set session user token
     * @param string token
     */
    public static function setToken($token) {
        SessionService::set(SessionTypes::TOKEN_KEY, $token);
    }

}
