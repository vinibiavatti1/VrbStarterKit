<?php
require_once(__DIR__ . "/../services/ImportService.php");
ImportService::importPhpModules();

// Cron event call
EventService::cron();

/**
 * Example cron job
 */
class ExampleCron implements Cron {
    
    public static function execute() {
        print("Success!");
    }
    
}
ExampleCron::execute();