<?php

/**
 * Service that provides some features to manipulate data with Base64.
 */
class Base64Service {
    
    /**
     * Get data from file path and convert it to Base64
     * @param type $path
     * @param type $default
     * @return type
     */
    public static function fileAsBase64($path, $default = null) {
        if(file_exists($path)) {
            $content = file_get_contents($path);
            return base64_encode($content);
        }
        return $default;
    }
    
    /**
     * Get tmp_name information from $_FILES input and convert data to Base64
     * @param type $name
     * @param type $default
     * @return type
     */
    public static function inputFileAsBase64($name, $default = null) {
        if(isset($_FILES[$name]) && isset($_FILES[$name]["tmp_name"]) && !empty($_FILES[$name]["tmp_name"])) {
            $tmpName = file_get_contents($_FILES[$name]["tmp_name"]);
            if(file_exists($tmpName)) {
                $content = file_get_contents($tmpName);
                return base64_encode($content);
            }
        }
        return $default;
    }
}
