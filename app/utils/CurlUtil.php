<?php
require_once(__DIR__ . "/ImportUtil.php");
ImportUtil::importPhpModules();

/**
 * Class that use CURL library to make requests
 */
class CurlUtil {

    /**
     * Make a REST request
     * @param type $url
     * @param type $method
     * @param type $headers
     * @param type $body
     * @return type
     */
    public static function request($url, $method, $headers, $body) {
        $curl = curl_init();

        if($method == "POST") {
            curl_setopt($curl, CURLOPT_POST, true);
        } else if($method == "PUT") {
            curl_setopt($curl, CURLOPT_PUT, true);
        }
        
        if(!empty($headers)) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        }
        if(!empty($body)) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
        }
        
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($curl);
        $info = curl_getinfo($curl);
        curl_close($curl);

        return [
            "result" => $result,
            "info" => $info
        ];
    }

}
