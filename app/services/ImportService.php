<?php
require_once(__DIR__ . "/../services/ImportService.php");
ImportService::importPhpModules();

/**
 * This service provides functions to load data to pages or php reosurces. This
 * is used to import external files for pages like CSSs, Scripts, or PHP classes
 * .
 */
class ImportService {
    
    /**
     * Import css modules
     */
    public static function importCssModules() {
        ?>
        <link href="<?= UrlService::addBaseUrl("/app/styles/GeneralCss.css") ?>" rel="stylesheet" type="text/css"/>    
        <link href="<?= UrlService::addBaseUrl("/plugins/materialize-1.0.0/css/materialize.min.css") ?>" rel="stylesheet" type="text/css"/>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="<?= UrlService::addBaseUrl("/plugins/datatable-1.10.18/css/jquery.dataTables.min.css") ?>" rel="stylesheet" type="text/css"/>
        <link href="<?= UrlService::addBaseUrl("/plugins/select2-4.0.6/css/select2.min.css") ?>" rel="stylesheet" type="text/css"/>
        <link href="<?= UrlService::addBaseUrl("/plugins/fancybox-3.5.7/jquery.fancybox.min.css") ?>" rel="stylesheet" type="text/css"/>
        <link href="<?= UrlService::addBaseUrl("/plugins/toastr-2.1.4/toastr.min.css") ?>" rel="stylesheet" type="text/css"/>
        <link href="<?= UrlService::addBaseUrl("/plugins/dropify-0.2.2/css/dropify.min.css") ?>" rel="stylesheet" type="text/css"/>
        <link href="<?= UrlService::addBaseUrl("/plugins/charjs-2.8.0/Chart.min.css") ?>" rel="stylesheet" type="text/css"/>
        <link href="<?= UrlService::addBaseUrl("/plugins/jquery-loading-1.3.0/jquery.loading.min.css") ?>" rel="stylesheet" type="text/css"/>
        <?php
    }
    
    /**
     * Import js modules
     */
    public static function importJsModules() {
        ?>
        <script src="<?=UrlService::addBaseUrl("/app/scripts/GeneralJs.js")?>" type="text/javascript"></script>
        <script src="<?=UrlService::addBaseUrl("/plugins/jquery-3.3.1/jquery.js")?>" type="text/javascript"></script>
        <script src="<?=UrlService::addBaseUrl("/plugins/datatable-1.10.18/js/jquery.dataTables.min.js")?>" type="text/javascript"></script>
        <script src="<?=UrlService::addBaseUrl("/plugins/materialize-1.0.0/js/materialize.min.js")?>" type="text/javascript"></script>
        <script src="<?=UrlService::addBaseUrl("/plugins/select2-4.0.6/js/select2.full.min.js")?>" type="text/javascript"></script>
        <script src="<?=UrlService::addBaseUrl("/plugins/fancybox-3.5.7/jquery.fancybox.min.js")?>" type="text/javascript"></script>
        <script src="<?=UrlService::addBaseUrl("/plugins/sweetalert-2.1.1/sweetalert.min.js")?>" type="text/javascript"></script>
        <script src="<?=UrlService::addBaseUrl("/plugins/toastr-2.1.4/toastr.min.js")?>" type="text/javascript"></script>
        <script src="<?=UrlService::addBaseUrl("/plugins/jquery-mask-1.14.15/jquery.mask.min.js")?>" type="text/javascript"></script>
        <script src="<?=UrlService::addBaseUrl("/plugins/dropify-0.2.2/js/dropify.min.js")?>" type="text/javascript"></script>
        <script src="<?=UrlService::addBaseUrl("/plugins/charjs-2.8.0/Chart.bundle.min.js")?>" type="text/javascript"></script>
        <script src="<?=UrlService::addBaseUrl("/plugins/charjs-2.8.0/Chart.min.js")?>" type="text/javascript"></script>
        <script src="<?=UrlService::addBaseUrl("/plugins/jquery-loading-1.3.0/jquery.loading.min.js")?>" type="text/javascript"></script>
        <?php
    }
    
    /**
     * Import all of application php modules. The classes of the below 
     * directories will be imported.<br>
     * <ul>
     *  <li>/app/components</li>
     *  <li>/app/enums</li>
     *  <li>/app/repositories</li>
     *  <li>/app/services</li>
     *  <li>/config.php</li>
     * </ul>
     */
    public static function importPhpModules() {
        ImportService::importPhpModulesFromDir(__DIR__ . "/../components");
        ImportService::importPhpModulesFromDir(__DIR__ . "/../enums");
        ImportService::importPhpModulesFromDir(__DIR__ . "/../repositories");
        ImportService::importPhpModulesFromDir(__DIR__ . "/../services");
        ImportService::importPhpModulesFromDir(__DIR__ . "/../config");
        require_once(__DIR__ . "/../../config.php");
    }
    
    /**
     * Import php content from directory. Will be imported just files that
     * has <code>.php</code> suffix and doesn't have the <code>_ignore</code>
     * prefix.
     * @param type $dir
     */
    public static function importPhpModulesFromDir($dir) {
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

