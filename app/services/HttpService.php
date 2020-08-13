<?php
require_once(__DIR__ . "/../services/ImportService.php");
ImportService::importPhpModules();

/**
 * Service to control HTTP variables. This service provides methods to get 
 * parameters from URL or POST data.
 */
class HttpService {
    
    /**
     * Get variable from input type. Use INPUT constants as type for this
     * function
     * @param type $type
     * @param type $name
     * @param type $default
     * @return type
     */
    public static function input($type, $name, $default = null) {
        $value = filter_input($type, $name, FILTER_SANITIZE_MAGIC_QUOTES);
        if($value == null) {
            return $default;
        }
        return $value;
    }
    
    /**
     * Get "GET" variable
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public static function get($name, $default = null) {
        $value = filter_input(INPUT_GET, $name, FILTER_SANITIZE_MAGIC_QUOTES);
        if($value == null) {
            return $default;
        }
        return $value;
    }
    
    /**
     * Get "POST" variable
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public static function post($name, $default = null) {
        $value = filter_input(INPUT_POST, $name, FILTER_SANITIZE_MAGIC_QUOTES);
        if($value == null) {
            return $default;
        }
        return $value;
    }
    
    /**
     * Get "GET" variable not empty
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public static function getNotEmpty($name, $default = null) {
        $value = HttpService::get($name);
        if($value == '') {
            return $default;
        }
        return $value;
    }
    
    /**
     * Get "POST" variable not empty
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public static function postNotEmpty($name, $default = null) {
        $value = HttpService::post($name);
        if($value == '') {
            return $default;
        }
        return $value;
    }

    /**
     * Check if "GET" param exists
     * @param string $name
     * @return boolean
     */
    public static function getExists($name) {
        return HttpService::get($name) != null;
    }
    
    /**
     * Check if "POST" param exists
     * @param string $name
     * @return boolean
     */
    public static function postExists($name) {
        return HttpService::post($name) != null;
    }
    
    /**
     * Check if "GET" param exists and it is not empty
     * @param string $name
     * @return boolean
     */
    public static function getExistsNotEmpty($name) {
        return HttpService::get($name) != null && HttpService::get($name) != '';
    }
    
    /**
     * Check if "POST" param exists and it is not empty
     * @param string $name
     * @return boolean
     */
    public static function postExistsNotEmpty($name) {
        return HttpService::post($name) != null && HttpService::post($name) != '';
    }
    
    /**
     * Get "GET" param encoded with sha1
     * @param string $name
     * @return boolean
     */
    public static function getSha1($name) {
        return HttpService::existe_get($name) ? sha1(HttpService::get($name)) : null;
    }
    
    /**
     * Get "POST" param encoded with sha1
     * @param string $name
     * @return boolean
     */
    public static function postSha1($name) {
        return HttpService::existe_post($name) ? sha1(HttpService::post($name)) : null;
    }
    
    /**
     * Get "FILE" param
     * @param type $name
     * @param type $default
     * @return type
     */
    public static function file($name, $default = null) {
        return $_FILES[$name] ??  $default;
    }
    
    /**
     * Get tmp_name information from $_FILES input and convert data to Base64
     * @param type $name
     * @param type $default
     * @return type
     */
    public static function fileAsBase64($name, $default = null) {
        if(isset($_FILES[$name]) && isset($_FILES[$name]["tmp_name"]) && !empty($_FILES[$name]["tmp_name"])) {
            $content = file_get_contents($_FILES[$name]["tmp_name"]);
            return base64_encode($content);
        }
        return $default;
    }
}