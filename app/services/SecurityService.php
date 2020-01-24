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
     * Return unauthorized
     * @param string $message
     * @param int $errorCode
     */
    public static function unauthorized($message = HttpMessageTypes::UNAUTHORIZED, $errorCode = 401) {
        echo($message);
        http_response_code($errorCode);
        exit;
    }


    /**
     * Validate GET params
     * @param array $names
     * @param string $message
     */
    public static function validateGetParams($names, $return = false, $message = HttpMessageTypes::UNAUTHORIZED, $errorCode = 401) {
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
    public static function validatePostParams($names, $return = false, $message = HttpMessageTypes::UNAUTHORIZED, $errorCode = 401) {
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
     * SecurityService::validateSession([SessionTypes::USER_ID_KEY]); // Unauthorized
     * SessionService::set(SessionTypes::USER_ID_KEY, 1);
     * SecurityService::validateSession([SessionTypes::USER_ID_KEY]); // Access allowed
     * </code>
     * @param array $keys
     * @param boolean $return
     * @param string $message
     * @param int $errorCode
     * @return boolean
     * @see SessionService
     * @see SessionTypes
     */
    public static function validateSession($keys, $return = false, $message = Serv_Http::HTTP_NAO_AUTORIZADO, $errorCode = 401) {
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
     * Validate if the user has access to module. Example:<br>
     * <code>
     * SessionService::setModules([ModuleTypes::REGISTERS]);<br>
     * SecurityService::validateModule(ModuleTypes::REGISTERS); // Access allowed<br>
     * SecurityService::validateModule(ModuleTypes::REPORTS); // Unauthorized
     * </code>
     * @param ModuleTypes $module
     * @param boolean $return
     * @param string $message
     * @param int $errorCode
     * @return boolean
     * @see SessionService::setModules
     * @see ModuleTypes
     */
    public static function validateModule($module, $return = false, $message = Serv_Http::HTTP_NAO_AUTORIZADO, $errorCode = 401) {
        $valid = true;
        if(!isset($_SESSION[SessionTypes::MODULES_KEY])) {
            $valid = false;
        } else if(!in_array($module, $_SESSION[SessionTypes::MODULES_KEY])) {
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
     * Validate if the user has access to location by license. Example:<br>
     * <code>
     * SessionService::setLicense(LicenseTypes::STANDARD);<br>
     * SecurityService::validateLicense([LicenseTypes::STANDARD]); // Access allowed<br>
     * SecurityService::validateLicense([LicenseTypes::ENTERPRISE]); // Unauthorized
     * </code>
     * @param array $licenses
     * @param boolean $return
     * @param string $message
     * @param int $errorCode
     * @return boolean
     * @see SessionService::setLicense
     * @see LicenseTypes
     */
    public static function validateLicense($licenses, $return = false, $message = Serv_Http::HTTP_NAO_AUTORIZADO, $errorCode = 401) {
        $valid = true;
        if(!isset($_SESSION[SessionTypes::LICENSE_KEY])) {
            $valid = false;
        } else if(!in_array($_SESSION[SessionTypes::LICENSE_KEY], $licenses)) {
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
     * Validate access rights. Example:<br>
     * <code>
     * SessionService::setPermissions([PermissionTypes::INSERT]);<br>
     * SecurityService::validatePermission([PermissionTypes::INSERT]); // Access allowed<br>
     * SecurityService::validatePermission([PermissionTypes::UPDATE]); // Unauthorized
     * </code>
     * @param array $permissions
     * @param boolean $return
     * @param string $message
     * @param int $errorCode
     * @see SessionService::setPermissions
     * @see PermissionTypes
     */
    public static function validatePermission($permissions, $return = false, $message = Serv_Http::HTTP_NAO_AUTORIZADO, $errorCode = 401) {
        $valid = true;
        if(!isset($_SESSION[SessionTypes::PERMISSIONS_KEY])) {
            $valid = false;
        } else {
            $valid = false;
            foreach ($permissions as $permission) {
                if(in_array($permission, $_SESSION[SessionTypes::PERMISSIONS_KEY])) {
                    $valid = true;
                }
            }
        }
        if($return) {
            return $valid;
        }
        if(!$valid) {
            SecurityService::unauthorized($message, $errorCode);
        }
    }
    
}

