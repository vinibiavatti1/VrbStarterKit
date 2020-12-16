<?php
/**
 * This util provides functions to load reosurces for php files. This is used to 
 * import external files for pages like CSSs, Scripts, PHP classes, etc.
 */
class ImportUtil {
    
    /**
     * Import css modules
     */
    public static function importCssModules() {
        ?>
        <link href="<?= UrlUtil::addBaseUrl("/app/styles/GeneralCss.css") ?>" rel="stylesheet" type="text/css"/>    
        <link href="<?= UrlUtil::addBaseUrl("/plugins/materialize-1.0.0/css/materialize.min.css") ?>" rel="stylesheet" type="text/css"/>
        <link href="<?= UrlUtil::addBaseUrl("/plugins/material-icons/materialIcons.css") ?>" rel="stylesheet">
        <link href="<?= UrlUtil::addBaseUrl("/plugins/datatable-1.10.18/css/jquery.dataTables.min.css") ?>" rel="stylesheet" type="text/css"/>
        <link href="<?= UrlUtil::addBaseUrl("/plugins/select2-4.0.6/css/select2.min.css") ?>" rel="stylesheet" type="text/css"/>
        <link href="<?= UrlUtil::addBaseUrl("/plugins/fancybox-3.5.7/jquery.fancybox.min.css") ?>" rel="stylesheet" type="text/css"/>
        <link href="<?= UrlUtil::addBaseUrl("/plugins/toastr-2.1.4/toastr.min.css") ?>" rel="stylesheet" type="text/css"/>
        <link href="<?= UrlUtil::addBaseUrl("/plugins/dropify-0.2.2/css/dropify.min.css") ?>" rel="stylesheet" type="text/css"/>
        <link href="<?= UrlUtil::addBaseUrl("/plugins/charjs-2.8.0/Chart.min.css") ?>" rel="stylesheet" type="text/css"/>
        <link href="<?= UrlUtil::addBaseUrl("/plugins/jquery-loading-1.3.0/jquery.loading.min.css") ?>" rel="stylesheet" type="text/css"/>
        <link href="<?= UrlUtil::addBaseUrl("/plugins/leaflet-1.7.1/leaflet.css") ?>" rel="stylesheet" type="text/css"/>
        <?php
    }
    
    /**
     * Import js modules
     */
    public static function importJsModules() {
        ?>
        <script src="<?=UrlUtil::addBaseUrl("/app/scripts/GeneralScript.js")?>" type="text/javascript"></script>
        <script src="<?=UrlUtil::addBaseUrl("/plugins/jquery-3.3.1/jquery.js")?>" type="text/javascript"></script>
        <script src="<?=UrlUtil::addBaseUrl("/plugins/datatable-1.10.18/js/jquery.dataTables.min.js")?>" type="text/javascript"></script>
        <script src="<?=UrlUtil::addBaseUrl("/plugins/materialize-1.0.0/js/materialize.min.js")?>" type="text/javascript"></script>
        <script src="<?=UrlUtil::addBaseUrl("/plugins/select2-4.0.6/js/select2.full.min.js")?>" type="text/javascript"></script>
        <script src="<?=UrlUtil::addBaseUrl("/plugins/fancybox-3.5.7/jquery.fancybox.min.js")?>" type="text/javascript"></script>
        <script src="<?=UrlUtil::addBaseUrl("/plugins/sweetalert-2.1.1/sweetalert.min.js")?>" type="text/javascript"></script>
        <script src="<?=UrlUtil::addBaseUrl("/plugins/toastr-2.1.4/toastr.min.js")?>" type="text/javascript"></script>
        <script src="<?=UrlUtil::addBaseUrl("/plugins/jquery-mask-1.14.15/jquery.mask.min.js")?>" type="text/javascript"></script>
        <script src="<?=UrlUtil::addBaseUrl("/plugins/dropify-0.2.2/js/dropify.min.js")?>" type="text/javascript"></script>
        <script src="<?=UrlUtil::addBaseUrl("/plugins/charjs-2.8.0/Chart.bundle.min.js")?>" type="text/javascript"></script>
        <script src="<?=UrlUtil::addBaseUrl("/plugins/charjs-2.8.0/Chart.min.js")?>" type="text/javascript"></script>
        <script src="<?=UrlUtil::addBaseUrl("/plugins/jquery-loading-1.3.0/jquery.loading.min.js")?>" type="text/javascript"></script>
        <script src="<?=UrlUtil::addBaseUrl("/plugins/leaflet-1.7.1/leaflet.js")?>" type="text/javascript"></script>
        <?php
    }
    
    /**
     * Load all of application php modules. The classes folder listed below 
     * will be imported.<br>
     * <ul>
     *  <li>/app/components</li>
     *  <li>/app/enums</li>
     *  <li>/app/repositories</li>
     *  <li>/app/utils</li>
     *  <li>/app/services</li>
     *  <li>/app/models</li>
     *  <li>/app/configs</li>
     *  <li>/config.php</li>
     * </ul>
     */
    public static function importPhpModules() {
        self::importPhpModulesFromDir(__DIR__ . "/../components");
        self::importPhpModulesFromDir(__DIR__ . "/../enums");
        self::importPhpModulesFromDir(__DIR__ . "/../repositories");
        self::importPhpModulesFromDir(__DIR__ . "/../utils");
        self::importPhpModulesFromDir(__DIR__ . "/../models");
        self::importPhpModulesFromDir(__DIR__ . "/../configs");
        self::importPhpModulesFromDir(__DIR__ . "/../services");
        require_once(__DIR__ . "/../../config.php");
    }
    
    /**
     * Import php content from directory. Will be imported just files that
     * has <code>.php</code> suffix and doesn't have the <code>_ignore</code>
     * prefix.
     * @param type $dir
     */
    public static function importPhpModulesFromDir($dir) {
        if(!is_dir($dir)) {
            echo(sprintf("%s: Error to load directory: %s. This directory doesn't exist or is not valid", get_class(), $dir));
            die;
        }
        $files = scandir($dir);
        foreach($files as $file) {
            if($file == "." || $file == "..") {
                continue;
            }
            if(substr($file, -4) != ".php" || strcasecmp(substr($file, 0, 8), "ignore_") == 0) {
                continue;
            }
            require_once($dir . "/" . $file);
        }
    }
}

