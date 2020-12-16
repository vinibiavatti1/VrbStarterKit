<?php
require_once(__DIR__ . "/ImportUtil.php");
ImportUtil::importPhpModules();

/**
 * Class that provides some rendering methods for HTML tags and attributes
 */
class HtmlUtil {
    
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
        ?><link rel="icon" href="<?= UrlUtil::addBaseUrl(Config::RESOURCE_FOLDER . "/" . Config::FAVICON) ?>" /><?php
    }
    
    /**
     * Print some PHP object/array inside "pre" tag
     * @param type $object
     */
    public static function printPreformatted($object) {
        echo("<pre>");
        print_r($object);
        echo("</pre>");
    }
    
}
