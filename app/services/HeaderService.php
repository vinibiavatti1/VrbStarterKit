<?php
require_once(__DIR__ . "/../services/ImportService.php");
ImportService::importPhpModules();

/**
 * Service to process http header
 */
class HeaderService {
    
    const UTF_8_CHARSET = "utf-8";
    const ISO_8859_1_CHARSET = "iso-8859-1";
    const JSON_CONTENT_TYPE = "application/json";
    const JSONP_CONTENT_TYPE = "application/javascript";
    const TEXT_CONTENT_TYPE = "text/html";
    
    /**
     * Set value to header
     * @param string $name
     * @param mixed $value
     */
    public static function set($name, $value) {
        header("$name: $value");
    }
    
    /**
     * Set content type to page<br>
     * <code>Content-Type</code>
     * @param string $content
     * @param string $charset
     */
    public static function setContentType($content, $charset = HeaderService::UTF_8_CHARSET) {
        header("Content-Type: $content; charset=$charset");
    }
    
    /**
     * Define JSON content type to page
     * @param string $charset
     */
    public static function setJsonContentType($charset = HeaderService::UTF_8_CHARSET) {
        HeaderService::setContentType(HeaderService::JSON_CONTENT_TYPE, $charset);
    }
}
