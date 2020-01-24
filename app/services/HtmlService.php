<?php
require_once(__DIR__ . "/../services/ImportService.php");
ImportService::importPhpModules();

/**
 * This service provides some render methods for HTML tags and attributes.
 */
class HtmlService {
    
    /**
     * Render title
     * @param string $title
     */
    public static function title($title) {
        ?><title><?= Config::TITLE?> | <?=$title?></title><?php
    }
    
    /**
     * Render metatags
     */
    public static function metatags() {
        ?>
        <meta charset="<?= Config::CHARSET ?>">
        <meta name="description" content="<?= Config::DESCRIPTION?>">
        <meta name="keywords" content="<?= Config::KEY_WORDS?>">
        <meta name="author" content="<?= Config::AUTHOR?>">
        <?php if(Config::RESPONSIVE) { ?>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php } ?>
        <?php
    }
    
    /**
     * Render favicon
     * @param string $title
     */
    public static function favicon() {
        ?><link rel="icon" href="<?= UrlService::addBaseUrl(Config::RESOURCE_FOLDER . "/" . Config::FAVICON) ?>" /><?php
    }
    
}
