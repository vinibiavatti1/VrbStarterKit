<?php
require_once(__DIR__ . "/ImportUtil.php");
ImportUtil::importPhpModules();

/**
 * Class that provides utilities for dates. There are some convert methods for
 * date manipulation, and the ISO format is used by default
 */
class DateUtil {
    
    const ISO_DATE_FORMAT = 'Y-m-d';
    const ISO_DATETIME_FORMAT=  'Y-m-d H:i:s';
    
    /**
     * Convert string to date with format
     * @param type $str
     * @return int
     */
    public static function convertStrToDate($str) {
        return strtotime($str);
    }

    /**
     * Convert date to string with format
     * @param Date $date
     * @param string $format
     * @return string
     */
    public static function convertDateToStr($date, $format = ISO_DATE_FORMAT) {
        return date($format, $date);
    }
    
    /**
     * Define timezone
     */
    public static function setDefaultTimezone($locale = Config::TIMEZONE) {
        date_default_timezone_set($locale);
    }
}

