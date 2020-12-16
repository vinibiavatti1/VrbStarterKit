<?php
require_once(__DIR__ . "/ImportUtil.php");
ImportUtil::importPhpModules();

/**
 * Class to process URLs and make redirections to defined locations in the 
 * application. This util uses the base url set in the <code>config.php</code> 
 * as the base URL for the operations
 */
class UrlUtil {
    
    /**
     * Redirect to the same URL without query parameters
     */
    public static function reloadWithoutParams() {
        header("location: " . UrlUtil::getCleanedUrl());
        exit;
    }
    
    /**
     * Redirect to the same URL with query parameters
     * @param string $queryParams
     */
    public static function reloadWithParams($queryParams) {
        header("location: " . UrlUtil::getCleanedUrl() . "?" .$queryParams);
        exit;
    }
    
    /**
     * Redirect to the same URL with status code
     * @param mixed $status
     */
    public static function reloadWithStatus($status) {
        header("location: " . UrlUtil::getCleanedUrl() . "?status=" .$status);
        exit;
    }
    
    /**
     * Redirect to the same URL
     */
    public static function reload() {
        header("location: " . UrlUtil::getUrl());
        exit;
    }
    
    /**
     * Redirect to URL
     * @param string $url
     * @param mixed $status
     */
    public static function redirect($url, $status = null) {
        $url_redirect = UrlUtil::addBaseUrl($url);
        if($status == null) {
            header("location: $url_redirect");
        } else {
            header("location: $url_redirect?status=$status");
        }
        exit;
    }
    
    /**
     * Redirect to page in /app/pages
     * @param string $pageName
     * @param type $status
     */
    public static function redirectToPage($pageName, $status = null) {
        if(strpos($pageName, ".php") == false) {
            $pageName .= ".php";
        }
        self::redirect("app/pages/$pageName", $status);
    }
    
    /**
     * Redirect to action in /app/actions
     * @param string $actionName
     * @param type $status
     */
    public static function redirectToAction($actionName, $status = null) {
        if(strpos($actionName, ".php") == false) {
            $actionName .= ".php";
        }
        self::redirect("app/actions/$actionName", $status);
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
     * Create a link to page
     * @param string $pageName
     * @return type
     */
    public static function linkToPage($pageName) {
        if(strpos($pageName, ".php") == false) {
            $pageName .= ".php";
        }
        return self::addBaseUrl("app/pages/$pageName");
    }
    
    /**
     * Create a link to action
     * @param string $actionName
     * @return type
     */
    public static function linkToAction($actionName) {
        if(strpos($actionName, ".php") == false) {
            $actionName .= ".php";
        }
        return self::addBaseUrl("app/actions/$actionName");
    }
    
    /**
     * Get URL
     * @return string
     */
    public static function getUrl() {
        $req = filter_input(INPUT_SERVER, 'REQUEST_URI');
        $http = UrlUtil::isHttps() ? "https://" : "http://";
        return $http . filter_input(INPUT_SERVER, 'HTTP_HOST') . $req;
    }
    
    /**
     * Check if the URL has query params
     * Verificar se URL possui parâmetros GET
     * @return int
     */
    public static function hasQueryParams($url = null) {
        if($url == null) {
            $url = UrlUtil::getUrl();
        }
	return strpos($url, '?');
    }
    
    /**
     * Get URL without query params
     * @return string
     */
    public static function getCleanedUrl() {
        $req = explode('?', filter_input(INPUT_SERVER, 'REQUEST_URI'), 2);
        $http = UrlUtil::isHttps() ? "https://" : "http://";
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

