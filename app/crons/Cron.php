<?php
/**
 * Interface to create CRON jobs
 */
interface Cron {
    
    /**
     * Execution method
     */
    public static function execute();
    
}