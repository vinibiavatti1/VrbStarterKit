<?php
require_once(__DIR__ . "/ImportUtil.php");
ImportUtil::importPhpModules();

/**
 * IP addrees utilities
 */
class IpUtil {
    
    /**
     * Get client IP
     * @return string
     */
    public static function getIp() {
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = @$_SERVER['REMOTE_ADDR'];
        if(filter_var($client, FILTER_VALIDATE_IP)) {
            $ip = $client;
        } else if(filter_var($forward, FILTER_VALIDATE_IP)) {
            $ip = $forward;
        } else {
            $ip = $remote;
        }
        return $ip;
    }
    
    /**
     * Get IP data
     * @return string
     */
    public static function getIpData($ip) {
        return json_decode(file_get_contents("http://ipinfo.io/{$ip}"));
    }
    
}

