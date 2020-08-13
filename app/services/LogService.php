<?php
require_once(__DIR__ . "/../services/ImportService.php");
ImportService::importPhpModules();

/**
 * Service for application log.
 */
class LogService {
    
    /**
     * Insert new exception log
     * @param Exception $exception
     * @param LogEnum $type
     * @param string $sql
     */
    public static function logException($exception, $type, $sql = null) {
        if(!Config::LOG) {
            return;
        }
        if(!in_array($type, Config::LOG_TYPE)) {
            return;
        }
        error_log($exception);
        error_log(LogService::createLogMessage($exception->getMessage(), $type, $sql));
    }

    /**
     * Insert new log
     * @param string $message
     * @param LogEnum $type
     * @param string $sql
     */
    public static function log($message, $type, $sql = null) {
        if(!Config::LOG) {
            return;
        }
        if(!in_array($type, Config::LOG_TYPE)) {
            return;
        }
        error_log(LogService::createLogMessage($message, $type, $sql));
    }
    
    /**
     * Create log message
     * @param string $message
     * @param LogEnum $type
     * @param string $sql
     * @return type
     */
    private static function createLogMessage($message, $type, $sql) {
        $userId = SessionService::get(SessionEnum::USER_ID_KEY);
        $url = filter_input(INPUT_SERVER, "REQUEST_URI");
        $ip = IpService::getIp();
        return "TYPE: $type, USERID: $userId, URL: $url, IP: $ip, SQL: $sql, MESSAGE: $message";
    }
}

