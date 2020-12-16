<?php
/**
 * Application general configurations. To production configuration it is
 * recommended to make a clone of this file and set the new configurations
 * in the cloned file.
 */
class Config {
    
    // VrbStarterKit defs (Do not change it)
    const KIT_VERSION = "2.0-beta";
    const FEATURES = [
        "VrbStarterKit",
        "VrbSimpleForms",
        "[WIP] VrbGenerator"
    ];

    // General configurations
    const TITLE = "Site";
    const AUTHOR = "Author";
    const COMPANY = "Company";
    const DESCRIPTION = "Description";
    const KEY_WORDS = "Key,Words";
    const RESPONSIVE = true;
    const CHARSET = "UTF-8";
    const FAVICON = "favicon.png";
    const VERSION = "1.0.0";
    
    // Locale
    const IDIOM = "en_US";
    const TIMEZONE = "UTC";
    const DATE_FORMAT = "Y-m-d";
    const DATETIME_FORMAT = "Y-m-d H:i:s";

    // Base URL and page configurations
    const BASE_URL = "http://localhost/VrbStarterKit";
    const INITIAL_PAGE = "HomePage.php";
    
    // Database access configuration
    const DATABASE_HOST = "localhost";
    const DATABASE_USER = "root";
    const DATABASE_PASS = "";
    const DATABASE_PORT = "3306";
    const DATABASE_NAME = "database";
    
    // Log (Its is recommended to keep just ERROR for production)
    const LOG = true;
    const LOG_TYPE = ["INFO", "ERROR", "DEBUG", "SQL"];

    // Password/token generation salt
    const SALT = "73ef930e2b797a5b5daa73cf3a3025ce853d1bb8";
    
    // Directories
    const UPLOAD_FOLDER = "uploads";
    const RESOURCE_FOLDER = "resources";
    
    // E-mail configuration
    const MAIL_SMTP = "smtp.example.com";
    const MAIL_PORT = 465;
    const MAIL_TYPE = "ssl";
    const MAIL_SENDER = "contact@example.com.br";
    const MAIL_SENDER_NAME = "username";
    const MAIL_PASSWORD = "password";
    const MAIL_CHARSET = "UTF-8";
    
    // Application tokens
    const TOKEN_1 = "token_1";
    const TOKEN_2 = "token_2";

    /**
     * Get configuration by name
     * @param string $key
     * @return mixed
     */
    public static function getConfig($key) {
        return Config::$key;
    }
}