<?php
require_once(__DIR__ . "/../services/ImportService.php");
ImportService::importPhpModules();

/**
 * Database service provides some utilities for database connection. The default
 * implementation is defined for MySQL database.
 */
class DatabaseService {
    
    /**
     * Database connection
     */
    public static function connect() {
        $connect = mysqli_connect(Config::DATABASE_HOST, Config::DATABASE_USER, Config::DATABASE_PASS, Config::DATABASE_NAME, Config::DATABASE_PORT);
        if(!$connect) {
            UrlService::redirect("app/pages/DatabaseErrorPage.php");
        }
        $connect->set_charset("utf8");
        return $connect;
    }
    
    /**
     * Prepare statement
     * @param string $sql
     * @return mysqli_stmt
     */
    public static function statement($sql) {
        $connection = DatabaseService::connect();
        return $connection->prepare($sql);
    }

    /**
     * Execute query
     * @param string $sql
     * @return Result set
     */
    public static function executeQuery($sql) {
        $connection = DatabaseService::connect();
        $rs = mysqli_query($connection, $sql);
        if(!$rs) {
            $error = mysqli_error($connection);
            LogService::log($error, LogEnum::SQL, $sql);
            self::renderSqlError($error, $sql);
        }
    }
    
    /**
     * Execute update
     * @param string $sql
     */
    public static function executeUpdate($sql) {
        $connection = DatabaseService::connect();
        $rs = mysqli_query($connection, $sql);
        if(!$rs) {
            $error = mysqli_error($connection);
            LogService::log($error, LogEnum::SQL, $sql);
            self::renderSqlError($error, $sql);
        }
    }
    
    /**
     * Fetch data from ResultSet as array column name
     * @param ResultSet $rs
     * @return object
     */
    public static function fetch($rs) {
        return mysqli_fetch_assoc($rs);
    }
    
    /**
     * Fetch data from ResultSet as array indexes
     * @param ResultSet $rs
     * @return array
     */
    public static function fetchArray($rs) {
        return mysqli_fetch_array($rs);
    }
    
    /**
     * The ResultSet num rows
     * @param ResultSet $rs
     * @return int
     */
    public static function getNumRows($rs) {
        return mysqli_num_rows($rs);
    }
    
    /**
     * Get num records of table
     * @param string $table
     * @return int
     */
    public static function getNumRecords($table) {
        $rs = DatabaseService::executeQuery("SELECT COUNT(*) AS AMOUNT FROM $table");
        return mysqli_fetch_assoc($rs)["AMOUNT"];
    }
    
    /**
     * Check if the page exists
     * @param string $table
     * @return boolean
     */
    public static function pageExists($table, $page) {
        $rs = DatabaseService::executeQuery("SELECT 1 FROM $table LIMIT $page,1");
        return mysqli_num_rows($rs) > 0;
    }
    
    /**
     * Check if there is record with identifier
     * @param type $table
     * @return type
     */
    public static function recordExists($table, $id, $field = "id") {
        $rs = DatabaseService::executeQuery("SELECT 1 FROM $table WHERE $field = $id");
        return mysqli_num_rows($rs) > 0;
    }

    /**
     * Get page records
     * @param type $table
     * @return type
     */
    public static function getPageRecords($table, $page, $size) {
        $rs = DatabaseService::executeQuery("SELECT * FROM $table LIMIT $page,$size");
        return $rs;
    }
    
    /**
     * Get the last inserted record in the table
     * @param type $table
     * @param type $orderColumn
     * @return type
     */
    public static function getLastInsertedRecord($table, $orderColumn = "id") {
        $rs = DatabaseService::executeQuery("SELECT * FROM $table ORDER BY $orderColumn DESC LIMIT 1");
        return mysqli_fetch_assoc($rs);
    }
    
    /**
     * Get the last inserted record in the table
     * @param type $table
     * @param type $idColumn
     * @return type
     */
    public static function getLastInsertedId($table, $idColumn = "id") {
        $rs = DatabaseService::executeQuery("SELECT MAX($idColumn) AS ID FROM $table");
        return mysqli_fetch_assoc($rs);
    }
    
    /**
     * Check user active. 
     * <b>Maybe this method needs to be modified.</b>
     * @param type $userId
     */
    public static function checkUserActive($userId) {
        $rs = DatabaseService::executeQuery("SELECT id FROM usuario WHERE id = $userId AND ativo = 1");
        return DatabaseService::getNumRows($rs) > 0;
    }
    
    /**
     * Render sql error page
     * @param type $message
     * @param type $sql
     */
    private static function renderSqlError($message, $sql) {
        ?>
        <html>
            <head>
                <?php HtmlService::metatags() ?>
            </head>
            <body>
                <b>Error!</b><br><br>
                Message: <?=$message?><br>
                SQL: <?=$sql?><br><br>
                <a href="javascript:history.back()">Back</a>
            </body>
        </html>
        <?php
        die;
    }
}