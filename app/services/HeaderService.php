<?php
require_once(__DIR__ . "/../services/ImportService.php");
ImportService::importPhpModules();

/**
 * Service to process http header
 */
class HeaderService {

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
    public static function setContentType($content, $charset = HeaderEnum::UTF_8_CHARSET) {
        header("Content-Type: $content; charset=$charset");
    }
    
    /**
     * Define JSON content type to page
     * @param string $charset
     */
    public static function setJsonContentType($charset = HeaderEnum::UTF_8_CHARSET) {
        HeaderService::setContentType(HeaderEnum::JSON_CONTENT_TYPE, $charset);
    }
}
