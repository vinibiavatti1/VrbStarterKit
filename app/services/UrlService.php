<?php
/**
 * Service to process URLs and redirect to defined paths. This service looks the
 * configured url in the <code>config.php</code>, and not uses the current path 
 * url. This prevents problemas with different directories.
 */
class UrlService {
    
    /**
     * Redirect to the same URL without query parameters
     */
    public static function reloadWithoutParams() {
        header("location: " . UrlService::getCleanedUrl());
        exit;
    }
    
    /**
     * Redirect to the same URL with query parameters
     * @param string $queryParams
     */
    public static function reloadWithParams($queryParams) {
        header("location: " . UrlService::getCleanedUrl() . "?" .$queryParams);
        exit;
    }
    
    /**
     * Redirect to the same URL with status code
     * @param mixed $status
     */
    public static function reloadWithStatus($status) {
        header("location: " . UrlService::getCleanedUrl() . "?status=" .$status);
        exit;
    }
    
    /**
     * Redirect to the same URL
     */
    public static function reload() {
        header("location: " . UrlService::getUrl());
        exit;
    }
    
    /**
     * Redirect to URL
     * @param string $url
     */
    public static function redirect($url) {
        $url_redirect = UrlService::addBaseUrl($url);
        header("location: $url_redirect");
        exit;
    }
    
    /**
     * Redirect to URL with status code
     * @param string $url
     * @param mixed $status
     */
    public static function redirectWithStatus($url, $status) {
        $url_redirect = UrlService::addBaseUrl($url);
        header("location: $url_redirect?status=$status");
        exit;
    }
    
    /**
     * Add the configured base url in the url param and return it
     * @param string $url
     * @return string
     */
    public static function addBaseUrl($url) {
        return Config::BASE_URL . (substr($url, 0,1) == "/" ? $url : "/$url");
    }
    
    /**
     * Get URL
     * @return string
     */
    public static function getUrl() {
        $req = filter_input(INPUT_SERVER, 'REQUEST_URI');
        $http = UrlService::isHttps() ? "https://" : "http://";
        return $http . filter_input(INPUT_SERVER, 'HTTP_HOST') . $req;
    }
    
    /**
     * Check if the URL has query params
     * Verificar se URL possui parâmetros GET
     * @return int
     */
    public static function hasQueryParams($url = null) {
        if($url == null) {
            $url = UrlService::getUrl();
        }
	return strpos($url, '?');
    }
    
    /**
     * Get URL without query params
     * @return string
     */
    public static function getCleanedUrl() {
        $req = explode('?', filter_input(INPUT_SERVER, 'REQUEST_URI'), 2);
        $http = Serv_Url::is_https() ? "https://" : "http://";
        return $http . filter_input(INPUT_SERVER, 'HTTP_HOST') . $req[0];
    }
    
    /**
     * Check if the protocol of the current URL is HTTPS
     * @return boolean
     */
    public static function isHttps() {
        return filter_input(INPUT_SERVER, 'HTTPS') == "on";
    }
    
}
