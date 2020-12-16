<?php
require_once(__DIR__ . "/ImportUtil.php");
ImportUtil::importPhpModules();

/**
 * Class to control application events. This class needs to be implemented
 * and the functions have to be called in the correct file type
 */
class EventUtil {
    
    /**
     * Code that will be executed for every application html page
     */
    public static function page() {
        // Event code
        EventUtil::all();
    }
    
    /**
     * Code that will be executed for every application action page
     */
    public static function action() {
        // Event code
        EventUtil::all();
    }
    
    /**
     * Code that will be executed for every application ajax page
     */
    public static function ajax() {
        // Event code
        EventUtil::all();
    }
    
    /**
     * Code that will be executed for every cron jobs
     */
    public static function cron() {
        // Event code
        EventUtil::all();
    }

    /**
     * Code that will be executed for every event called
     */
    public static function all() {
        // Event code
    }
}

