<?php
require_once(__DIR__ . "/../utils/ImportUtil.php");
ImportUtil::importPhpModules();

// Cron event call
EventUtil::cron();

/**
 * Example cron job
 */
class ExampleCron implements Cron {
    
    public static function execute() {
        print("Success!");
    }
    
}
ExampleCron::execute();