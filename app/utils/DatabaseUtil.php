<?php
require_once(__DIR__ . "/ImportUtil.php");
ImportUtil::importPhpModules();

/**
 * Database utilities that provides function for database manipulation. 
 * The default implementation is defined for MySQL database
 */
class DatabaseUtil {
    
    /**
     * Database connection
     */
    public static function connect() {
        $connect = new mysqli(
                Config::DATABASE_HOST, 
                Config::DATABASE_USER, 
                Config::DATABASE_PASS, 
                Config::DATABASE_NAME, 
                Config::DATABASE_PORT
        );
        if(!$connect) {
            UrlUtil::redirect("app/pages/DatabaseErrorPage.php");
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
        $connection = self::connect();
        return $connection->prepare($sql);
    }

    /**
     * Execute some SQL query and return the result. If the query
     * is a transactional query (INSERT, UPDATE, ...) the result will be
     * returned will be the status of the query
     * @param string $sql
     * @return Result set
     */
    public static function executeSql($sql) {
        $connection = self::connect();
        $result = mysqli_query($connection, $sql);
        if(!$result) {
            $error = mysqli_error($connection);
            LogUtil::log($error, LogEnum::SQL, $sql);
            self::renderSqlError($error, $sql);
        }
        mysqli_close($connection);
        return $result;
    }
    
    /**
     * Fetch the next row from ResultSet as dictionary
     * @param ResultSet $rs
     * @return object
     */
    public static function fetchData($rs) {
        return mysqli_fetch_assoc($rs);
    }
    
    /**
     * Fetch the next row from ResultSet as array indexes
     * @param ResultSet $rs
     * @return array
     */
    public static function fetchDataAsArray($rs) {
        return mysqli_fetch_array($rs);
    }
    
    /**
     * Fetch the next field from ResultSet
     * @param ResultSet $rs
     * @return object
     */
    public static function fetchField($rs) {
        return mysqli_fetch_field($rs);
    }
    
    /**
     * Fetch all the fields from ResultSet into an array
     * @param ResultSet $rs
     * @return object
     */
    public static function fetchFields($rs) {
        return mysqli_fetch_fields($rs);
    }
    
    /**
     * Move the cursor to the specified position in the Result Set data
     * @param type $resultSet
     * @param type $offset
     */
    public static function dataSeek($resultSet, $offset = 0) {
        mysqli_data_seek($resultSet, $offset);
    }
    
    /**
     * Move the cursor to the specified position in the Result Set fields
     * @param type $resultSet
     * @param type $offset
     */
    public static function fieldSeek($resultSet, $offset = 0) {
        mysqli_field_seek($resultSet, $offset);
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
        $rs = self::executeSql("SELECT COUNT(*) AS AMOUNT FROM `$table`");
        return mysqli_fetch_assoc($rs)["AMOUNT"];
    }
    
    /**
     * Check if the page exists
     * @param string $table
     * @return boolean
     */
    public static function pageExists($table, $page) {
        $rs = self::executeSql("SELECT 1 FROM `$table` LIMIT $page,1");
        return mysqli_num_rows($rs) > 0;
    }
    
    /**
     * Check if there is record with identifier
     * @param type $table
     * @return type
     */
    public static function recordExists($table, $id, $field = "id") {
        $rs = self::executeSql("SELECT 1 FROM `$table` WHERE `$field` = '$id'");
        return mysqli_num_rows($rs) > 0;
    }

    /**
     * Get page records
     * @param type $table
     * @return type
     */
    public static function getPageRecords($table, $page, $size) {
        $rs = self::executeSql("SELECT * FROM `$table` LIMIT $page,$size");
        return $rs;
    }
    
    /**
     * Get the last inserted record in the table
     * @param type $table
     * @param type $orderColumn
     * @return type
     */
    public static function getLastInsertedRecord($table, $orderColumn = "id") {
        $rs = self::executeSql("SELECT * FROM `$table` ORDER BY `$orderColumn` DESC LIMIT 1");
        if(self::getNumRows($rs) > 0) {
            return self::fetchData($rs);
        }
        return null;
    }
    
    /**
     * Get the last inserted id in the table
     * @param type $table
     * @param type $idColumn
     * @return type
     */
    public static function getLastInsertedId($table, $idColumn = "id") {
        $rs = self::executeSql("SELECT MAX(`$idColumn`) AS ID FROM $table");
        if(self::getNumRows($rs) > 0) {
            return self::fetchData($rs)["ID"];
        }
        return null;
    }
    
    /**
     * Check user active. 
     * <b>Maybe this method needs to be modified to correspond of your
     * database structure!</b>
     * @param type $userId
     */
    public static function checkUserActive($userId) {
        $rs = self::executeSql("SELECT id FROM `user` WHERE id = $userId AND active = 1");
        return self::getNumRows($rs) > 0;
    }
    
    /**
     * Describe table and return the table data as a Result Set
     * @param type $table
     */
    public static function describeTable($table) {
        return self::executeSql("DESC `$table`");
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
                <?php HtmlUtil::metatags() ?>
            </head>
            <body>
                <b>Database Error!</b><br><br>
                Message: <?=$message?><br>
                SQL: <?=$sql?><br><br>
                <a href="javascript:history.back()">Back</a>
            </body>
        </html>
        <?php
        die;
    }
}